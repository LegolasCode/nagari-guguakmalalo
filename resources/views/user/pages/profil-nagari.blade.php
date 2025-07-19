@extends('user.layout.app')

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

<section id="struktur-organisasi" class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Perangkat Nagari</h3>
        <div class="row row-cols-2 row-cols-lg-4 g-4 justify-content-center">
            {{-- Loop untuk menampilkan daftar Pengurus dari Database --}}
            @forelse ($officials as $official) {{-- Gunakan $officials yang diteruskan dari controller --}}
                <div class="col">
                    <div class="card h-100 text-center shadow-sm">
                        @if ($official->photo)
                            {{-- Foto dari storage/app/public --}}
                            <img src="{{ asset('storage/' . $official->photo) }}" class="card-img-top mx-auto mt-3 rounded-circle" alt="Foto {{ $official->name }}" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            {{-- Gambar placeholder jika tidak ada foto --}}
                            <img src="{{ asset('images/default-profile.png') }}" class="card-img-top mx-auto mt-3 rounded-circle" alt="Foto Default" style="width: 150px; height: 150px; object-fit: cover;">
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

