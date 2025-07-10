@extends('layout.app')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pendaduan</h1>
        @if (isset(auth()->user()->resident))
        <a href="/complaint/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-plus fa-sm text-white-50"></i> Buat Aduan</a>
        @endif
    </div>
    <!-- Table  -->
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-responsive table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Isi Pengaduan</th>
                                <th>Status</th>
                                <th>Foto Bukti</th>
                                <th>Tanggal Laporan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @if ($complaints->isEmpty())
                        <tbody>
                            <tr>
                                <td colspan="12">
                                    <p class="pt-3 text-center">Tidak ada data</p>
                                </td>
                            </tr>
                        </tbody>
                        @else
                        <tbody>
                            @foreach ($complaints as $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($complaints->currentPage() - 1) * $complaints->perPage() }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{!! wordwrap($item->content, 50,"<br>\n") !!}</td>
                                    <td>{{ $item->status_label }}</td>
                                    <td>
                                        @if (isset($item->photo_proof))
                                            @php
                                                $filePath = 'storage/' . $item->photo_proof;
                                            @endphp
                                            <a href="{{ $filePath }}" target="_blank" rel="noopener noreferrer">
                                                <img src="{{ $filePath }}" alt="Foto Bukti" style="max-width: 300px">
                                            </a>
                                        @else
                                            Tidak Ada
                                        @endif
                                    </td>
                                    <td>{{ $item->report_date_label }}</td>

                                    <td>
                                        @if (Auth::user()->role_id == 1)
                                        {{-- Hanya admin yang bisa ubah status --}}
                                        <form action="{{ route('complaint.updateStatus', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                <option value="new" {{ $item->status == 'new' ? 'selected' : '' }}>Baru</option>
                                                <option value="processing" {{ $item->status == 'processing' ? 'selected' : '' }}>Sedang Diproses</option>
                                                <option value="completed" {{ $item->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </form>

                                        @else
                                        <div class="d-flex">
                                            <a href="{{ route('complaint.edit', $item->id) }}" class="d-inline-block mr-2 btn-sm btn-warning">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger mr-2" data-bs-toggle="modal" data-bs-target="#confirmationDelete-{{ $item->id }}">
                                                <i class="fas fa-eraser"></i> 
                                            </button>
                                        </div>
                                        @endif
                                    </td>
                                    
                                </tr>
                                @include('pages.complaint.confirmation-delete')
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
                {{-- Pagination Navigation --}}
                <div class="card-footer">
                    {{ $complaints->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>

        </div>

    </div>
@endsection