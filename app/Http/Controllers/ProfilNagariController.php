<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisi;
use App\Models\VillageOfficial; // Pastikan ini diimpor
use App\Models\ContentPage;

class ProfilNagariController extends Controller
{
    public function ProfilNagariView()
    {
        $visi = VisiMisi::where('type', 'visi')->first();

        $misiItems = VisiMisi::where('type', 'misi')->orderBy('order')->get();

        // Ambil data officials di sini, sebelum return
        $officials = VillageOfficial::orderBy('order')->orderBy('name')->take(4)->get();

        $strukturBagan = ContentPage::where('type', 'struktur_bagan')->first();

        // Hanya ada satu return statement yang meneruskan semua variabel
        return view('user.pages.profil-nagari', compact('visi', 'misiItems', 'officials', 'strukturBagan'));

    }


    public function perangkatNagariView()
    {
        $allOfficials = VillageOfficial::orderBy('order')->orderBy('name')->get(); // Atau ->get() jika tidak pakai pagination
        return view('user.pages.perangkat-nagari', compact('allOfficials')); // Pastikan variabelnya benar di view ini
    }

    public function sejarahNagariView()
    {
        return view('user.pages.sejarah-nagari');
    }
    
}