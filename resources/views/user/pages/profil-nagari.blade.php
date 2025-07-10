@extends('user.layout.app')

@section('content')

<section id="visi-misi" class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Visi dan Misi Nagari</h2>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="card-title fw-bold text-primary mb-3"><i class="fa-solid fa-eye me-2"></i> Visi Nagari</h3>
                        <p class="card-text lead">
                            Mewujudkan masyarakat Nagari Guguak Malalo yang sejahtera, mandiri, dan berbudaya dengan pelayanan publik yang optimal.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="card-title fw-bold text-success mb-3"><i class="fa-solid fa-bullseye me-2"></i> Misi Nagari</h3>
                        <ul class="list-unstyled lead mb-0">
                            <li>1. Mewujudkan cita-cita masyarakat Nagari Guguak Malalo.</li>
                            <li>2. Meningkatkan kualitas pelayanan publik secara transparan dan akuntabel.</li>
                            <li>3. Mengembangkan potensi ekonomi lokal berbasis pertanian dan UMKM.</li>
                            <li>4. Melestarikan adat dan budaya Minangkabau di tengah kemajuan zaman.</li>
                            <li>5. Meningkatkan partisipasi masyarakat dalam pembangunan Nagari.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="sejarah-nagari" class="py-5 bg-light"> {{-- Gunakan bg-light untuk kontras dengan section sebelumnya --}}
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Sejarah Nagari Guguak Malalo</h2>

        <div class="row align-items-center"> {{-- align-items-center untuk menengahkan konten secara vertikal --}}
            <div class="col-lg-4 col-md-5 mb-4 mb-md-0 d-flex justify-content-center"> {{-- Flexbox untuk memusatkan gambar di tengah kolom --}}
                <img src="{{ asset('images/logo_nagari.png') }}" alt="Logo Nagari Guguak Malalo" class="img-fluid" style="max-width: 250px;"> {{-- max-width untuk kontrol ukuran --}}
            </div>

            <div class="col-lg-8 col-md-7">
                <p class="mb-4">
                    Nagari Guguak Malalo adalah salah satu nagari adat yang kaya akan sejarah dan budaya di Kabupaten Tanah Datar, Sumatera Barat. Berlokasi strategis di lereng Bukit Barisan, nagari ini telah menjadi saksi bisu perjalanan waktu dan perkembangan peradaban masyarakat Minangkabau.
                </p>
                <p class="mb-4">
                    Sejak dahulu kala, Guguak Malalo dikenal sebagai daerah agraris yang subur, dengan mayoritas penduduknya berprofesi sebagai petani. Kehidupan sosial masyarakatnya sangat erat kaitannya dengan nilai-nilai adat dan agama, di mana "Adat Basandi Syarak, Syarak Basandi Kitabullah" menjadi landasan utama dalam setiap sendi kehidupan. Berbagai tradisi dan upacara adat masih terus dilestarikan hingga kini, menunjukkan kuatnya akar budaya yang diwarisi dari nenek moyang.
                </p>
            </div>
        </div>
    </div>
</section>
{{-- Lanjutkan dari kode profilNagari.blade.php sebelumnya --}}

<section id="struktur-organisasi" class="py-5"> {{-- Warna background default (putih) --}}
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Struktur Organisasi Nagari</h2>

        <div class="row mb-5 justify-content-center">
            <div class="col-lg-10 col-md-11 text-center">
                    <img src="{{ asset('images/struktur_organisasi.jpeg') }}" alt="Gambar Struktur Organisasi Nagari" width="720" height="4 00" class="img-fluid rounded shadow-sm">
                    <p class="small text-muted mt-3">Struktur Organisasi Pemerintahan Nagari Guguak Malalo</p>
                </div>
            </div>

            <h3 class="text-center fw-bold mb-4">Perangkat Nagari</h3>

            <div class="row row-cols-2 row-cols-lg-4 g-4 justify-content-center">
                {{-- Pengurus 1: Wali Nagari --}}
                <div class="col">
                    <div class="card h-100 text-center shadow-sm">
                        <img src="{{ asset('images/geby.jpg') }}" class="card-img-top mx-auto mt-3 rounded-circle" alt="Foto Pengurus 1" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title fw-bold mb-1">Geby Algrivo Gumanda</h5>
                                <p class="card-text text-muted mb-2">Wali Nagari</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pengurus 2: Sekretaris Nagari --}}
                <div class="col">
                    <div class="card h-100 text-center shadow-sm">
                        <img src="{{ asset('images/nubli.jpg') }}" class="card-img-top mx-auto mt-3 rounded-circle" alt="Foto Pengurus 2" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title fw-bold mb-1">Nubli Rahman Asri</h5>
                                <p class="card-text text-muted mb-2">Wakil Wali Nagari</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pengurus 3: Kepala Urusan Keuangan --}}
                <div class="col">
                    <div class="card h-100 text-center shadow-sm">
                        <img src="{{ asset('images/amanda.jpg') }}" class="card-img-top mx-auto mt-3 rounded-circle" alt="Foto Pengurus 3" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title fw-bold mb-1">Amanda Putri Utama</h5>
                                <p class="card-text text-muted mb-2">Sekretaris</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pengurus 4: Kepala Seksi Pelayanan --}}
                <div class="col">
                    <div class="card h-100 text-center shadow-sm">
                        <img src="{{ asset('images/salsa.jpg') }}" class="card-img-top mx-auto mt-3 rounded-circle" alt="Foto Pengurus 4" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title fw-bold mb-1">Salsa Febriana</h5>
                                <p class="card-text text-muted mb-2">Bendahara</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5"> {{-- mt-5 untuk margin atas yang cukup --}}
                <a href="{{ route('perangkat-nagari') }}" class="btn btn-primary btn-lg px-4">Lihat Selengkapnya <i class="fa-solid fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </section>
@endsection

