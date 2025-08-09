@extends('user.layout.app')

@section('title', 'Guguak Malalo | Layanan Surat Mandiri')

@section('content')
<div class="container py-5">
    <h2 class="text-center fw-bold mb-4">Layanan Surat Mandiri</h2>
    <p class="text-center mb-5 mx-auto" style="max-width: 800px;">
        Pilih jenis surat yang Anda butuhkan dan ajukan permohonan dengan melengkapi persyaratan yang telah ditentukan. Untuk mengajukan permohonan, Anda harus login terlebih dahulu.
    </p>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($letterServices as $item)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title fw-bold mb-2">{{ $item->name }}</h6>
                        <hr>
                        <p class="card-text small mb-2"><strong>Persyaratan:</strong></p>
                        <ul class="list-unstyled small mb-3">
                            @php
                                // Asumsi persyaratan disimpan sebagai string yang dipisahkan koma
                                $requirements = explode(',', $item->requirements);
                            @endphp
                            @foreach ($requirements as $req)
                                <li><i class="fa-solid fa-check me-2 text-success"></i> {{ trim($req) }}</li>
                            @endforeach
                        </ul>
                        <div class="mt-auto">
                            <a href="{{ route('login') }}" class="btn btn-custom w-100">Ajukan Permohonan</a>
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

    <div class="text-center mt-5">
        <div class="d-flex justify-content-center flex-wrap" style="gap: 1rem;">
            <a href="{{ route('user.pages.layanan-mandiri.langkah') }}" class="btn btn-custom-readmore btn-md px-4">
                Langkah Pengajuan
            </a>
        </div>
    </div>
    <p class="text-center text-muted mb-5 mx-auto mt-5" style="max-width: 800px;">
        Untuk mendapatkan SKTM, keluarga tersebut harus terdaftar di DTKS dan agar terdaftar di DTKS secara mandiri  bisa melalui website cekbansos.kemensos.go.id. <a href="https://cekbansos.kemensos.go.id/" target="_blank">Klik disini</a>
    </p>
</div>
@endsection