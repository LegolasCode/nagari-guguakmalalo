@extends('user.layout.app')

@section('content')
      <!-- Hero Section -->
      <section id="hero">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
      
            <!-- Slide 1 -->
            <div class="carousel-item active">
            <div class="hero-slide bg-cover d-flex align-items-center justify-content-center text-white" style="background-image: url('{{ asset('images/hero_slide1.jpeg') }}');">
                <div class="text-center">
                  <h1 class="display-4 fw-bold">Selamat Datang di Website Nagari</h1>
                  <p class="lead">Nagari Guguak Malalo</p>
                </div>
              </div>
            </div>
      
            <!-- Slide 2 -->
            <div class="carousel-item">
              <div class="hero-slide bg-cover d-flex align-items-center justify-content-center text-white" style="background-image: url('{{ asset('images/hero_slide2.jpeg') }}');">
                <div class="text-center">
                  <h1 class="display-5 fw-bold">Sejarah Nagari</h1>
                  <p class="lead">Nagari Guguak Malalo memiliki sejarah panjang dalam perjuangan dan budaya masyarakat Minangkabau.</p>
                </div>
              </div>
            </div>
      
            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="hero-slide bg-cover d-flex align-items-center justify-content-center text-white" style="background-image: url('{{ asset('images/hero_slide3.jpeg') }}');">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col-md-6 mb-4">
                            <h1 class="display-5 fw-bold text-white">Visi Nagari</h1> <p class="lead text-white">Mewujudkan masyarakat yang sejahtera, mandiri, dan berbudaya dengan pelayanan publik yang optimal.</p> </div>

                            <div class="col-md-6">
                                <h1 class="display-5 fw-bold text-white">Misi Nagari</h1> 
                                    <ul class="lead list-unstyled text-white"> 
                                        <li>1. Mewujudkan cita-cita masyarakat Nagari</li>
                                        <li>2. Mewujudkan pelayanan publik yang optimal</li>
                                    </ul>
                            </div>
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
        <section id="jelajahi-desa" class="py-5 bg-light">
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
                        <a href="#pariwisata-detail" class="btn btn-outline-info btn-lg w-100 py-4 shadow-sm d-flex flex-column align-items-center justify-content-center">
                            <i class="fa-solid fa-camera-retro fa-3x mb-3"></i> <span class="fw-semibold fs-5">Pariwisata</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Data Penduduk Section -->
        <section id="data-penduduk" class="py-5">
            <div class="container">
                <h2 class="text-center mb-5 fw-bold">Data Penduduk Nagari</h2>

                <div class="row row-cols-3 row-cols-lg-4 g-4 justify-content-center">
                    <div class="col">
                        <div class="card shadow-sm p-4 h-100 d-flex flex-column justify-content-center">
                            <div class="card-body">
                                <i class="fa-solid fa-users-line fa-4x text-primary mb-3"></i>
                                <h3 class="card-title display-4 fw-bold text-primary">1.250</h3>
                                <p class="card-text fs-5">Total Penduduk</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card shadow-sm p-4 h-100 d-flex flex-column justify-content-center">
                            <div class="card-body">
                                <i class="fa-solid fa-person fa-4x text-info mb-3"></i>
                                <h3 class="card-title display-4 fw-bold text-info">600</h3>
                                <p class="card-text fs-5">Laki-laki</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card shadow-sm p-4 h-100 d-flex flex-column justify-content-center">
                            <div class="card-body">
                                <i class="fa-solid fa-person-dress fa-4x text-danger mb-3"></i>
                                <h3 class="card-title display-4 fw-bold text-danger">650</h3>
                                <p class="card-text fs-5">Perempuan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection