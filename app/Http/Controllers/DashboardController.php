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

        // Statistik Jumlah Kelembagaan Tani
        $totalKelembagaanTani = KelembagaanTani::count();

        // Statistik Jumlah Wisata
        $totalTourismSpot = TourismSpot::count();

        // Statistik Jumlah Kesehatan
        $totalHealthFacility = HealthFacility::count();

        // Data untuk Grafik Produksi Pertanian (Semua Komoditi)
        // Filter tahun untuk produksi pertanian
        $selectedYearProduksi = $request->input('tahun_produksi', Carbon::now()->year);

        $produksiData = LuasAreaProduksi::select('nama_komoditi', DB::raw('SUM(produksi) as total_produksi'))
                                        ->where('tahun', $selectedYearProduksi)
                                        ->groupBy('nama_komoditi')
                                        ->orderBy('nama_komoditi') // Urutkan berdasarkan nama komoditi agar konsisten
                                        ->get();

        $labelsProduksi = $produksiData->pluck('nama_komoditi')->toArray();
        $valuesProduksi = $produksiData->pluck('total_produksi')->toArray();

        // Mengambil daftar tahun unik dari database LuasAreaProduksi untuk dropdown filter
        $availableYearsProduksi = LuasAreaProduksi::select('tahun')
                                                ->distinct()
                                                ->orderBy('tahun', 'desc')
                                                ->pluck('tahun');
        
        // Jika tidak ada data tahun di DB LuasAreaProduksi, tambahkan tahun sekarang
        if ($availableYearsProduksi->isEmpty()) {
            $availableYearsProduksi = collect([Carbon::now()->year]);
        }

        // Data untuk Grafik Populasi Tanaman 
        $selectedYearPopulasiTanaman = $request->input('tahun_populasi_tanaman', $selectedYearProduksi); // Default ke tahun produksi
        
        $populasiTanamanData = PopulasiTanaman::select('nama_komoditi', DB::raw('SUM(total_populasi) as total_jumlah'))
                                             ->where('tahun', $selectedYearPopulasiTanaman)
                                             ->groupBy('nama_komoditi')
                                             ->orderBy('nama_komoditi')
                                             ->get();

        $labelsPopulasiTanaman = $populasiTanamanData->pluck('nama_komoditi')->toArray();
        $valuesPopulasiTanaman = $populasiTanamanData->pluck('total_jumlah')->toArray();

        // Mengambil daftar tahun unik dari database PopulasiTanaman untuk dropdown filter
        $availableYearsPopulasiTanaman = PopulasiTanaman::select('tahun')
                                                      ->distinct()
                                                      ->orderBy('tahun', 'desc')
                                                      ->pluck('tahun');
        if ($availableYearsPopulasiTanaman->isEmpty()) {
            $availableYearsPopulasiTanaman = collect([Carbon::now()->year]);
        }
 
        return view('pages.dashboard', compact('totalResidents', 
        'totalOfficials', 
        'totalGalleryPhotos', 
        'totalUmkms', 
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
        'availableYearsPopulasiTanaman'
    ));
    }
}
