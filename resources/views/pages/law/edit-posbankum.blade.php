@extends('layout.app')

@section('title', 'Guguak Malalo | Edit Gambar Posbankum')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Gambar Posbankum</h1>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('pages.law.edit-posbankum.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="image" class="form-label">Unggah Gambar Posbankum</label>
                    @if ($posbankum->image)
                        <div class="mb-2">
                            <p class="mb-1">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $posbankum->image) }}" class="img-thumbnail" style="max-width: 400px;">
                        </div>
                    @endif
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            
            </form>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
        <a href="{{ route('law.index') }}" class="btn btn-secondary me-2">Kembali</a>
        <button type="submit" class="btn btn-success">Simpan Gambar</button>
    </div>
</div>
@endsection