<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PopulasiTanaman; // Import Model
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PopulasiTanamanController extends Controller
{
    /**
     * Menampilkan daftar Populasi Tanaman.
     */
    public function index(Request $request)
    {
        $query = PopulasiTanaman::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_komoditi', 'like', '%' . $search . '%')
                  ->orWhere('tipe_tanaman', 'like', '%' . $search . '%');
        }
        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun', $request->tahun);
        }

        $populasiTanaman = $query->paginate(10);
        return view('populasi-tanaman.index', compact('populasiTanaman'));
    }

    /**
     * Menampilkan form untuk membuat Populasi Tanaman baru.
     */
    public function create()
    {
        return view('populasi-tanaman.create');
    }

    /**
     * Menyimpan Populasi Tanaman baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_komoditi' => 'required|string|max:255',
            'tipe_tanaman' => ['required', Rule::in(['Buah-buahan', 'Perkebunan'])],
            'jumlah_duo_koto' => 'required|integer|min:0',
            'jumlah_guguak' => 'required|integer|min:0',
            'jumlah_baiang' => 'required|integer|min:0',
            'tahun' => 'nullable|integer|digits:4',
        ]);

        $validated['user_id'] = auth()->id();

        PopulasiTanaman::create($validated);
        return redirect()->route('populasi-tanaman.index')->with('success', 'Data Populasi Tanaman berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit Populasi Tanaman.
     */
    public function edit(PopulasiTanaman $populasiTanaman) // Route Model Binding
    {
        return view('populasi-tanaman.edit', compact('populasiTanaman'));
    }

    /**
     * Memperbarui Populasi Tanaman.
     */
    public function update(Request $request, PopulasiTanaman $populasiTanaman) // Route Model Binding
    {
        $validated = $request->validate([
            'nama_komoditi' => 'required|string|max:255',
            'tipe_tanaman' => ['required', Rule::in(['Buah-buahan', 'Perkebunan'])],
            'jumlah_duo_koto' => 'required|integer|min:0',
            'jumlah_guguak' => 'required|integer|min:0',
            'jumlah_baiang' => 'required|integer|min:0',
            'tahun' => 'nullable|integer|digits:4',
        ]);

        $validated['user_id'] = auth()->id();

        $populasiTanaman->update($validated);
        return redirect()->route('populasi-tanaman.index')->with('success', 'Data Populasi Tanaman berhasil diperbarui!');
    }

    /**
     * Menghapus Populasi Tanaman.
     */
    public function destroy(PopulasiTanaman $populasiTanaman) // Route Model Binding
    {
        $populasiTanaman->delete();
        return redirect()->route('populasi-tanaman.index')->with('success', 'Data Populasi Tanaman berhasil dihapus!');
    }
}