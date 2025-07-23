<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PopulasiTanaman;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage; 

class PopulasiTanamanController extends Controller
{
    public function index(Request $request)
    {
        $query = PopulasiTanaman::query();
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_komoditi', 'like', '%' . $search . '%')->orWhere('tipe_tanaman', 'like', '%' . $search . '%');
        }
        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun', $request->tahun);
        }
        $populasiTanaman = $query->paginate(10);

        $availableYears = PopulasiTanaman::select('tahun')
        ->distinct() // Ambil nilai tahun yang unik
        ->orderBy('tahun', 'desc') // Urutkan dari tahun terbaru
        ->pluck('tahun'); // Ambil hanya kolom 'tahun'

        return view('pages.pertanian-peternakan.populasi-tanaman.index', compact('populasiTanaman', 'availableYears'));
    }

    public function create() { return view('pages.pertanian-peternakan.populasi-tanaman.create'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_komoditi' => 'required|string|max:255',
            'tipe_tanaman' => ['required', Rule::in(['Buah-buahan', 'Perkebunan'])],
            'jumlah_duo_koto' => 'required|integer|min:0',
            'jumlah_guguak' => 'required|integer|min:0',
            'jumlah_baiang' => 'required|integer|min:0',
            'tahun' => 'nullable|integer|digits:4',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi image
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images/populasi-tanaman', 'public');
        }

        $validated['user_id'] = auth()->id();
        PopulasiTanaman::create($validated);
        return redirect('/populasi-tanaman')->with('success', 'Data Populasi Tanaman berhasil ditambahkan!');
    }

    public function edit(PopulasiTanaman $populasiTanaman) { return view('pages.pertanian-peternakan.populasi-tanaman.edit', compact('populasiTanaman')); }

    public function update(Request $request, PopulasiTanaman $populasiTanaman)
    {
        $validated = $request->validate([
            'nama_komoditi' => 'required|string|max:255',
            'tipe_tanaman' => ['required', Rule::in(['Buah-buahan', 'Perkebunan'])],
            'jumlah_duo_koto' => 'required|integer|min:0',
            'jumlah_guguak' => 'required|integer|min:0',
            'jumlah_baiang' => 'required|integer|min:0',
            'tahun' => 'nullable|integer|digits:4',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_image' => 'nullable|boolean',
        ]);

        $imagePath = $populasiTanaman->image;

        if ($request->hasFile('image')) {
            if ($imagePath) { Storage::disk('public')->delete($imagePath); }
            $imagePath = $request->file('image')->store('images/populasi-tanaman', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($imagePath) { Storage::disk('public')->delete($imagePath); }
            $imagePath = null;
        } else {
            unset($validated['image']);
        }

        $validated['user_id'] = auth()->id();
        $populasiTanaman->update($validated);
        $populasiTanaman->image = $imagePath; // Set kembali path gambar di model
        $populasiTanaman->save();

        return redirect('/populasi-tanaman')->with('success', 'Data Populasi Tanaman berhasil diperbarui!');
    }

    public function destroy(PopulasiTanaman $populasiTanaman)
    {
        if ($populasiTanaman->image) { Storage::disk('public')->delete($populasiTanaman->image); }
        $populasiTanaman->delete();
        return redirect('/populasi-tanaman')->with('success', 'Data Populasi Tanaman berhasil dihapus!');
    }
}