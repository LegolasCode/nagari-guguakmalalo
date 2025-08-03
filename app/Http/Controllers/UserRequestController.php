<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LetterService;
use App\Models\LetterRequest;
use App\Models\LetterRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserRequestController extends Controller
{
    /**
     * Menampilkan daftar layanan surat yang bisa dipilih user.
     */
    public function indexServices()
    {
        $letterServices = LetterService::all();
        return view('pages.layanan-surat.index', compact('letterServices'));
    }

    /**
     * Menampilkan form pengajuan surat dengan persyaratan yang sesuai.
     */
    public function createRequest(LetterService $letterService) // Menggunakan Route Model Binding
    {
        return view('pages.layanan-surat.create-request', compact('letterService'));
    }

    /**
     * Menyimpan permintaan surat dari user.
     */
    public function storeRequest(Request $request, LetterService $letterService)
    {
        $requirements = explode(',', $letterService->requirements);

        $rules = [];
        foreach ($requirements as $req) {
            $reqName = trim($req);
            $inputName = Str::slug($reqName);
            $rules[$inputName] = 'required|file|max:2048';
        }
        $validated = $request->validate($rules);

        $request_number = 'REQ-' . Carbon::now()->format('YmdHis') . '-' . rand(100, 999);
        
        $letterRequest = LetterRequest::create([
            'user_id' => auth()->id(),
            'letter_service_id' => $letterService->id,
            'request_number' => $request_number,
            'status' => 'pending',
        ]);
        
        foreach ($requirements as $req) {
            $reqName = trim($req);
            $inputName = Str::slug($reqName);
            $filePath = $request->file($inputName)->store('letter_requirements', 'public');

            LetterRequirement::create([
                'letter_request_id' => $letterRequest->id,
                'requirement_name' => $reqName,
                'file_path' => $filePath,
            ]);
        }
        return redirect('/layanan-surat')->with('success', 'Permintaan surat berhasil diajukan dengan nomor: ' . $request_number);
    }

    /**
     * Menampilkan daftar permintaan surat yang diajukan oleh user.
     */
    public function indexMyRequests()
    {
        // Ambil semua permintaan surat dari user yang sedang login, dengan relasi service
        $myRequests = LetterRequest::with('service')
        ->where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->paginate(10); // Pagination, 10 item per halaman

        return view('pages.layanan-surat.my-request', compact('myRequests'));
    }

    /**
     * Menampilkan status dan detail permintaan surat.
     */
    public function showMyRequest(LetterRequest $letterRequest)
    {
        // Pastikan user adalah pemilik request
        if ($letterRequest->user_id != auth()->id()) {
            return abort(403);
        }
        // Perhatikan relasi yang dimuat
        $letterRequest->load(['service', 'requirements']); // Eager load relasi
        return view('pages.layanan-surat.show-request', compact('letterRequest'));
    }

    public function downloadCompletedFile(LetterRequest $letterRequest)
    {
        // Pastikan user adalah pemilik request dan file ada
        if ($letterRequest->user_id == auth()->id() && $letterRequest->completed_file_path && Storage::disk('public')->exists($letterRequest->completed_file_path)) {
            return Storage::disk('public')->download($letterRequest->completed_file_path, 'Surat-' . Str::slug($letterRequest->service->name) . '-' . $letterRequest->request_number . '.pdf');
        }
        return redirect()->back()->with('error', 'File surat tidak ditemukan atau Anda tidak memiliki akses.');
    }
}