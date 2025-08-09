@extends('layout.app')

@section('title', 'Guguak Malalo | Tambah Layanan Surat')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Layanan Surat</h1>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
             @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('letter-services.store') }}" method="POST">
    @csrf
    <div class="card-body bg-white mb-3 shadow-sm">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Jenis Surat <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="requirements" class="form-label">Persyaratan (Pisahkan dengan koma) <span class="text-danger">*</span></label>
            <textarea class="form-control @error('requirements') is-invalid @enderror" id="requirements" name="requirements" rows="5" required>{{ old('requirements') }}</textarea>
            <div class="form-text text-muted">Contoh: Fotokopi KTP, Fotokopi KK, Surat Pengantar RT/RW.</div>
            @error('requirements')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
        <a href="{{ route('letter-services.index') }}" class="btn btn-outline-secondary me-2">Kembali</a>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>
@endsection