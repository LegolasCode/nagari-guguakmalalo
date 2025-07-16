@extends('layout.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Daftar Tempat Wisata</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cari Tempat Wisata</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('tourism-spots.index') }}" method="GET" class="mb-3">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Cari berdasarkan Nama atau Alamat..."
                                   aria-label="Search" aria-describedby="basic-addon2" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Tempat Wisata</h6>
            <a href="{{ route('tourism-spots.create') }}" class="btn btn-primary btn-sm">Tambah Tempat Wisata</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Thumbnail</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tourismSpots as $spot)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $spot->name }}</td>
                            <td>{{ Str::limit($spot->address, 50, '...') }}</td>
                            <td>
                                @if ($spot->thumbnail)
                                    <img src="{{ asset('storage/' . $spot->thumbnail) }}" alt="{{ $spot->name }}" width="100">
                                @else
                                    Tidak ada gambar
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tourism-spots.show', $spot->slug) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('tourism-spots.edit', $spot->slug) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('tourism_spots.destroy', $spot->slug) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus tempat wisata ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data tempat wisata.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $tourismSpots->links() }}
            </div>
        </div>
    </div>

</div>
@endsection