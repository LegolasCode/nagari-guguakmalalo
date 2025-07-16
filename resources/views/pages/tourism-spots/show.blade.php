@extends('layout.app') 

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Detail Tempat Wisata</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Detail: {{ $tourismSpot->name }}</h6>
            <div>
                <a href="{{ route('tourism-spots.edit', $tourismSpot->slug) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                <form action="{{ route('admin.tourism_spots.destroy', $tourismSpot->slug) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus tempat wisata ini?')">Hapus</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if ($tourismSpot->thumbnail)
                        <img src="{{ asset('storage/' . $tourismSpot->thumbnail) }}" class="img-fluid rounded mb-3" alt="{{ $tourismSpot->name }}">
                    @else
                        <img src="{{ asset('images/default-thumbnail.png') }}" class="img-fluid rounded mb-3" alt="Gambar Default">
                    @endif

                    @if ($tourismSpot->video_url)
                        <h5 class="mt-4">Video Terkait</h5>
                        <div class="ratio ratio-16x9">
                            {{-- Mengambil ID video dari URL YouTube/Vimeo --}}
                            @php
                                $videoId = '';
                                if (Str::contains($tourismSpot->video_url, 'youtube.com/watch?v=')) {
                                    parse_str(parse_url($tourismSpot->video_url, PHP_URL_QUERY), $vars);
                                    $videoId = $vars['v'] ?? '';
                                } elseif (Str::contains($tourismSpot->video_url, 'youtu.be/')) {
                                    $videoId = Str::afterLast($tourismSpot->video_url, '/');
                                } elseif (Str::contains($tourismSpot->video_url, 'vimeo.com/')) {
                                    $videoId = Str::afterLast($tourismSpot->video_url, '/');
                                }
                            @endphp
                            @if (Str::contains($tourismSpot->video_url, ['youtube.com', 'youtu.be']))
                                <iframe src="https://www.youtube.com/embed/{{ $videoId }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @elseif (Str::contains($tourismSpot->video_url, 'vimeo.com'))
                                <iframe src="https://player.vimeo.com/video/{{ $videoId }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                            @else
                                <p class="text-muted">Format link video tidak didukung atau tidak valid.</p>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <p><strong>Nama:</strong> {{ $tourismSpot->name }}</p>
                    <p><strong>Alamat:</strong> {{ $tourismSpot->address ?? '-' }}</p>
                    <p><strong>Koordinat:</strong>
                        @if ($tourismSpot->latitude && $tourismSpot->longitude)
                            {{ $tourismSpot->latitude }}, {{ $tourismSpot->longitude }}
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $tourismSpot->latitude }},{{ $tourismSpot->longitude }}" target="_blank" class="btn btn-sm btn-outline-info ms-2">Lihat di Peta</a>
                        @else
                            -
                        @endif
                    </p>
                    <hr>
                    <h5>Deskripsi:</h5>
                    <p>{!! nl2br(e($tourismSpot->description)) !!}</p>
                </div>
            </div>
            <hr>
            <a href="{{ route('tourism-spots.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

</div>
@endsection