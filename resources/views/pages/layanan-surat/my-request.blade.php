@extends('layout.app')

@section('content')
<div class="mb-4">
    <h3 class="mb-0 text-gray-800"">Permintaan Surat Saya</h3>
    <p class="mb-4">Berikut adalah daftar status permohonan surat yang telah Anda ajukan.</p>
</div>

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

    {{-- Tabel Daftar Permintaan Surat --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered w-100" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>No. Permintaan</th>
                            <th>Jenis Surat</th>
                            <th>Status</th>
                            <th>Tanggal Diajukan</th>
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($myRequests as $item)
                            <tr>
                                <td>{{ $loop->iteration + ($myRequests->currentPage() - 1) * $myRequests->perPage() }}</td>
                                <td>{{ $item->request_number }}</td>
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
                                    <div class="d-flex">
                                        @if ($item->status == 'completed' && $item->completed_file_path)
                                            <a href="{{ route('my-request.download', $item->id) }}" class="btn btn-sm btn-success me-2" title="Unduh Surat Selesai">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-sm btn-secondary me-2 disabled" title="Belum dapat diunduh">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('show-request', $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">Belum ada permohonan surat yang diajukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($myRequests instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="card-footer">
                {{ $myRequests->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
            </div>
        @endif
    </div>

    {{-- Tombol Kembali (opsional) --}}
    <div class="d-flex justify-content-start mt-4">
        <a href="{{ route('layanan-surat.index') }}" class="btn btn-outline-secondary me-2">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
@endsection