@extends('user.layout.app')

@section('title', 'Guguak Malalo | Profil Nagari')

@section('content')

<section id="visi-misi" class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Visi dan Misi Nagari</h2>

        <div class="row">
            {{-- Visi Nagari --}}
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="card-title fw-bold text-success mb-3"><i class="fa-solid fa-eye me-2"></i> Visi Nagari</h3>
                        {{-- Tampilkan Visi dari database --}}
                        @if ($visi && $visi->content) {{-- Pastikan $visi tidak null dan kontennya ada --}}
                            <p class="card-text lead">
                                {{ $visi->content }}
                            </p>
                        @else
                            <p class="card-text lead text-muted">
                                Visi Nagari belum diatur. Silakan atur melalui panel admin.
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Misi Nagari --}}
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="card-title fw-bold text-success mb-3"><i class="fa-solid fa-bullseye me-2"></i> Misi Nagari</h3>
                        {{-- Tampilkan Misi dari database --}}
                        @if ($misiItems->isNotEmpty()) {{-- Pastikan koleksi misi tidak kosong --}}
                            <ul class="list-unstyled lead mb-0">
                                @foreach ($misiItems as $item)
                                    <li>{{ $item->order ? $item->order . '. ' : '' }}{{ $item->content }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="card-text lead text-muted">
                                Misi Nagari belum diatur. Silakan atur melalui panel admin.
                            </p>
                        @endif
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
                    Sejak dahulu kala, Guguak Malalo dikenal sebagai daerah agraris yang subur, dengan mayoritas penduduknya berprofesi sebagai petani. Kehidupan sosial masyarakatnya sangat erat kaitannya dengan nilai-nilai adat dan agama, di mana "Adat Basandi Syarak, Syarak Basandi Kitabullah" menjadi landasan utama dalam setiap sendi kehidupan. Berbagai tradisi dan upacara adat masih terus dilestarikan hingga kini, menunjukkan kuatnya akar budaya yang diwarisi dari nenek moyang.
                </p>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('sejarah-nagari') }}" class="btn btn-custom btn-md px-4">Lihat Selengkapnya <i class="fa-solid fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<section id="peta-nagari" class="py-5">
    <div class="container">
        <h3 class="text-center fw-bold mb-5">Peta Lokasi Nagari Guguak Malalo</h3>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="ratio ratio-16x9 shadow-lg rounded-3 overflow-hidden">
                    {{-- Embed Peta Google Maps --}}
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127666.57273412065!2d100.36541512255977!3d-0.625721238281254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4d783a8a2b2f5%3A0xce99a32dfcc4976c!2sGuguak%20Malalo%2C%20Kecamatan%20Batipuh%20Selatan%2C%20Kabupaten%20Tanah%20Datar%2C%20Sumatera%20Barat!5e0!3m2!1sid!2sid!4v1754972123386!5m2!1sid!2sid" 
                        width="400" 
                        height="300" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="struktur-organisasi" class="py-5">
    <div class="container">
        <h3 class="text-center fw-bold mb-5">Struktur Organisasi Perangkat Nagari</h3>

        <div class="row mb-5 justify-content-center">
            <div class="col-lg-10 col-md-11 text-center">
                {{-- PERUBAHAN DI SINI: Gunakan variabel $strukturBagan --}}
                @if ($strukturBagan && $strukturBagan->image)
                    <img src="{{ asset('storage/' . $strukturBagan->image) }}" alt="Bagan Struktur Organisasi Nagari" class="img-fluid rounded shadow-sm" style="max-width: 100%; height: auto;">
                @endif
                <p class="small text-muted mt-3">Struktur Organisasi Pemerintahan Nagari Guguak Malalo</p>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-lg-4 g-4 justify-content-center">
            @forelse ($officials as $official)
                <div class="col">
                    <div class="card h-100 text-center shadow-sm">
                        @if ($official->photo)
                            <img src="{{ asset('storage/' . $official->photo) }}" class="card-img-top mx-auto mt-3 rounded-circle" alt="Foto {{ $official->name }}" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-profile.png') }}" alt="Foto Default" class="card-img-top mx-auto mt-3 rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title fw-bold mb-1">{{ $official->name }}</h5>
                                <p class="card-text text-muted mb-2">{{ $official->position }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted">Data perangkat nagari belum tersedia.</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('perangkat-nagari') }}" class="btn btn-custom btn-md px-4">Lihat Selengkapnya <i class="fa-solid fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>
@endsection


