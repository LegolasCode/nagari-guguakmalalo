<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilNagariController extends Controller
{
    public function ProfilNagariView()
    {
        return view('user.pages.profil-nagari');
    }
    public function perangkatNagariView() // Metode baru
    {
        return view('user.pages.perangkat-nagari'); // Untuk sementara tanpa data
    }
}

