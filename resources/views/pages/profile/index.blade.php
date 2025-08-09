@extends('layout.app')

@section('title', 'Guguak Malalo | Profile')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Profile</h1>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('pages.dashboard') }}" class="btn btn-secondary mr-2">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
            @if (Auth::user()->role_id == 2)
            <div class="card p-4 mb-4 mt-4">
                <h5 class="fw-bold mb-3">Informasi Penduduk</h5>
                <p><strong>Nama:</strong> {{ $user->resident->name }}</p>
                <p><strong>NIK:</strong> {{ $user->resident->nik }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $user->resident->gender }}</p>
                <p><strong>Alamat:</strong> {{ $user->resident->address }}</p>
                    
                {{-- Tampilkan Status BPJS --}}
                <p><strong>Status BPJS:</strong> <span class="badge bg-primary">{{ $user->resident->bpjs_status }}</span></p>
                    
            </div>
            @endif
        </div>
    </div>
@endsection