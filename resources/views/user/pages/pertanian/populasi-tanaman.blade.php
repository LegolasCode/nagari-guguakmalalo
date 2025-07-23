@extends('user.layout.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center fw-bold mb-4">Data Populasi Tanaman</h2>
    <p class="text-center lead mb-5 mx-auto" style="max-width: 800px;">
        Informasi mengenai populasi tanaman di berbagai wilayah Nagari Guguak Malalo setiap tahunnya.
    </p>

    {{-- Tabel Data Populasi Tanaman --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Daftar Populasi Tanaman</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('user.pages.pertanian.populasi-tanaman') }}" method="GET" class="mb-3">
                <div class="row g-3 align-items-center justify-content-end">
                    {{-- Kolom Filter Tahun (Dropdown) --}}
                    @if(isset($availableYears) && $availableYears->isNotEmpty())
                    <div class="col-md-4 col-lg-3">
                        <select name="tahun" class="form-select bg-light border-0 small" onchange="this.form.submit()">
                            <option value="">Filter Tahun</option>
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
                            <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Cari berdasarkan Komoditi atau Tipe Tanaman..."
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
            <div class="table-responsive">
                <table class="table table-bordered table-hover w-100" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Komoditi</th>
                            <th>Tipe Tanaman</th>
                            <th>Jml. Duo Koto</th>
                            <th>Jml. Guguak</th>
                            <th>Jml. Baiang</th>
                            <th>Total Populasi</th>
                            <th>Tahun</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($populasiTanaman as $item)
                            <tr>
                                <td>{{ $loop->iteration + ($populasiTanaman->currentPage() - 1) * $populasiTanaman->perPage() }}</td>
                                <td>{{ $item->nama_komoditi }}</td>
                                <td>{{ $item->tipe_tanaman }}</td>
                                <td>{{ number_format($item->jumlah_duo_koto) }}</td>
                                <td>{{ number_format($item->jumlah_guguak) }}</td>
                                <td>{{ number_format($item->jumlah_baiang) }}</td>
                                <td>{{ number_format($item->total_populasi) }}</td>
                                <td>{{ $item->tahun ?? '-' }}</td>
                                <td>
                                    @if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="Gambar" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">Belum ada data populasi tanaman yang tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
            {{-- Pagination Navigation --}}
            @if ($populasiTanaman instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="card-footer d-flex justify-content-center">
                    {{ $populasiTanaman->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                </div>
            @endif
    </div>

    {{-- Tombol Kembali ke Halaman Pertanian Utama --}}
    <div class="text-center mt-4">
        <a href="{{ route('user.pages.pertanian.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Halaman Pertanian
        </a>
    </div>
</div>
@endsection