@extends('layout.app')

@section('content')
<div class="mb-4">
    <h3 class="mb-0 text-gray-800">Ajukan Surat : {{ $letterService->name }}</h3>
    <p class="mb-4">Lengkapi persyaratan di bawah ini untuk mengajukan permohonan surat.</p>
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

<form action="{{ route('store-request', $letterService->slug) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body bg-white mb-3 shadow-sm">
        <div class="mb-3">
            <p><strong>Persyaratan yang dibutuhkan:</strong></p>
        </div>

        @php
            $requirements = explode(',', $letterService->requirements);
        @endphp

        @foreach ($requirements as $req)
            @php
                $reqName = trim($req);
                // PERBAIKAN: Gunakan Str::slug() tanpa separator, yang defaultnya menggunakan hyphen
                $inputName = Str::slug($reqName);
            @endphp

            <div class="mb-3">
                <label for="{{ $inputName }}" class="form-label">{{ $reqName }} <span class="text-danger">*</span></label>
                <input type="file" class="form-control @error($inputName) is-invalid @enderror" id="{{ $inputName }}" name="{{ $inputName }}" required>
                <div class="form-text text-muted">Maksimal 2MB.</div>
                @error($inputName)
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        @endforeach
    </div>

    <div class="card-footer d-flex justify-content-end">
        <a href="{{ route('layanan-surat.index') }}" class="btn btn-secondary me-2">Batal</a>
        <button type="submit" class="btn btn-success">Ajukan Permohonan</button>
    </div>
</form>
@endsection