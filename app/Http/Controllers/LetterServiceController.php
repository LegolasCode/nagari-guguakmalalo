<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LetterService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class LetterServiceController extends Controller
{
    /**
     * Menampilkan daftar semua jenis layanan surat.
     */
    public function index(Request $request)
    {
        $query = LetterService::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $letterServices = $query->paginate(10);
        return view('pages.layanan-surat.letter-services.index', compact('letterServices'));
    }

    /**
     * Menampilkan form untuk membuat layanan surat baru.
     */
    public function create()
    {
        return view('pages.layanan-surat.letter-services.create');
    }

    /**
     * Menyimpan layanan surat baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'requirements' => 'required|string', // Menyimpan persyaratan sebagai teks
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        // Pastikan slug unik
        $originalSlug = $validated['slug'];
        $count = 1;
        while (LetterService::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count++;
        }
        $validated['user_id'] = auth()->id();

        LetterService::create($validated);
        return redirect('/letter-services')->with('success', 'Jenis layanan surat berhasil ditambahkan!');
    }

    public function show(LetterService $letterService)
    {
        return view('pages.layanan-surat.letter-services.edit', compact('letterServices')); 
    }
    
    /**
     * Menampilkan form untuk mengedit layanan surat.
     */
    public function edit(LetterService $letterService)
    {
        return view('pages.layanan-surat.letter-services.edit', compact('letterService'));
    }

    /**
     * Memperbarui layanan surat di database.
     */
    public function update(Request $request, LetterService $letterService)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('letter_services')->ignore($letterService->id)],
            'requirements' => 'required|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $originalSlug = $validated['slug']; $count = 1;
        while (LetterService::where('slug', $validated['slug'])->where('id', '!=', $letterService->id)->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count++;
        }
        $validated['user_id'] = auth()->id();

        $letterService->update($validated);
        return redirect('/letter-services')->with('success', 'Jenis layanan surat berhasil diperbarui!');
    }

    /**
     * Menghapus layanan surat dari database.
     */
    public function destroy(LetterService $letterService)
    {
        $letterService->delete();
        return redirect('/letter-services')->with('success', 'Jenis layanan surat berhasil dihapus!');
    }
}