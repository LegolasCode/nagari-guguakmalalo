@extends('user.layout.app')


@section('content')
<div class="container py-5">
    <h2 class="text-center fw-bold mb-4">Data Luas Area Produksi</h2>
    <p class="text-center lead mb-5 mx-auto" style="max-width: 800px;">
        Informasi mengenai luas lahan tanam, luas panen, dan total produksi berbagai komoditi pertanian di Nagari Guguak Malalo setiap tahunnya.
    </p>

    {{-- Tabel Data Luas Area Produksi --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Daftar Luas Area Produksi</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('user.pages.pertanian.luas-area-produksi') }}" method="GET" class="mb-3">
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
                            <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Cari berdasarkan Komoditi atau Tipe Area..."
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
                            <th>Tipe Area</th>
                            <th>Luas Tanam (Ha)</th>
                            <th>Luas Panen (Ha)</th>
                            <th>Produksi (Ton)</th>
                            <th>Tahun</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($luasAreaProduksi as $item)
                            <tr>
                                <td>{{ $loop->iteration + ($luasAreaProduksi->currentPage() - 1) * $luasAreaProduksi->perPage() }}</td>
                                <td>{{ $item->nama_komoditi }}</td>
                                <td>{{ $item->tipe_area }}</td>
                                <td>{{ number_format($item->luas_tanam, 2, ',', '.') }}</td>
                                <td>{{ number_format($item->luas_panen, 2, ',', '.') }}</td>
                                <td>{{ number_format($item->produksi, 2, ',', '.') }}</td>
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
                                <td colspan="8" class="text-center py-4">Belum ada data luas area produksi yang tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Pagination Navigation --}}
        @if ($luasAreaProduksi instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="card-footer d-flex justify-content-center">
                {{ $luasAreaProduksi->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
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