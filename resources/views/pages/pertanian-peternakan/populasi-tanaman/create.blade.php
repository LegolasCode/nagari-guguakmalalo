@extends('layout.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Populasi Tanaman Baru</h1>
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

<form action="{{ route('populasi-tanaman.store') }}" method="POST" enctype="multipart/form-data">
     @csrf
    <div class="card-body bg-white mb-3 shadow-sm">
        <div class="mb-3">
            <label for="nama_komoditi" class="form-label">Nama Komoditi <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nama_komoditi') is-invalid @enderror" id="nama_komoditi" name="nama_komoditi" value="{{ old('nama_komoditi') }}" required>
            @error('nama_komoditi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="tipe_tanaman" class="form-label">Tipe Tanaman <span class="text-danger">*</span></label>
            <select class="form-select @error('tipe_tanaman') is-invalid @enderror" id="tipe_tanaman" name="tipe_tanaman" required>
                <option value="">Pilih Tipe Tanaman</option>
                <option value="Buah-buahan" {{ old('tipe_tanaman') == 'Buah-buahan' ? 'selected' : '' }}>Buah-buahan</option>
                <option value="Perkebunan" {{ old('tipe_tanaman') == 'Perkebunan' ? 'selected' : '' }}>Perkebunan</option>
            </select>
            @error('tipe_tanaman')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="jumlah_duo_koto" class="form-label">Jumlah Duo Koto <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('jumlah_duo_koto') is-invalid @enderror" id="jumlah_duo_koto" name="jumlah_duo_koto" value="{{ old('jumlah_duo_koto') }}" required min="0">
                @error('jumlah_duo_koto')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

        <div class="col-md-4 mb-3">
            <label for="jumlah_guguak" class="form-label">Jumlah Guguak <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('jumlah_guguak') is-invalid @enderror" id="jumlah_guguak" name="jumlah_guguak" value="{{ old('jumlah_guguak') }}" required min="0">
            @error('jumlah_guguak')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4 mb-3">
            <label for="jumlah_baiang" class="form-label">Jumlah Baiang <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('jumlah_baiang') is-invalid @enderror" id="jumlah_baiang" name="jumlah_baiang" value="{{ old('jumlah_baiang') }}" required min="0">
            @error('jumlah_baiang')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun (Opsional)</label>
            <input type="number" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" value="{{ old('tahun', date('Y')) }}" placeholder="{{ date('Y') }}">
            @error('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar (Opsional)</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
            <div class="form-text text-muted">Format: JPG, PNG, GIF, SVG. Max: {{ ini_get('upload_max_filesize') }}.</div>
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    <div class="card-footer d-flex justify-content-end">
        <a href="/populasi-tanaman" class="btn btn-outline-secondary me-2">Kembali</a>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>

@endsection