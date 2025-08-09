@extends('user.layout.app')

@section('title', 'Guguak Malalo | Potensi Pertanian')

@section('content')
<div class="container py-5">
    <h2 class="text-center fw-bold mb-4">Potensi Pertanian Nagari</h2>
    <p class="text-center lead mb-5 mx-auto" style="max-width: 800px;">
        Nagari Guguak Malalo memiliki lahan subur dan sumber daya alam melimpah yang menopang sektor pertanian sebagai salah satu pilar ekonomi utama. Berbagai komoditi unggulan dihasilkan melalui praktik pertanian berkelanjutan oleh para petani.
    </p>

    <hr class="my-5">

    {{-- Grafik Produksi Pertanian --}}
    <div class="row">
        <div class="col-xl-6 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Produksi Pertanian (Ton) per Komoditi</h6>
                    <div class="dropdown no-arrow">
                        <form action="{{ route('pages.dashboard') }}" method="GET" class="d-flex align-items-center">
                            <label for="tahun_produksi" class="me-2 text-muted small">Filter Tahun:</label>
                            <select name="tahun_produksi" id="tahun_produksi" class="form-select form-select-sm" onchange="this.form.submit()">
                                @foreach ($availableYearsProduksi as $year)
                                    <option value="{{ $year }}" {{ $selectedYearProduksi == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="height: 400px;">
                        <canvas id="produksiPertanianBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik Populasi Tanaman --}}
        <div class="col-xl-6 col-lg-7"> 
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Populasi Tanaman</h6>
                    <div class="dropdown no-arrow">
                        <form action="{{ route('pages.dashboard') }}" method="GET" class="d-flex align-items-center">
                            <label for="tahun_populasi_tanaman" class="me-2 text-muted small">Filter Tahun:</label>
                            <select name="tahun_populasi_tanaman" id="tahun_populasi_tanaman" class="form-select form-select-sm" onchange="this.form.submit()">
                                @foreach ($availableYearsPopulasiTanaman as $year)
                                    <option value="{{ $year }}" {{ $selectedYearPopulasiTanaman == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="height: 400px;">
                        <canvas id="populasiTanamanBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
        {{-- Card Kelembagaan Tani --}}
        <div class="col">
            <div class="card shadow-sm h-100 d-flex flex-column justify-content-center text-center">
                <div class="card-body p-4">
                    <i class="fa-solid fa-seedling fa-4x text-success mb-3"></i>
                    <h3 class="card-title display-5 fw-bold text-success">{{ number_format($totalKelembagaanTani) }}</h3>
                    <p class="card-text fs-5">Kelembagaan Tani</p>
                    <a href="{{ route('user.pages.pertanian.kelembagaan-tani') }}" class="btn btn-sm btn-custom-readmore mt-3">Lihat Detail</a> {{-- Arahkan ke halaman detail jika ada --}}
                </div>
            </div>
        </div>

        {{-- Card Luas Area Produksi --}}
        <div class="col">
            <div class="card shadow-sm h-100 d-flex flex-column justify-content-center text-center">
                <div class="card-body p-4">
                    <i class="fa-solid fa-chart-area fa-4x text-success mb-3"></i>
                    <h3 class="card-title display-5 fw-bold text-success">{{ number_format($totalLuasAreaProduksi) }}</h3>
                    <p class="card-text fs-5">Luas Area Produksi</p>
                    <a href="{{ route('user.pages.pertanian.luas-area-produksi') }}" class="btn btn-sm btn-custom-readmore mt-3">Lihat Detail</a>
                </div>
            </div>
        </div>

        {{-- Card Populasi Tanaman --}}
        <div class="col">
            <div class="card shadow-sm h-100 d-flex flex-column justify-content-center text-center">
                <div class="card-body p-4">
                    <i class="fa-solid fa-tree fa-4x text-success mb-3"></i>
                    <h3 class="card-title display-5 fw-bold text-success">{{ number_format($totalPopulasiTanaman) }}</h3>
                    <p class="card-text fs-5">Populasi Tanaman</p>
                    <a href="{{ route('user.pages.pertanian.populasi-tanaman') }}" class="btn btn-sm btn-custom-readmore mt-3">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data Produksi Pertanian dari PHP
        const labelsProduksi = @json($labelsProduksi);
        const valuesProduksi = @json($valuesProduksi);

        console.log('Labels Produksi (dari PHP):', labelsProduksi);
        console.log('Values Produksi (dari PHP):', valuesProduksi);

        // === SCRIPT UNTUK GRAFIK PRODUKSI PERTANIAN ===
        const ctxProduksi = document.getElementById("produksiPertanianBarChart");
        if (ctxProduksi) {
            new Chart(ctxProduksi, {
                type: 'bar',
                data: {
                    labels: labelsProduksi,
                    datasets: [{
                        label: "Produksi",
                        backgroundColor: "#1cc88a",
                        hoverBackgroundColor: "#17a673",
                        borderColor: "#4e73df",
                        data: valuesProduksi,
                        maxBarThickness: 25,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: { left: 10, right: 25, top: 25, bottom: 0 }
                    },
                    scales: {
                        xAxes: [{
                            gridLines: { display: false, drawBorder: false },
                            ticks: { maxTicksLimit: labelsProduksi.length > 0 ? labelsProduksi.length : 1 },
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                maxTicksLimit: 5,
                                padding: 10,
                                callback: function(value, index, values) {
                                    return number_format_display(value, 2) + ' Ton';
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: { display: false },
                    tooltips: {
                        enabled: true,
                        mode: 'index',
                        intersect: false,
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                console.log('TooltipItem:', tooltipItem);
                                console.log('tooltipItem.yLabel:', tooltipItem.yLabel);

                                if (chart.data && chart.data.labels && chart.data.labels[tooltipItem.index] !== undefined) {
                                    var label = chart.data.labels[tooltipItem.index] || '';
                                    var value = tooltipItem.yLabel;
                                    return label + ': ' + number_format_display(value, 2) + ' Ton';
                                }
                                return '';
                            }
                        }
                    },
                }
            });
        }

        // === SCRIPT BARU UNTUK GRAFIK POPULASI TANAMAN ===
        // Data Populasi Tanaman dari PHP
        const labelsPopulasiTanaman = @json($labelsPopulasiTanaman);
        const valuesPopulasiTanaman = @json($valuesPopulasiTanaman); // <-- Ini variabelnya

        console.log('Labels Populasi Tanaman (dari PHP):', labelsPopulasiTanaman);
        console.log('Values Populasi Tanaman (dari PHP):', valuesPopulasiTanaman);

        const ctxPopulasiTanaman = document.getElementById("populasiTanamanBarChart");
        
        // --- PERBAIKAN DI SINI: Hapus if yang berulang dan pastikan satu blok if {} ---
        if (ctxPopulasiTanaman) {
            console.log('Canvas Populasi Tanaman Width:', ctxPopulasiTanaman.width);
            console.log('Canvas Populasi Tanaman Height:', ctxPopulasiTanaman.height);
            
            new Chart(ctxPopulasiTanaman, {
                type: 'bar',
                data: {
                    labels: labelsPopulasiTanaman,
                    datasets: [{
                        label: "Populasi",
                        backgroundColor: "#1cc88a",
                        hoverBackgroundColor: "#17a673",
                        borderColor: "#1cc88a",
                        data: valuesPopulasiTanaman,
                        maxBarThickness: 25,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: { left: 10, right: 25, top: 25, bottom: 0 }
                    },
                    scales: {
                        xAxes: [{
                            gridLines: { display: false, drawBorder: false },
                            ticks: { maxTicksLimit: labelsPopulasiTanaman.length > 0 ? labelsPopulasiTanaman.length : 1 },
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                maxTicksLimit: 5,
                                padding: 10,
                                callback: function(value, index, values) {
                                    return number_format_display(value, 0) + ' Unit';
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: { display: false },
                    tooltips: {
                        enabled: true,
                        mode: 'index',
                        intersect: false,
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                if (chart.data && chart.data.labels && chart.data.labels[tooltipItem.index] !== undefined) {
                                    var label = chart.data.labels[tooltipItem.index] || '';
                                    var value = tooltipItem.yLabel;
                                    return label + ': ' + number_format_display(value, 0) + ' Unit';
                                }
                                return '';
                            }
                        }
                    },
                }
            });
        }

        // Helper function for number formatting (pastikan ini ada dan berfungsi)
        function number_format_display(number, decimals, dec_point, thousands_sep) {
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number;
            
            dec_point = (typeof dec_point === 'undefined') ? ',' : dec_point;
            thousands_sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep;

            var finalPrec = 0;
            if (typeof decimals === 'number' && decimals !== null) {
                finalPrec = Math.abs(decimals);
            } else {
                finalPrec = (n % 1 !== 0) ? 2 : 0;
            }

            var s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            s = (finalPrec ? toFixedFix(n, finalPrec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, thousands_sep);
            }
            if ((s[1] || '').length < finalPrec) {
                s[1] = s[1] || '';
                s[1] += new Array(finalPrec - s[1].length + 1).join('0');
            }
            return s.join(dec_point);
        }
    });
</script>
@endpush