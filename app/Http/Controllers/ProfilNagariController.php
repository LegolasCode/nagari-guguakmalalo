<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisi;
use App\Models\VillageOfficial; // Pastikan ini diimpor

class ProfilNagariController extends Controller
{
    public function ProfilNagariView()
    {
        $visi = VisiMisi::where('type', 'visi')->first();

        $misiItems = VisiMisi::where('type', 'misi')->orderBy('order')->get();

        // Ambil data officials di sini, sebelum return
        $officials = VillageOfficial::orderBy('order')->orderBy('name')->take(4)->get();

        // Hanya ada satu return statement yang meneruskan semua variabel
        return view('user.pages.profil-nagari', compact('visi', 'misiItems', 'officials'));
    }


    public function perangkatNagariView()
    {
        $officials = VillageOfficial::orderBy('order')->orderBy('name')->get(); // Changed variable name here

        // Pass the variable named $officials to the view
        return view('user.pages.perangkat-nagari', compact('officials')); // Now it matches the Blade loop
    }

    public function sejarahNagariView()
    {
        return view('user.pages.sejarah-nagari');
    }
}