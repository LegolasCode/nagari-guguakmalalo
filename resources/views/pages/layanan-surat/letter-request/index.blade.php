@extends('layout.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manajemen Permintaan Surat</h1>

    {{-- Form Filter dan Pencarian --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter & Cari Permintaan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('letter-request.index') }}" method="GET"> {{-- Periksa nama rute --}}
                <div class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Cari No. Permintaan..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Diproses</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary me-2">Terapkan Filter</button>
                        <a href="{{ route('letter-request.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Permintaan Surat --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Permintaan Surat</h6>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover w-100" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>No. Permintaan</th>
                            <th>Pengaju</th>
                            <th>Jenis Surat</th>
                            <th>Status</th>
                            <th>Tanggal Diajukan</th>
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($letterRequests as $item)
                            <tr>
                                <td>{{ $loop->iteration + ($letterRequests->currentPage() - 1) * $letterRequests->perPage() }}</td>
                                <td>{{ $item->request_number }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->service->name }}</td>
                                <td>
                                    @switch($item->status)
                                        @case('pending')
                                            <span class="badge bg-warning text-dark">{{ $item->status_label }}</span>
                                            @break
                                        @case('processing')
                                            <span class="badge bg-info text-dark">{{ $item->status_label }}</span>
                                            @break
                                        @case('completed')
                                            <span class="badge bg-success">{{ $item->status_label }}</span>
                                            @break
                                        @case('rejected')
                                            <span class="badge bg-danger">{{ $item->status_label }}</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>{{ $item->created_at->locale('id')->translatedFormat('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('letter-request.show', $item->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">Belum ada permintaan surat yang masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if ($letterRequests instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="card-footer">
                {{ $letterRequests->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection