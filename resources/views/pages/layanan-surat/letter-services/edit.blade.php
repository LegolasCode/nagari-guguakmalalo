@extends('layout.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Layanan Surat</h1>
</div>

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Terjadi Kesalahan!</strong> Mohon periksa kembali input Anda.
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<form action="{{ route('letter-services.update', $letterService->slug) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body bg-white mb-3 shadow-sm">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Jenis Surat <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $letterService->name) }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="requirements" class="form-label">Persyaratan (Pisahkan dengan koma) <span class="text-danger">*</span></label>
            <textarea class="form-control @error('requirements') is-invalid @enderror" id="requirements" name="requirements" rows="5" required>{{ old('requirements', $letterService->requirements) }}</textarea>
            <div class="form-text text-muted">Contoh: Fotokopi KTP, Fotokopi KK, Surat Pengantar RT/RW.</div>
            @error('requirements')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
        <a href="{{ route('letter-services.index') }}" class="btn btn-outline-secondary me-2">Kembali</a>
        <button type="submit" class="btn btn-warning">Update</button>
    </div>
</form>
@endsection
