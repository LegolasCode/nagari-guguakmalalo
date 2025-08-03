@extends('user.layout.app')

@section('content')
<div class="container py-5">
    {{-- SECTION: Kontak Hukum (Polsek & Babinsa) --}}
    <h2 class="text-center fw-bold mb-4">Kontak Aparat Hukum</h2>
    <p class="text-center text-muted mb-5">Hubungi pihak berwenang untuk bantuan hukum atau keamanan</p>

    <div class="row row-cols-1 row-cols-md-2 g-4 justify-content-center mb-5">
        @if ($legalContact)
            <div class="col">
                <div class="card h-100 shadow-sm border-0 text-center">
                    <div class="card-body p-4">
                        <i class="fa-solid fa-building-columns fa-4x text-success mb-3"></i>
                        <h5 class="card-title fw-bold mb-2">Polsek Setempat</h5>
                        <p class="card-text mb-1">
                            <strong>{{ $legalContact->contact_polsek_name ?? 'Nama Tidak Tersedia' }}</strong>
                        </p>
                        <p class="card-text mb-0">
                            <i class="fa-solid fa-phone me-1"></i> {{ $legalContact->contact_polsek_phone ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow-sm border-0 text-center">
                    <div class="card-body p-4">
                        <i class="fa-solid fa-shield-halved fa-4x text-success mb-3"></i>
                        <h5 class="card-title fw-bold mb-2">Babinsa Nagari</h5>
                        <p class="card-text mb-1">
                            <strong>{{ $legalContact->contact_babinsa_name ?? 'Nama Tidak Tersedia' }}</strong>
                        </p>
                        <p class="card-text mb-0">
                            <i class="fa-solid fa-phone me-1"></i> {{ $legalContact->contact_babinsa_phone ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="col-12 text-center py-4">
                <p class="text-muted">Data kontak hukum belum tersedia.</p>
            </div>
        @endif
    </div>

    <hr class="my-5">

    {{-- SECTION: Dokumen Nagari (Card Horizontal View) --}}
    <h2 class="text-center fw-bold mb-4">Dokumen Nagari</h2>
    
    {{-- Tampilan Card Horizontal untuk Dokumen --}}
    <div class="row row-cols-1 g-4"> {{-- Gunakan row-cols-1 untuk card horizontal --}}
        @forelse ($documents as $item)
            <div class="col">
                <div class="card shadow-sm border-0 h-100">
                    <div class="row g-0 align-items-center"> {{-- Row untuk card horizontal --}}
                        <div class="col-md-2 d-none d-md-block text-center p-3"> {{-- Icon di kiri --}}
                            @if ($item->file_type == 'pdf')
                                <i class="fa-regular fa-file-pdf fa-3x text-danger"></i>
                            @elseif (in_array($item->file_type, ['doc', 'docx']))
                                <i class="fa-regular fa-file-word fa-3x text-info"></i>
                            @elseif (in_array($item->file_type, ['xls', 'xlsx']))
                                <i class="fa-regular fa-file-excel fa-3x text-success"></i>
                            @else
                                <i class="fa-regular fa-file fa-4x text-muted"></i>
                            @endif
                        </div>
                        <div class="col-md-8"> {{-- Konten dokumen di tengah --}}
                            <div class="card-body">
                                <h6 class="card-title">{{ $item->title }}</h6>
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i> {{ $item->published_date ? \Carbon\Carbon::parse($item->published_date)->locale('id')->translatedFormat('d M Y') : '-' }} |
                                    <i class="fas fa-file-alt me-1"></i> Tipe: {{ strtoupper($item->file_type ?? '-') }} |
                                    <i class="fas fa-database me-1"></i> Ukuran: {{ $item->file_size ?? '-' }}
                                </small>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex flex-column justify-content-center align-items-end p-3"> {{-- Tombol di kanan --}}
                            <a href="{{ route('hukum.download', $item->slug) }}" class="btn btn-success btn-sm w-100 mb-2">
                                <i class="fas fa-download me-1"></i> Unduh
                            </a>
                            <a href="{{ route('user.pages.hukum.show', $item->slug) }}" class="btn btn-info btn-sm w-100">
                                <i class="fas fa-eye me-1"></i> Lihat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p>Belum ada dokumen yang tersedia.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination Navigation --}}
    @if ($documents instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="d-flex justify-content-center mt-5">
            {{ $documents->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
        </div>
    @endif
</div>
@endsection