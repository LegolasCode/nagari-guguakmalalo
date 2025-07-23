<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PopulasiTernak;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage; // Pastikan ini diimpor

class PopulasiTernakController extends Controller
{
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

        $availableYears = PopulasiTernak::select('tahun')
        ->distinct() // Ambil nilai tahun yang unik
        ->orderBy('tahun', 'desc') // Urutkan dari tahun terbaru
        ->pluck('tahun'); // Ambil hanya kolom 'tahun'
        
        return view('pages.pertanian-peternakan.populasi-ternak.index', compact('populasiTernak', 'availableYears'));
    }

    public function create() { return view('pages.pertanian-peternakan.populasi-ternak.create'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_ternak' => 'required|string|max:255',
            'jumlah_duo_koto' => 'required|integer|min:0',
            'jumlah_guguak' => 'required|integer|min:0',
            'jumlah_baiang' => 'required|integer|min:0',
            'tahun' => 'nullable|integer|digits:4',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi image
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images/populasi-ternak', 'public');
        }

        $validated['user_id'] = auth()->id();
        PopulasiTernak::create($validated);
        return redirect('/populasi-ternak')->with('success', 'Data Populasi Ternak berhasil ditambahkan!');
    }

    public function edit(PopulasiTernak $populasiTernak) { return view('pages.pertanian-peternakan.populasi-ternak.edit', compact('populasiTernak')); }

    public function update(Request $request, PopulasiTernak $populasiTernak)
    {
        $validated = $request->validate([
            'jenis_ternak' => 'required|string|max:255',
            'jumlah_duo_koto' => 'required|integer|min:0',
            'jumlah_guguak' => 'required|integer|min:0',
            'jumlah_baiang' => 'required|integer|min:0',
            'tahun' => 'nullable|integer|digits:4',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_image' => 'nullable|boolean',
        ]);

        $imagePath = $populasiTernak->image;

        if ($request->hasFile('image')) {
            if ($imagePath) { Storage::disk('public')->delete($imagePath); }
            $imagePath = $request->file('image')->store('images/populasi_ternak', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($imagePath) { Storage::disk('public')->delete($imagePath); }
            $imagePath = null;
        } else {
            unset($validated['image']);
        }

        $validated['user_id'] = auth()->id();
        $populasiTernak->update($validated);
        $populasiTernak->image = $imagePath; // Set kembali path gambar di model
        $populasiTernak->save();

        return redirect('/populasi-ternak')->with('success', 'Data Populasi Ternak berhasil diperbarui!');
    }

    public function destroy(PopulasiTernak $populasiTernak)
    {
        if ($populasiTernak->image) { Storage::disk('public')->delete($populasiTernak->image); }
        $populasiTernak->delete();
        return redirect('/populasi-ternak')->with('success', 'Data Populasi Ternak berhasil dihapus!');
    }
}