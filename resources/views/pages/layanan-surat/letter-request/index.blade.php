@extends('layout.app')

@section('title', 'Guguak Malalo | Manajemen Permintaan Surat')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Permintaan Surat</h1>
</div>

{{-- Tabel Permintaan Surat --}}
<div class="card shadow mb-4">
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

        <form action="{{ route('letter-request.index') }}" method="GET"> {{-- Periksa nama rute --}}
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <select name="status" class="form-select bg-light border-0 small" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Diproses</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-8 col-lg-6"> 
                    <div class="input-group">
                        <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Cari No. Permintaan..."
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

        <div class="table-responsive mt-4">
            <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
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
@endsection

    


   