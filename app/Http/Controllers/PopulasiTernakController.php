<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PopulasiTernak; // Import Model
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PopulasiTernakController extends Controller
{
    /**
     * Menampilkan daftar Populasi Ternak.
     */
    public function index(Request $request)
    {
        $query = PopulasiTernak::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('jenis_ternak', 'like', '%' . $search . '%');
        }
        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun', $request->tahun);
        }

        $populasiTernak = $query->paginate(10);
        return view('populasi-ternak.index', compact('populasiTernak'));
    }

    /**
     * Menampilkan form untuk membuat Populasi Ternak baru.
     */
    public function create()
    {
        return view('populasi-ternak.create');
    }

    /**
     * Menyimpan Populasi Ternak baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_ternak' => 'required|string|max:255',
            'jumlah_duo_koto' => 'required|integer|min:0',
            'jumlah_guguak' => 'required|integer|min:0',
            'jumlah_baiang' => 'required|integer|min:0',
            'tahun' => 'nullable|integer|digits:4',
        ]);

        $validated['user_id'] = auth()->id();

        PopulasiTernak::create($validated);
        return redirect()->route('populasi-ternak.index')->with('success', 'Data Populasi Ternak berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit Populasi Ternak.
     */
    public function edit(PopulasiTernak $populasiTernak) // Route Model Binding
    {
        return view('populasi-ternak.edit', compact('populasiTernak'));
    }

    /**
     * Memperbarui Populasi Ternak.
     */
    public function update(Request $request, PopulasiTernak $populasiTernak) // Route Model Binding
    {
        $validated = $request->validate([
            'jenis_ternak' => 'required|string|max:255',
            'jumlah_duo_koto' => 'required|integer|min:0',
            'jumlah_guguak' => 'required|integer|min:0',
            'jumlah_baiang' => 'required|integer|min:0',
            'tahun' => 'nullable|integer|digits:4',
        ]);

        $validated['user_id'] = auth()->id();

        $populasiTernak->update($validated);
        return redirect()->route('populasi-ternak.index')->with('success', 'Data Populasi Ternak berhasil diperbarui!');
    }

    /**-
     * Menghapus Populasi Ternak.
     */
    public function destroy(PopulasiTernak $populasiTernak) // Route Model Binding
    {
        $populasiTernak->delete();
        return redirect()->route('populasi-ternak.index')->with('success', 'Data Populasi Ternak berhasil dihapus!');
    }
}