<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    // Fungsi untuk menampilkan halaman daftar pengaduan
    public function index(Request $request)
    {
        $query = Complaint::query();

        // Filter berdasarkan user role
        if (Auth::user()->role_id == 2) { // Jika role adalah user (bukan admin)
            $residentId = Auth::user()->resident->id ?? null;
            $query->where('resident_id', $residentId);
        }

        // --- PERBAIKAN DI SINI: Filter status ---
        // Jika tidak ada filter status dari request, tampilkan default 'new' dan 'processing'
        if (!$request->has('status') || $request->status == '') {
            $query->whereIn('status', ['new', 'processing']);
        }
        // Jika ada filter status dari request, terapkan filter tersebut
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        // --- AKHIR PERBAIKAN ---

        // Ambil data dengan pagination
        $complaints = $query->paginate(10); // Sesuaikan pagination

        return view('pages.complaint.index', compact('complaints'));
    }
    // Fungsi untuk menampilkan halaman buat pengaduan
    public function create()
    {
        return view('pages.complaint.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'min:3', 'max:2000'],
            'photo_proof' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung dengan data penduduk manapun');
        }
 
        $complaint = new Complaint();
        $complaint->resident_id = Auth::user()->resident->id;
        $complaint->title = $request->input('title');
        $complaint->content = $request->input('content');

        if ($request->hasFile('photo_proof')) {
            $filePath = $request->file('photo_proof')->store('public/uploads');
            $complaint->photo_proof = $filePath;
        }

        $complaint->save();

        return redirect('/complaint')->with('success', 'Berhasil membuat pengaduan');
    }
    // Fungsi untuk menampilkan halaman edit pengaduan
    public function edit($id)
    {
        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung dengan data penduduk manapun');
        }

        $complaint = Complaint::findOrFail($id);
        return view('pages.complaint.edit', compact('complaint'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'min:3', 'max:2000'],
            'photo_proof' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung dengan data penduduk manapun');
        }

        $complaint = Complaint::findOrFail($id);
        $complaint->resident_id = resident->id;
        $complaint->title = $request->input('title');
        $complaint->content = $request->input('content');

        if ($request->hasFile('photo_proof')) {
            if(isset($complaint->photo_proof)){
                Storage::delete($complaint->photo_proof);
            }
            $filePath = $request->file('photo_proof')->store('public/uploads');
            $complaint->photo_proof = $filePath;
        }

        $complaint->save();

        return redirect('/complaint')->with('success', 'Berhasil mengubah pengaduan');
    }
    // Fungsi untuk menghapus pengaduan
    public function destroy($id)
    {
        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung dengan data penduduk manapun');
        }

        $complaint = Complaint::findOrFail($id);
        $complaint->delete();
        return redirect('/complaint')->with('success', 'Berhasil menghapus pengaduan');
    }
    // Fungsi untuk memperbarui status pengaduan
    public function updateStatus(Request $request, $id)
    {
    $request->validate([
        'status' => ['required', 'in:new,processing,completed'],
    ]);

    $complaint = Complaint::findOrFail($id);
    $complaint->status = $request->status;
    $complaint->save();

    return redirect()->back()->with('success', 'Status aduan diperbarui.');
    }

}
