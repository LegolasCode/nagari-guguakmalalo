<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PopulasiTernak;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeternakanController extends Controller
{
    public function populasiTernakPublic(Request $request)
    {
        $query = PopulasiTernak::query();

        // Tambahkan fitur pencarian dan filter tahun jika diperlukan
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('jenis_ternak', 'like', '%' . $search . '%');
        }
        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun', $request->tahun);
        }

        // Ambil data dengan pagination, 10 data per halaman
        $populasiTernak = $query->orderBy('tahun', 'desc')->orderBy('jenis_ternak')->paginate(10);

        // Ambil tahun unik untuk filter
        $availableYears = PopulasiTernak::select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // Data untuk Grafik Populasi Ternak
        $availableYearsPopulasiTernak = PopulasiTernak::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        $selectedYearPopulasiTernak = $request->input('tahun_populasi_ternak', $availableYearsPopulasiTernak->first() ?? Carbon::now()->year);
        
        $populasiTernakData = PopulasiTernak::select('jenis_ternak', DB::raw('SUM(total_ternak) as total_jumlah'))
                                           ->where('tahun', $selectedYearPopulasiTernak)
                                           ->groupBy('jenis_ternak')
                                           ->orderBy('jenis_ternak')
                                           ->get();

        $labelsPopulasiTernak = $populasiTernakData->pluck('jenis_ternak')->toArray();
        $valuesPopulasiTernak = $populasiTernakData->pluck('total_jumlah')->toArray();


        return view('user.pages.peternakan.index', compact('populasiTernak', 'availableYears', 'availableYearsPopulasiTernak', 'selectedYearPopulasiTernak', 'populasiTernakData', 'labelsPopulasiTernak', 'valuesPopulasiTernak'));
    }
}
