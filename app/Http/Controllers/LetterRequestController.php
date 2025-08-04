<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LetterRequest;
use App\Models\LetterRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class LetterRequestController extends Controller
{
    /**
     * Menampilkan daftar semua permintaan surat.
     */
    public function index(Request $request)
    {
        $query = LetterRequest::query();
        // Jika tidak ada filter status dari request, tampilkan default 'pending' dan 'processing'
        if (!$request->has('status') || $request->status == '') {
            $query->whereIn('status', ['pending', 'processing']);
        }
        // Jika ada filter status dari request, terapkan filter tersebut
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('request_number', 'like', '%' . $request->search . '%');
        }

        $letterRequests = $query->with(['user', 'service'])->paginate(10);
        return view('pages.layanan-surat.letter-request.index', compact('letterRequests'));
    }

    /**
     * Menampilkan form untuk admin mengunggah surat yang sudah selesai.
     */
    public function show(LetterRequest $letterRequest)
    {
        return view('pages.layanan-surat.letter-request.show', compact('letterRequest'));
    }

    /**
     * Memperbarui status permintaan surat.
     */
    public function update(Request $request, LetterRequest $letterRequest)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'processing', 'completed', 'rejected'])],
            'completed_file' => 'nullable|file|mimes:pdf|max:5120', // File PDF, max 5MB
            'admin_notes' => 'nullable|string',
        ]);

        $filePath = $letterRequest->completed_file_path;
        if ($request->hasFile('completed_file')) {
            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $request->file('completed_file')->store('completed_letters', 'public');
        }

        $letterRequest->update([
            'status' => $validated['status'],
            'completed_file_path' => $filePath,
            'admin_notes' => $validated['admin_notes'],
        ]);

        return redirect('/letter-request')->with('success', 'Status permintaan surat berhasil diperbarui!');
    }

    /**
     * Mengunduh surat yang sudah selesai.
     */
    public function download(LetterRequest $letterRequest) // <-- TAMBAHKAN PARAMETER INI
    {
        if ($letterRequest->completed_file_path && Storage::disk('public')->exists($letterRequest->completed_file_path)) {
            return Storage::disk('public')->download($letterRequest->completed_file_path, 'Surat-Selesai-' . $letterRequest->request_number . '.pdf');
        }
        return redirect()->back()->with('error', 'Surat selesai tidak ditemukan.');
    }
}