<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContentPage; 
use App\Models\Document; 
use Illuminate\Http\Request;

class HukumController extends Controller
{
    public function index()
    {
        // Untuk menampilkan jumlah di card (opsional)
        $totalDocuments = Document::count();

        return view('pages.law.index', compact('totalDocuments'));
    }

    public function editPosbankum()
    {
        $posbankum = ContentPage::firstOrCreate(
            ['type' => 'posbankum_image'],
            ['title' => 'Gambar Posbankum', 'body' => 'Gambar promosi Posbankum.']
        );
        return view('pages.law.edit-posbankum', compact('posbankum'));
    }

    /**
     * Memperbarui gambar Posbankum.
     */
    public function updatePosbankum(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ]);
        
        $posbankum = ContentPage::where('type', 'posbankum_image')->firstOrFail();
        
        if ($posbankum->image) {
            Storage::disk('public')->delete($posbankum->image);
        }
        $imagePath = $request->file('image')->store('content_pages', 'public');
        $posbankum->update(['image' => $imagePath]);
        
        return redirect()->route('law.index')->with('success', 'Gambar Posbankum berhasil diperbarui!');
    }
}