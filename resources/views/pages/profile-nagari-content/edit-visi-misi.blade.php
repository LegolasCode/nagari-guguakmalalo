@extends('layouts.admin') {{-- Sesuaikan dengan nama file layout admin Anda --}}

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Visi dan Misi Nagari</h1>
    </div>

    {{-- Form untuk mengedit Visi dan Misi --}}
    <form action="{{ route('admin.profilNagari.visiMisi.update') }}" method="POST">
        @csrf
        @method('PUT') {{-- Penting: Gunakan method PUT untuk update --}}

        <div class="card-body bg-white mb-3 shadow-sm"> {{-- Tambah shadow-sm untuk konsistensi --}}
            {{-- Input untuk Visi Nagari --}}
            <div class="mb-3">
                <label for="visi" class="form-label">Visi Nagari</label>
                <textarea id="visi" name="visi" rows="5" class="form-control @error('visi') is-invalid @enderror">{{ old('visi', $visi->body ?? '') }}</textarea>
                @error('visi')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Input untuk Misi Nagari --}}
            <div class="mb-3">
                <label for="misi" class="form-label">Misi Nagari</label>
                <textarea id="misi" name="misi" rows="7" class="form-control @error('misi') is-invalid @enderror">{{ old('misi', $misi->body ?? '') }}</textarea>
                @error('misi')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        <div class="card-footer d-flex justify-content-end" style="gap: 10px;">
            <a href="{{ route('admin.profilNagari.index') }}" class="btn btn-outline-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </div>
    </form>
@endsection