<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;

class DashboardController extends Controller
{
    public function index()
    {
        $totalResidents = Resident::count();

        return view('pages.dashboard', compact('totalResidents'));
    }
}
