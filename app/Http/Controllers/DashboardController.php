<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;

class DashboardController extends Controller
{
    // Fungsi untuk menampilkan halaman dashboard
    public function index()
    {
        $totalResidents = Resident::count();

        return view('pages.dashboard', compact('totalResidents'));
    }
}
