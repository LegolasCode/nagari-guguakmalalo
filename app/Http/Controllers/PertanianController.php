<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelembagaanTani; // Import model KelembagaanTani
use App\Models\LuasAreaProduksi; // Import model LuasAreaProduksi
use App\Models\PopulasiTanaman; // Import model PopulasiTanaman
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PertanianController extends Controller
{
    /**
     * Menampilkan halaman indeks publik untuk fitur pertanian.
     */
    public function indexPublic(Request $request)
    {
        // Ambil jumlah data untuk masing-masing kategori
        $totalKelembagaanTani = KelembagaanTani::count();
        $totalLuasAreaProduksi = LuasAreaProduksi::count();
        $totalPopulasiTanaman = PopulasiTanaman::count();

        // Data untuk Grafik Produksi Pertanian (Semua Komoditi) 
        $availableYearsProduksi = LuasAreaProduksi::select('tahun')
                                                ->distinct()
                                                ->orderBy('tahun', 'desc')
                                                ->pluck('tahun');
        
        // Tentukan tahun yang dipilih secara default
        $selectedYearProduksi = $request->input('tahun_produksi');
        if (empty($selectedYearProduksi)) {
            $selectedYearProduksi = $availableYearsProduksi->first() ?? Carbon::now()->year;
        }

        $produksiData = LuasAreaProduksi::select('nama_komoditi', DB::raw('SUM(produksi) as total_produksi'))
                                        ->where('tahun', $selectedYearProduksi)
                                        ->groupBy('nama_komoditi')
                                        ->orderBy('nama_komoditi')
                                        ->get();
                                        
        $labelsProduksi = $produksiData->pluck('nama_komoditi')->toArray();
        $valuesProduksi = $produksiData->pluck('total_produksi')->toArray();

        // Data untuk Grafik Populasi Tanaman 
        $availableYearsPopulasiTanaman = PopulasiTanaman::select('tahun')
                                                      ->distinct()
                                                      ->orderBy('tahun', 'desc')
                                                      ->pluck('tahun');
        
        // Tentukan tahun yang dipilih secara default
        $selectedYearPopulasiTanaman = $request->input('tahun_populasi_tanaman');
        if (empty($selectedYearPopulasiTanaman)) {
            $selectedYearPopulasiTanaman = $availableYearsPopulasiTanaman->first() ?? Carbon::now()->year;
        }
        
        $populasiTanamanData = PopulasiTanaman::select('nama_komoditi', DB::raw('SUM(total_populasi) as total_jumlah'))
                                             ->where('tahun', $selectedYearPopulasiTanaman)
                                             ->groupBy('nama_komoditi')
                                             ->orderBy('nama_komoditi')
                                             ->get();
        $labelsPopulasiTanaman = $populasiTanamanData->pluck('nama_komoditi')->toArray();
        $valuesPopulasiTanaman = $populasiTanamanData->pluck('total_jumlah')->toArray();

        return view('user.pages.pertanian.index', compact(
            'totalKelembagaanTani',
            'totalLuasAreaProduksi',
            'totalPopulasiTanaman',
            'selectedYearProduksi',
            'labelsProduksi',
            'valuesProduksi', 
            'availableYearsProduksi',
            'labelsPopulasiTanaman',
            'valuesPopulasiTanaman',
            'selectedYearPopulasiTanaman',
            'availableYearsPopulasiTanaman'
        ));
    }

    public function kelembagaanTaniPublic(Request $request)
    {
        $query = KelembagaanTani::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_poktan', 'like', '%' . $search . '%') 
                  ->orWhere('kelas_kemampuan', 'like', '%' . $search . '%'); 
        }

        $kelembagaanTani = $query->paginate(10);

        return view('user.pages.pertanian.kelembagaan-tani', compact('kelembagaanTani'));
    }

    public function luasAreaProduksiPublic(Request $request)
    {
        $query = LuasAreaProduksi::query();

        // Tambahkan fitur pencarian dan filter tahun jika diperlukan
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_komoditi', 'like', '%' . $search . '%')
                  ->orWhere('tipe_area', 'like', '%' . $search . '%');
        }
        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun', $request->tahun);
        }

        // Ambil data dengan pagination, 10 data per halaman
        $luasAreaProduksi = $query->orderBy('tahun', 'desc')->orderBy('nama_komoditi')->paginate(9);

        // Ambil tahun unik untuk filter
        $availableYears = LuasAreaProduksi::select('tahun')
                                        ->distinct()
                                        ->orderBy('tahun', 'desc')
                                        ->pluck('tahun');

        return view('user.pages.pertanian.luas-area-produksi', compact('luasAreaProduksi', 'availableYears'));
    }

    public function populasiTanamanPublic(Request $request)
    {
        $query = PopulasiTanaman::query();

        // Tambahkan fitur pencarian dan filter tahun jika diperlukan
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_komoditi', 'like', '%' . $search . '%')
                  ->orWhere('tipe_tanaman', 'like', '%' . $search . '%');
        }
        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun', $request->tahun);
        }

        // Ambil data dengan pagination, 10 data per halaman
        $populasiTanaman = $query->orderBy('tahun', 'desc')->orderBy('nama_komoditi')->paginate(9);

        // Ambil tahun unik untuk filter
        $availableYears = PopulasiTanaman::select('tahun')
                                        ->distinct()
                                        ->orderBy('tahun', 'desc')
                                        ->pluck('tahun');

        return view('user.pages.pertanian.populasi-tanaman', compact('populasiTanaman', 'availableYears'));
    }
}