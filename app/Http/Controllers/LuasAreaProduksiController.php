<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LuasAreaProduksi; // Import Model
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LuasAreaProduksiController extends Controller
{
    /**
     * Menampilkan daftar Luas Area Produksi.
     */
    public function index(Request $request)
    {
        $query = LuasAreaProduksi::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_komoditi', 'like', '%' . $search . '%')
                  ->orWhere('tipe_area', 'like', '%' . $search . '%');
        }
        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun', $request->tahun);
        }

        $luasAreaProduksi = $query->paginate(10);
        return view('luas-area-produksi.index', compact('luasAreaProduksi'));
    }

    /**
     * Menampilkan form untuk membuat Luas Area Produksi baru.
     */
    public function create()
    {
        return view('luas-area-produksi.create');
    }

    /**
     * Menyimpan Luas Area Produksi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_komoditi' => 'required|string|max:255',
            'tipe_area' => ['required', Rule::in(['Sawah', 'Tanaman Palawija'])],
            'luas_tanam' => 'required|numeric|min:0',
            'luas_panen' => 'required|numeric|min:0',
            'produksi' => 'required|numeric|min:0',
            'tahun' => 'nullable|integer|digits:4',
        ]);

        $validated['user_id'] = auth()->id();

        LuasAreaProduksi::create($validated);
        return redirect()->route('luas-area-produksi.index')->with('success', 'Data Luas Area Produksi berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit Luas Area Produksi.
     */
    public function edit(LuasAreaProduksi $luasAreaProduksi) // Route Model Binding
    {
        return view('luas-area-produksi.edit', compact('luasAreaProduksi'));
    }

    /**
     * Memperbarui Luas Area Produksi.
     */
    public function update(Request $request, LuasAreaProduksi $luasAreaProduksi) // Route Model Binding
    {
        $validated = $request->validate([
            'nama_komoditi' => 'required|string|max:255',
            'tipe_area' => ['required', Rule::in(['Sawah', 'Tanaman Palawija'])],
            'luas_tanam' => 'required|numeric|min:0',
            'luas_panen' => 'required|numeric|min:0',
            'produksi' => 'required|numeric|min:0',
            'tahun' => 'nullable|integer|digits:4',
        ]);

        $validated['user_id'] = auth()->id();

        $luasAreaProduksi->update($validated);
        return redirect()->route('luas-area-produksi.index')->with('success', 'Data Luas Area Produksi berhasil diperbarui!');
    }

    /**
     * Menghapus Luas Area Produksi.
     */
    public function destroy(LuasAreaProduksi $luasAreaProduksi) // Route Model Binding
    {
        $luasAreaProduksi->delete();
        return redirect()->route('luas-area-produksi.index')->with('success', 'Data Luas Area Produksi berhasil dihapus!');
    }
}