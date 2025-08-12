@extends('layout.app')

@section('title', 'Guguak Malalo | Edit Bagan Struktur')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Bagan Struktur Pengurus</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- KOREKSI: Tag form membungkus seluruh input dan tombol --}}
    <form action="{{ route('struktur-organisasi.struktur-bagan.update') }}" method="POST" enctype="multipart/form-data">
        <div class="card shadow mb-4">
            <div class="card-body">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="image" class="form-label">Unggah Bagan Struktur Pengurus</label>
                    @if ($strukturBagan->image)
                        <div class="mb-2">
                            <p class="mb-1">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $strukturBagan->image) }}" class="img-thumbnail" style="max-width: 400px;">
                        </div>
                    @endif
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        {{-- Tambahkan card-footer di dalam card --}}
        <div class="card-footer d-flex justify-content-end" style="gap: 10px;">
            <a href="{{ route('struktur-organisasi.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-warning">Simpan Gambar</button>
        </div>
    </form>
</div>
@endsection