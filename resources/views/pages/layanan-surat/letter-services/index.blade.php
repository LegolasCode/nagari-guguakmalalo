@extends('layout.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Layanan Surat</h1>
    <a href="{{ route('letter-services.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
    class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
</div>

<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Nama Layanan</th>
                                <th>Persyaratan</th>
                                <th>Tanggal Dibuat</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($letterServices as $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($letterServices->currentPage() - 1) * $letterServices->perPage() }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ Str::limit($item->requirements, 100, '...') }}</td>
                                    <td>{{ $item->created_at->locale('id')->translatedFormat('d M Y') }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('letter-services.edit', $item->slug) }}" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteLetterServiceModal{{ $item->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">Belum ada layanan surat yang tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($letterServices instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="card-footer">
                    {{ $letterServices->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
    {{-- Modals Konfirmasi Hapus --}}
    @foreach ($letterServices as $item)
        <div class="modal fade" id="deleteLetterServiceModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteLetterServiceModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteLetterServiceModalLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus layanan surat "<strong>{{ $item->name }}</strong>"?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('letter-services.destroy', $item->slug) }}" method="POST" style="display: inline;">
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
