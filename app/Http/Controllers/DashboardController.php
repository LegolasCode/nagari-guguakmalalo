<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\VillageOfficial; 
use App\Models\Gallery;
use App\Models\Umkm; 
use App\Models\LuasAreaProduksi;
use App\Models\PopulasiTanaman;
use App\Models\PopulasiTernak;
use App\Models\KelembagaanTani;
use App\Models\TourismSpot;
use App\Models\HealthFacility;
use App\Models\LetterService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Fungsi untuk menampilkan halaman dashboard
    public function index(Request $request)
    {
        $totalResidents = Resident::count();

        // Statistik Jumlah Pengurus Nagari
        $totalOfficials = VillageOfficial::count();

        // Statistik Jumlah Foto Galeri
        $totalGalleryPhotos = Gallery::count();

        // Statistik Jumlah UMKM
        $totalUmkms = Umkm::count();

        // Statistik Jumlah Layanan Surat
        $totalLetterServices = LetterService::count();

        // Statistik Jumlah Kelembagaan Tani
        $totalKelembagaanTani = KelembagaanTani::count();

        // Statistik Jumlah Wisata
        $totalTourismSpot = TourismSpot::count();

        // Statistik Jumlah Kesehatan
        $totalHealthFacility = HealthFacility::count();

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

        return view('pages.dashboard', compact('totalResidents', 
        'totalOfficials', 
        'totalGalleryPhotos', 
        'totalUmkms',
        'totalLetterServices', 
        'totalKelembagaanTani', 
        'totalTourismSpot', 
        'totalHealthFacility',
        'labelsProduksi', 
        'valuesProduksi', 
        'selectedYearProduksi', 
        'availableYearsProduksi',
        'labelsPopulasiTanaman',
        'valuesPopulasiTanaman',
        'selectedYearPopulasiTanaman',
        'availableYearsPopulasiTanaman',
        'labelsPopulasiTernak',           
        'valuesPopulasiTernak',           
        'selectedYearPopulasiTernak',     
        'availableYearsPopulasiTernak'
    ));
    }
}
