@extends('layout.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Luas Area Produksi</h1>
    <a href="{{ route('populasi-tanaman.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
    class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
</div>

       <!-- Table  -->
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('populasi-tanaman.index') }}" method="GET" class="mb-3">
                    <div class="row g-3 align-items-center"> 
                        {{-- Kolom Filter Tahun (Dropdown) --}}
                        <div class="col-md-4 col-lg-3">
                            <select name="tahun" class="form-select bg-light border-0 small" onchange="this.form.submit()">
                                <option value="">Filter Tahun</option>
                                @forelse ($availableYears as $year) {{-- Loop melalui tahun dari database --}}
                                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @empty
                                    <option value="">Tidak ada tahun tersedia</option>
                                @endforelse
                            </select>
                        </div>

                        {{-- Kolom Pencarian --}}
                        <div class="col-md-8 col-lg-6"> {{-- Sesuaikan lebar kolom --}}
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
                <table class="table table-responsive table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Komoditi</th>
                            <th>Tipe Tanaman</th>
                            <th>Jumlah Duo Koto</th>
                            <th>Jumlah Guguak</th>
                            <th>Jumlah Baiang</th>
                            <th>Total Populasi</th>
                            <th>Tahun</th>
                            <th>Thumbnail</th>
                            <th style="width: 150px;">Aksi</th>
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
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('populasi-tanaman.edit', $item->id) }}" class="btn btn-warning btn-sm me-2">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePopulasiTanamanModal{{ $item->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-4">Belum ada data populasi tanaman yang tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Pagination Navigation --}}
            @if ($populasiTanaman instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="card-footer">
                    {{ $populasiTanaman->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

    {{-- Modals Konfirmasi Hapus --}}
    @foreach ($populasiTanaman as $item)
        <div class="modal fade" id="deletePopulasiTanamanModal{{ $item->id }}" tabindex="-1" aria-labelledby="deletePopulasiTanamanModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePopulasiTanamanModalLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data populasi tanaman "<strong>{{ $item->nama_komoditi }}</strong>"?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('populasi-tanaman.destroy', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection




