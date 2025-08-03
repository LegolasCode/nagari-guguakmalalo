@extends('layout.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 mx-4">
    <h1 class="h3 mb-0 text-gray-800">Layanan Surat Mandiri</h1>
    <a href="/layanan-surat/my-request" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Permohonan Saya</a>
</div>
<div class="container py-2">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($letterServices as $item)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold mb-2">{{ $item->name }}</h5>
                        <hr>
                        <p class="card-text small mb-2"><strong>Persyaratan:</strong></p>
                        <ul class="list-unstyled small mb-3">
                            @php
                                $requirements = explode(',', $item->requirements);
                            @endphp
                            @foreach ($requirements as $req)
                                <li><i class="fas fa-check me-2 text-success"></i> {{ trim($req) }}</li>
                            @endforeach
                        </ul>
                        <div class="mt-auto">
                            <a href="{{ route('create-request', $item->slug) }}" class="btn btn-sm btn-success w-100">Ajukan Permohonan</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p>Belum ada layanan surat yang tersedia.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection