@extends('layout.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Permintaan Surat</h1>
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
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">Detail Permintaan: {{ $letterRequest->request_number }}</h6>
        </div>
        <form action="{{ route('letter-request.update', $letterRequest->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="fw-bold">Informasi Permintaan</h5>
                        <hr>
                        <p><strong>Pengaju:</strong> {{ $letterRequest->user->name }}</p>
                        <p><strong>Jenis Surat:</strong> {{ $letterRequest->service->name }}</p>
                        <p><strong>Tanggal Diajukan:</strong> {{ $letterRequest->created_at->locale('id')->translatedFormat('d F Y H:i') }}</p>
                        <p>
                            <strong>Status Saat Ini:</strong>
                            @switch($letterRequest->status)
                                @case('pending')
                                    <span class="badge bg-warning text-dark">{{ $letterRequest->status_label }}</span>
                                    @break
                                @case('processing')
                                    <span class="badge bg-info text-dark">{{ $letterRequest->status_label }}</span>
                                    @break
                                @case('completed')
                                    <span class="badge bg-success">{{ $letterRequest->status_label }}</span>
                                    @break
                                @case('rejected')
                                    <span class="badge bg-danger">{{ $letterRequest->status_label }}</span>
                                    @break
                            @endswitch
                        </p>
                        @if ($letterRequest->admin_notes)
                            <p><strong>Catatan Admin:</strong> {{ $letterRequest->admin_notes }}</p>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <h5 class="fw-bold">File Persyaratan</h5>
                        <hr>
                        @if ($letterRequest->requirements->count() > 0)
                            <ul class="list-group">
                                @foreach ($letterRequest->requirements as $requirement)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $requirement->requirement_name }}
                                        <a href="{{ Storage::url($requirement->file_path) }}" class="btn btn-sm btn-primary" target="_blank" download>
                                            <i class="fas fa-download"></i> Lihat/Unduh
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>Tidak ada file persyaratan yang diunggah.</p>
                        @endif

                        @if ($letterRequest->completed_file_path)
                            <h5 class="fw-bold mt-4">Surat Selesai</h5>
                            <hr>
                            <a href="{{ route('letter-request.download', $letterRequest->id) }}" class="btn btn-success">
                                <i class="fas fa-download"></i> Unduh Surat Selesai
                            </a>
                        @endif
                    </div>
                </div>

                <hr class="my-4">

                {{-- Form untuk Admin Mengubah Status dan Mengunggah File --}}
                <h5 class="fw-bold">Kelola Permintaan Surat</h5>
                    <div class="card p-4">
                        <div class="mb-3">
                            <label for="status" class="form-label">Ubah Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="pending" {{ old('status', $letterRequest->status) == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                <option value="processing" {{ old('status', $letterRequest->status) == 'processing' ? 'selected' : '' }}>Diproses</option>
                                <option value="completed" {{ old('status', $letterRequest->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="rejected" {{ old('status', $letterRequest->status) == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="completed_file" class="form-label">Unggah Surat Selesai (Opsional)</label>
                            <input class="form-control @error('completed_file') is-invalid @enderror" type="file" id="completed_file" name="completed_file" accept=".pdf">
                            <div class="form-text">Unggah file PDF surat yang sudah selesai. Maksimal 5MB.</div>
                            @error('completed_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="admin_notes" class="form-label">Catatan Admin (Opsional)</label>
                            <textarea class="form-control @error('admin_notes') is-invalid @enderror" id="admin_notes" name="admin_notes" rows="3">{{ old('admin_notes', $letterRequest->admin_notes) }}</textarea>
                            @error('admin_notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <a href="{{ route('letter-request.index') }}" class="btn btn-outline-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
@endsection