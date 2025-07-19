@extends('user.layout.app')

@section('content')
      <!-- Hero Section -->
      <section id="hero">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
      
            <!-- Slide 1 -->
            <div class="carousel-item active">
            <div class="hero-slide bg-cover d-flex align-items-center justify-content-center text-white" style="background-image: url('{{ asset('images/hero_slide1.jpg') }}');">
                <div class="text-center">
                  <h1 class="display-4 fw-bold">Selamat Datang di</h1>
                  <h1 class="display-4 fw-bold">Nagari Guguak Malalo</h1>
                  <p class="lead">Sumber informasi dan layanan Nagari Guguak Malalo</p>
                </div>
              </div>
            </div>
      
            <!-- Slide 2 -->
            <div class="carousel-item">
              <div class="hero-slide bg-cover d-flex align-items-center justify-content-center text-white" style="background-image: url('{{ asset('images/hero_slide2.jpg') }}');">
                <div class="text-center">
                  <h1 class="display-5 fw-bold">Sejarah Nagari</h1>
                  <p class="lead">Nagari Guguak Malalo memiliki sejarah panjang dalam perjuangan dan budaya masyarakat Minangkabau.</p>
                </div>
              </div>
            </div>
      
            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="hero-slide bg-cover d-flex align-items-center justify-content-center text-white" style="background-image: url('{{ asset('images/hero_slide3.jpg') }}');">
                    <div class="container">
                        <div class="row text-center">
                            {{-- Visi Nagari --}}
                            <div class="col-md-6 mb-4">
                                <h1 class="display-5 fw-bold text-white">Visi Nagari</h1>
                                @if ($visi && $visi->content) {{-- Cek apakah visi ada dan kontennya tidak kosong --}}
                                    <p class="lead text-white">{{ $visi->content }}</p>
                                @else
                                    <p class="lead text-white text-muted">Visi Nagari belum diatur.</p>
                                @endif
                            </div>

                            {{-- Misi Nagari --}}
                            <div class="col-md-6">
                                <h1 class="display-5 fw-bold text-white">Misi Nagari</h1>
                                @if ($misiItems->isNotEmpty()) {{-- Cek apakah ada item misi --}}
                                    <ul class="lead list-unstyled text-white">
                                        @foreach ($misiItems as $item)
                                            <li>{{ $item->order ? $item->order . '. ' : '' }}{{ $item->content }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="lead text-white text-muted">Misi Nagari belum diatur.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      
          <!-- Controls -->
          <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <i class="fa-solid fa-arrow-left"></i>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <i class="fa-solid fa-arrow-right"></i>
          </button>
      
        </div>
      </section>

      <!-- Jelajahi Desa Section -->
        <section id="jelajahi-desa" class="py-4 bg-light">
            <div class="container text-center">
                <h2 class="mb-5 fw-bold">Jelajahi Nagari Guguak Malalo</h2>
                <div class="row row-cols-2 row-cols-lg-4 g-4">
                    <div class="col">
                        <a href="{{ url('/berita') }}" class="btn btn-outline-primary btn-lg w-100 py-4 shadow-sm d-flex flex-column align-items-center justify-content-center">
                            <i class="fa-solid fa-newspaper fa-3x mb-3"></i>
                            <span class="fw-semibold fs-5">Berita</span>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#wilayah-detail" class="btn btn-outline-success btn-lg w-100 py-4 shadow-sm d-flex flex-column align-items-center justify-content-center">
                            <i class="fa-solid fa-map-marked-alt fa-3x mb-3"></i> <span class="fw-semibold fs-5">Wilayah</span>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#umkm-detail" class="btn btn-outline-warning btn-lg w-100 py-4 shadow-sm d-flex flex-column align-items-center justify-content-center">
                            <i class="fa-solid fa-store fa-3x mb-3"></i> <span class="fw-semibold fs-5">UMKM</span>
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ url('/wisata') }}" class="btn btn-outline-info btn-lg w-100 py-4 shadow-sm d-flex flex-column align-items-center justify-content-center">
                            <i class="fa-solid fa-camera-retro fa-3x mb-3"></i> <span class="fw-semibold fs-5">Pariwisata</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistik Nagari Section -->
        <section id="statistik-nagari" class="py-4">
            <div class="container">
                <h2 class="text-center mb-5 fw-bold">Statistik Nagari</h2>

                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 justify-content-center">
                    <div class="col">
                        <div class="card shadow-sm p-4 h-100 d-flex flex-column justify-content-center align-items-center text-center">
                            <div class="card-body">
                                <i class="fa-solid fa-users fa-3x text-primary mb-3"></i> <h3 class="card-title display-5 fw-bold text-primary">{{ number_format($totalPenduduk) }}</h3>
                                <p class="card-text fs-6">Jumlah Penduduk</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card shadow-sm p-4 h-100 d-flex flex-column justify-content-center align-items-center text-center">
                            <div class="card-body">
                                <i class="fa-solid fa-store fa-3x text-success mb-3"></i> <h3 class="card-title display-5 fw-bold text-success">10</h3> {{-- Anda perlu variabel $jumlahUmkm dari backend --}}
                                <p class="card-text fs-6">Jumlah UMKM</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card shadow-sm p-4 h-100 d-flex flex-column justify-content-center align-items-center text-center">
                            <div class="card-body">
                                <i class="fa-solid fa-seedling fa-3x text-info mb-3"></i> <h3 class="card-title display-5 fw-bold text-info">50</h3> {{-- Anda perlu variabel $jumlahPertanian dari backend --}}
                                <p class="card-text fs-6">Jumlah Pertanian</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card shadow-sm p-4 h-100 d-flex flex-column justify-content-center align-items-center text-center">
                            <div class="card-body">
                                <i class="fa-solid fa-cow fa-3x text-warning mb-3"></i> <h3 class="card-title display-5 fw-bold text-warning">20</h3> {{-- Anda perlu variabel $jumlahPeternakan dari backend --}}
                                <p class="card-text fs-6">Jumlah Peternakan</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card shadow-sm p-4 h-100 d-flex flex-column justify-content-center align-items-center text-center">
                            <div class="card-body">
                                <i class="fa-solid fa-stethoscope fa-3x text-danger mb-3"></i> <h3 class="card-title display-5 fw-bold text-danger">30</h3> {{-- Anda perlu variabel $jumlahNakes dari backend --}}
                                <p class="card-text fs-6">Jumlah Tenaga Kesehatan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Berita Section -->
        <section id="berita-nagari" class="py-5 bg-light"> {{-- Gunakan bg-light untuk kontras --}}
            <div class="container">
                <h2 class="text-center mb-5 fw-bold">Berita Terbaru Nagari</h2>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @forelse ($latestNews as $item) {{-- Loop melalui 6 berita terbaru --}}
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0">
                                @if ($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" class="card-img-top rounded-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/default-news.png') }}" class="card-img-top rounded-top" alt="Gambar Default" style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <small class="text-muted mb-2">
                                        {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->locale('id')->translatedFormat('d M Y') : 'Draft' }}
                                    </small>
                                    <h5 class="card-title fw-bold mt-2 mb-3">{{ $item->title }}</h5>
                                    <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($item->content), 100, '...') }}</p>
                                </div>
                                <div class="card-footer bg-white border-0 d-flex justify-content-end">
                                    <a href="{{ route('berita.show', $item->slug) }}" class="btn btn-sm btn-custom-readmore">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4">
                            <p>Belum ada berita terbaru yang dapat ditampilkan.</p>
                        </div>
                    @endforelse
                </div>

                <div class="text-center mt-5">
                    {{-- Tombol untuk melihat semua berita --}}
                    <a href="{{ route('berita.index') }}" class="btn btn-custom btn-md px-4">Lihat Semua Berita <i class="fa-solid fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </section>

        <section id="galeri-nagari" class="py-5"> {{-- Warna background default (putih) --}}
            <div class="container">
                <h2 class="text-center mb-5 fw-bold">Galeri Terbaru Nagari</h2>

                <div class="row row-cols-2 row-cols-md-2 row-cols-lg-3 g-4">
                    @forelse ($latestGalleries as $item) {{-- Loop melalui 6 gambar galeri terbaru --}}
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0">
                                @if ($item->photo)
                                    <img src="{{ asset('storage/' . $item->photo) }}" class="card-img-top rounded-lg" alt="{{ $item->activity_name }}" style="height: 250px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/default-gallery.png') }}" class="card-img-top rounded-lg" alt="Gambar Default" style="height: 250px; object-fit: cover;">
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p>Belum ada foto galeri terbaru yang dapat ditampilkan.</p>
                        </div>
                    @endforelse
                </div>

                <div class="text-center mt-5">
                    {{-- Tombol untuk melihat semua galeri --}}
                    <a href="{{ route('galeri.index') }}" class="btn btn-custom btn-md px-4">Lihat Semua Galeri <i class="fa-solid fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </section>

        <section id="wisata-landing" class="py-5 text-white d-flex align-items-center justify-content-center" style="
            background-image: url('{{ asset('images/wisata.jpg') }}'); {{-- Ganti dengan gambar wisata pilihan kamu --}}
            background-size: cover;
            background-position: center;
            min-height: 500px; {{-- Tinggi minimal section --}}
            position: relative;">

            {{-- Overlay gelap di atas gambar background --}}
            <div class="overlay" style="position: absolute; inset: 0; background-color: rgba(0,0,0,0.6); z-index: 1;"></div>

            <div class="container text-center" style="position: relative; z-index: 2;">
                <h2 class="display-4 fw-bold mb-4">Pesona Wisata Nagari</h2>
                <p class="lead mb-5 mx-auto" style="max-width: 800px;">
                    Nagari Guguak Malalo menyimpan keindahan alam dan kekayaan budaya yang siap dijelajahi. Setiap sudut Nagari menawarkan pengalaman tak terlupakan.
                </p>
                <a href="{{ route('wisata.index') }}" class="btn btn-light btn-md px-4 shadow-sm">
                    Lihat Semua Wisata <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
            </div>
        </section>
@endsection