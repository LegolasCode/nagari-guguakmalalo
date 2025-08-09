@extends('layout.app')

@section('title', 'Guguak Malalo | Detail Permintaan Surat')

@section('content')
<div class="mb-4">
    <h3 class="mb-0 text-gray-800"">Detail Permintaan Surat</h3>
    <p class="mb-4">Nomor Permintaan: <span class="fw-bold">{{ $letterRequest->request_number }}</span></p>
</div>

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Informasi Permintaan</h5>
        <hr>
        <p><strong>Jenis Surat:</strong> {{ $letterRequest->service->name }}</p>
        <p><strong>Tanggal Diajukan:</strong> {{ $letterRequest->created_at->locale('id')->translatedFormat('d F Y H:i') }}</p>
        <p>
            <strong>Status Surat:</strong>
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
</div>

{{-- Card File Persyaratan --}}
<div class="card shadow mb-4">
    <div class="card-body">
        <h5 class="fw-bold mb-3">File Persyaratan Anda</h5>
        <hr>
        @if ($letterRequest->requirements->isNotEmpty())
        <ul class="list-group">
            @foreach ($letterRequest->requirements as $requirement)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $requirement->requirement_name }}
                <a href="{{ Storage::url($requirement->file_path) }}" class="btn btn-sm btn-info" target="_blank" download title="Unduh File">
                    <i class="fas fa-download"></i> Unduh
                </a>
            </li>
            @endforeach
        </ul>
        @else
        <p class="text-muted">Tidak ada file persyaratan yang diunggah.</p>
        @endif
    </div>
</div>
            
{{-- Card Surat Selesai (Jika Status Selesai) --}}
@if ($letterRequest->status == 'completed' && $letterRequest->completed_file_path)
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Surat Selesai</h5>
            <hr>
            <p class="mb-3">Permohonan surat Anda telah selesai diproses. Silakan unduh surat di bawah ini.</p>
            <a href="{{ route('my-request.download', $letterRequest->id) }}" class="btn btn-success">
                <i class="fas fa-download me-1"></i> Unduh Surat Selesai
            </a>
        </div>
    </div>
@endif

<div class="d-flex justify-content-start mt-4">
    <a href="{{ route('my-request') }}" class="btn btn-outline-secondary me-2">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>
@endsection