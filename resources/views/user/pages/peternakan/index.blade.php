@extends('user.layout.app')

@section('title', 'Guguak Malalo | Potensi Peternakan')

@section('content')
<div class="container py-5">
    <h2 class="text-center fw-bold mb-4">Data Populasi Ternak</h2>
    <p class="text-center lead mb-5 mx-auto" style="max-width: 800px;">
        Informasi mengenai populasi hewan ternak di berbagai wilayah Nagari Guguak Malalo setiap tahunnya.
    </p>

    <div class="row">
        {{-- Tampilan Card untuk Populasi Ternak (kanan) --}}
        <div class="col-lg-7 mb-4"> {{-- Mengubah lebar kolom untuk kartu --}}
            <div class="card shadow mb-4"> {{-- Menambahkan card wrapper untuk konsistensi styling --}}
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">Detail Populasi Ternak per Jenis</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.pages.peternakan.index') }}" method="GET" class="mb-3">
                        <div class="row g-3 align-items-center">
                            {{-- Kolom Filter Tahun (Dropdown) --}}
                            @if(isset($availableYears) && $availableYears->isNotEmpty())
                            <div class="col-md-4 col-lg-3">
                                <select name="tahun" class="form-select bg-light border-0 small" onchange="this.form.submit()">
                                    <option value="">Semua Tahun</option>
                                    @foreach ($availableYears as $year)
                                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            {{-- Kolom Pencarian --}}
                            <div class="col-md-8 col-lg-6">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Cari berdasarkan Jenis Ternak..."
                                        aria-label="Search" aria-describedby="basic-addon2" value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @forelse ($populasiTernak as $item)
                            <div class="col">
                                <div class="card h-100 shadow-sm border-0">
                                    @if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top rounded-top" alt="{{ $item->jenis_ternak }}" style="height: 200px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('images/default-ternak.png') }}" class="card-img-top rounded-top" alt="Gambar Default" style="height: 200px; object-fit: cover;">
                                    @endif
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title fw-bold mb-2">{{ $item->jenis_ternak }}</h5>
                                        <p class="card-text small mb-1">
                                            Jumlah Duo Koto: {{ number_format($item->jumlah_duo_koto) }}
                                        </p>
                                        <p class="card-text small mb-1">
                                            Jumlah Guguak: {{ number_format($item->jumlah_guguak) }}
                                        </p>
                                        <p class="card-text small mb-1">
                                            Jumlah Baiang: {{ number_format($item->jumlah_baiang) }}
                                        </p>
                                        <p class="card-text small fw-bold mb-1">
                                            <i class="fa-solid fa-calculator me-1"></i> Total Ternak: {{ number_format($item->total_ternak) }}
                                        </p>
                                        <p class="card-text small text-muted mt-2">
                                            <i class="fa-solid fa-calendar-alt me-1"></i> Tahun: {{ $item->tahun ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <p>Belum ada data populasi ternak yang tersedia.</p>
                            </div>
                        @endforelse
                    </div>
                    {{-- Pagination Navigation --}}
                    @if ($populasiTernak instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="d-flex justify-content-center mt-5">
                            {{ $populasiTernak->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Grafik Populasi Ternak (kiri) --}}
        <div class="col-lg-5 mb-4"> {{-- Mengubah lebar kolom untuk grafik --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Populasi Ternak</h6>
                    <div class="dropdown no-arrow">
                        <form action="{{ route('pages.dashboard') }}" method="GET" class="d-flex align-items-center">
                            <label for="tahun_populasi_ternak" class="me-2 text-muted small">Filter Tahun:</label>
                            <select name="tahun_populasi_ternak" id="tahun_populasi_ternak" class="form-select form-select-sm" onchange="this.form.submit()">
                                @foreach ($availableYearsPopulasiTernak as $year)
                                    <option value="{{ $year }}" {{ $selectedYearPopulasiTernak == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="populasiTernakPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Pie Chart Populasi Ternak
        const labelsPopulasiTernak = @json($labelsPopulasiTernak);
        const valuesPopulasiTernak = @json($valuesPopulasiTernak);

        console.log('Labels:', labelsPopulasiTernak);
        console.log('Values:', valuesPopulasiTernak);
        
        const ctxPopulasiTernak = document.getElementById("populasiTernakPieChart");
        if (ctxPopulasiTernak) {
            new Chart(ctxPopulasiTernak, {
                type: 'pie', 
                data: {
                    labels: labelsPopulasiTernak,
                    datasets: [{
                        data: valuesPopulasiTernak,
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'], // Warna untuk setiap slice
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#e0b542', '#d53d2e', '#6e707e'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
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
                                var datasetLabel = chart.data.labels[tooltipItem.index] || '';
                                // Hitung total untuk persentase
                                var total = chart.data.datasets[tooltipItem.datasetIndex].data.reduce((a, b) => a + b, 0);
                                var currentValue = chart.data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                var percentage = parseFloat((currentValue/total*100).toFixed(1));
                                return datasetLabel + ': ' + number_format_display(currentValue, 0) + ' Unit (' + percentage + '%)';
                            }
                        }
                    },
                    cutoutPercentage: 80, // Untuk membuat doughnut chart
                },
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