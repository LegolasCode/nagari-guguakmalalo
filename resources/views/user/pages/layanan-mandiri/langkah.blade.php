@extends('user.layout.app')

@section('title', 'Guguak Malalo | Langkah Pengajuan Surat')

@section('content')
<div class="container py-5">
    <div class="row g-4 justify-content-center">
        
        {{-- Langkah 1 --}}
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
            <img src="{{ asset('images/langkah-pengajuan-surat/langkah-1.png') }}" class="card-img-top" alt="Langkah 4" style="object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">1. Login ke Sistem Informasi Nagari</h5>
                    <p class="card-text">Login ke Sistem Informasi Nagari dengan akun yang sudah terdaftar di website nagari. Akun dapat digunakan sehari setelah registrasi.</p>
                </div>
            </div>
        </div>

        {{-- Langkah 2 --}}
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
            <img src="{{ asset('images/langkah-pengajuan-surat/langkah-2.png') }}" class="card-img-top" alt="Langkah 4" style="object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">2. Pilih Menu Layanan Surat</h5>
                    <p class="card-text">Pilih menu "Layanan Surat Mandiri" untuk mengajukan permohonan surat.</p>
                </div>
            </div>
        </div>

        {{-- Langkah 3 --}}
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
            <img src="{{ asset('images/langkah-pengajuan-surat/langkah-3.png') }}" class="card-img-top" alt="Langkah 4" style="object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">3. Pilih Layanan Surat yang Diinginkan</h5>
                    <p class="card-text">Terdapat beberapa layanan surat yang dapat anda ajukan, beserta persyaratannya. Tombol "Permohonan Saya" akan menampilkan status surat yang anda ajukan.</p>
                </div>
            </div>
        </div>

        {{-- Langkah 4 --}}
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
            <img src="{{ asset('images/langkah-pengajuan-surat/langkah-4.png') }}" class="card-img-top" alt="Langkah 4" style="object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">4. Masukkan File - File Persyaratan</h5>
                    <p class="card-text">Masukkan seluruh file - file yang diperlukan, kemudian tekan tombol "Ajukan"</p>
                </div>
            </div>
        </div>

        {{-- Langkah 5 --}}
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
            <img src="{{ asset('images/langkah-pengajuan-surat/langkah-5.png') }}" class="card-img-top" alt="Langkah 4" style="object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">5. Periksa Status Permintaan Surat</h5>
                    <p class="card-text">Setelah menekan tombol "Permohonan Saya", akan muncul status apa saja permohonan yang sedang diajukan</p>
                </div>
            </div>
        </div>

        {{-- Langkah 6 --}}
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
            <img src="{{ asset('images/langkah-pengajuan-surat/langkah-6.png') }}" class="card-img-top" alt="Langkah 4" style="object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">6. Download Surat yang Diajukan</h5>
                    <p class="card-text">Jika surat sudah selesai, admin akan mengirimkan surat yang dapat didownload dengan menekan tombol hijau</p>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <a href="{{ route('user.pages.layanan-mandiri.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>
@endsection