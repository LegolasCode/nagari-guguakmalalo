<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Maju Jaya - Website Resmi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom CSS */
        .hero-slide {
            scroll-snap-type: x mandatory;
        }
        .hero-slide-item {
            scroll-snap-align: start;
        }
        .news-card {
            transition: transform 0.3s ease;
        }
        .news-card:hover {
            transform: translateY(-5px);
        }
        .map-container {
            position: relative;
            overflow: hidden;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
        }
        .map-iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="font-sans bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-green-700 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-tree text-2xl"></i>
                    <span class="text-xl font-bold">Nagari Guguak Malalo</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="hover:text-yellow-300 font-medium">Beranda</a>
                    <a href="#" class="hover:text-yellow-300 font-medium">Profil Desa</a>
                    <a href="#" class="hover:text-yellow-300 font-medium">Informasi</a>
                    <a href="#" class="hover:text-yellow-300 font-medium">UMKM</a>
                    <a href="#" class="hover:text-yellow-300 font-medium">Pelayanan</a>
                    <a href="#" class="hover:text-yellow-300 font-medium">Kontak</a>
                    <a href="{{ route('login') }}" class="bg-yellow-500 hover:bg-yellow-600 text-gray-800 px-4 py-2 rounded-lg font-medium transition">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                </div>
                <button class="md:hidden text-2xl" id="mobile-menu-button">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <!-- Mobile Menu -->
            <div class="md:hidden hidden mt-4 pb-2" id="mobile-menu">
                <a href="#" class="block py-2 hover:bg-green-600 px-2 rounded">Beranda</a>
                <a href="#" class="block py-2 hover:bg-green-600 px-2 rounded">Profil Desa</a>
                <a href="#" class="block py-2 hover:bg-green-600 px-2 rounded">Informasi</a>
                <a href="#" class="block py-2 hover:bg-green-600 px-2 rounded">UMKM</a>
                <a href="#" class="block py-2 hover:bg-green-600 px-2 rounded">Pelayanan</a>
                <a href="#" class="block py-2 hover:bg-green-600 px-2 rounded">Kontak</a>
                <a href="{{ route('login') }}" class="w-full mt-2 bg-yellow-500 hover:bg-yellow-600 text-gray-800 px-4 py-2 rounded-lg font-medium transition">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Horizontal Scroll -->
    <section class="relative bg-green-600 text-white overflow-hidden">
        <div class="flex overflow-x-auto hero-slide snap-x snap-mandatory h-[500px] scrollbar-hide">
            <!-- Slide 1 - Deskripsi Desa -->
            <div class="hero-slide-item flex-shrink-0 w-full h-full flex items-center">
                <div class="container mx-auto px-4 py-12 flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 mb-8 md:mb-0">
                        <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di Desa Maju Jaya</h1>
                        <p class="text-lg mb-6">Desa Maju Jaya adalah desa yang terletak di wilayah yang subur dengan masyarakat yang ramah dan gotong royong. Kami memiliki berbagai potensi alam dan sumber daya manusia yang unggul.</p>
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-gray-800 px-6 py-3 rounded-lg font-medium transition">
                            Jelajahi Desa Kami <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                    <div class="md:w-1/2 flex justify-center">
                        <img src="https://images.unsplash.com/photo-1605000797499-95a51c5269ae?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80" 
                             alt="Desa Maju Jaya" 
                             class="rounded-lg shadow-2xl max-h-80 w-auto object-cover">
                    </div>
                </div>
            </div>
            
            <!-- Slide 2 - Sejarah Desa -->
            <div class="hero-slide-item flex-shrink-0 w-full h-full flex items-center bg-green-700">
                <div class="container mx-auto px-4 py-12 flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 mb-8 md:mb-0">
                        <h1 class="text-4xl md:text-5xl font-bold mb-4">Sejarah Desa Maju Jaya</h1>
                        <p class="text-lg mb-6">Desa Maju Jaya berdiri pada tahun 1920 dengan nama awal Desa Sukamaju. Pada tahun 1975, nama desa diubah menjadi Desa Maju Jaya untuk mencerminkan semangat kemajuan dan kesejahteraan masyarakat.</p>
                        <p class="text-lg">Selama puluhan tahun, desa kami telah berkembang menjadi pusat pertanian dan kerajinan tangan yang dikenal di wilayah ini.</p>
                    </div>
                    <div class="md:w-1/2 flex justify-center">
                        <img src="https://images.unsplash.com/photo-1580130732478-4d4f1d3a4f6f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                             alt="Sejarah Desa" 
                             class="rounded-lg shadow-2xl max-h-80 w-auto object-cover">
                    </div>
                </div>
            </div>
            
            <!-- Slide 3 - Visi Misi -->
            <div class="hero-slide-item flex-shrink-0 w-full h-full flex items-center bg-green-800">
                <div class="container mx-auto px-4 py-12">
                    <h1 class="text-4xl md:text-5xl font-bold mb-8 text-center">Visi & Misi Desa Maju Jaya</h1>
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="bg-white bg-opacity-10 p-6 rounded-lg backdrop-blur-sm">
                            <h2 class="text-2xl font-bold mb-4 text-yellow-300">Visi</h2>
                            <p class="text-lg">"Mewujudkan Desa Maju Jaya yang mandiri, sejahtera, dan berbudaya melalui pengelolaan sumber daya alam dan manusia yang berkelanjutan."</p>
                        </div>
                        <div class="bg-white bg-opacity-10 p-6 rounded-lg backdrop-blur-sm">
                            <h2 class="text-2xl font-bold mb-4 text-yellow-300">Misi</h2>
                            <ul class="list-disc pl-5 space-y-2 text-lg">
                                <li>Meningkatkan kualitas sumber daya manusia</li>
                                <li>Mengembangkan potensi ekonomi desa</li>
                                <li>Melestarikan budaya dan kearifan lokal</li>
                                <li>Membangun infrastruktur yang memadai</li>
                                <li>Mewujudkan tata kelola pemerintahan yang baik</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Slide Indicators -->
        <div class="absolute bottom-6 left-0 right-0 flex justify-center space-x-2">
            <button class="w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 slide-indicator" data-slide="0"></button>
            <button class="w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 slide-indicator" data-slide="1"></button>
            <button class="w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 slide-indicator" data-slide="2"></button>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Statistik Desa</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="stat-card bg-green-50 p-6 rounded-lg shadow-md text-center">
                    <div class="text-green-600 text-4xl mb-3">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Jumlah Penduduk</h3>
                    <p class="text-3xl font-bold text-green-700">3,245</p>
                    <p class="text-gray-600">Jiwa</p>
                </div>
                <div class="stat-card bg-blue-50 p-6 rounded-lg shadow-md text-center">
                    <div class="text-blue-600 text-4xl mb-3">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Jumlah KK</h3>
                    <p class="text-3xl font-bold text-blue-700">856</p>
                    <p class="text-gray-600">Keluarga</p>
                </div>
                <div class="stat-card bg-yellow-50 p-6 rounded-lg shadow-md text-center">
                    <div class="text-yellow-600 text-4xl mb-3">
                        <i class="fas fa-store"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">UMKM</h3>
                    <p class="text-3xl font-bold text-yellow-700">127</p>
                    <p class="text-gray-600">Usaha</p>
                </div>
                <div class="stat-card bg-red-50 p-6 rounded-lg shadow-md text-center">
                    <div class="text-red-600 text-4xl mb-3">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Luas Wilayah</h3>
                    <p class="text-3xl font-bold text-red-700">542</p>
                    <p class="text-gray-600">Hektar</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Peta Desa</h2>
            <div class="map-container rounded-lg shadow-xl overflow-hidden">
                <iframe class="map-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127666.57273410047!2d100.36541552131034!3d-0.6257212391181979!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4d783a8a2b2f5%3A0xce99a32dfcc4976c!2sGuguak%20Malalo%2C%20Kecamatan%20Batipuh%20Selatan%2C%20Kabupaten%20Tanah%20Datar%2C%20Sumatera%20Barat!5e0!3m2!1sid!2sid!4v1748313630944!5m2!1sid!2sid"
                        allowfullscreen="" 
                        loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <!-- UMKM Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Produk UMKM Desa</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- UMKM Item 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <img src="https://images.unsplash.com/photo-1603569283847-aa6f0c5d0b6d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Kerajinan Bambu" 
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Kerajinan Bambu</h3>
                        <p class="text-gray-600 mb-4">Berbagai produk kerajinan tangan dari bambu seperti tempat tisu, vas bunga, dan peralatan rumah tangga.</p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-green-600">Rp 50.000 - Rp 500.000</span>
                            <button class="text-green-600 hover:text-green-800">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- UMKM Item 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <img src="https://images.unsplash.com/photo-1615368144592-3b3c3a3d3b3d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Makanan Tradisional" 
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Makanan Tradisional</h3>
                        <p class="text-gray-600 mb-4">Berbagai makanan khas desa seperti dodol, wajik, dan jenang yang dibuat dengan resep turun temurun.</p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-green-600">Rp 15.000 - Rp 100.000</span>
                            <button class="text-green-600 hover:text-green-800">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- UMKM Item 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <img src="https://images.unsplash.com/photo-1615368144592-3b3c3a3d3b3d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Tenun Ikat" 
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Tenun Ikat</h3>
                        <p class="text-gray-600 mb-4">Kain tenun ikat dengan motif tradisional yang dibuat secara manual oleh pengrajin lokal.</p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-green-600">Rp 150.000 - Rp 1.500.000</span>
                            <button class="text-green-600 hover:text-green-800">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8 text-center">
                <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition">
                    Lihat Semua Produk UMKM <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Complaint Button Section -->
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Layanan Pengaduan Masyarakat</h2>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">Jika Anda memiliki keluhan atau masukan untuk kemajuan desa, silakan sampaikan melalui tombol di bawah ini.</p>
            <button class="bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-lg font-medium text-lg transition shadow-lg hover:shadow-xl flex items-center mx-auto">
                <i class="fas fa-comment-dots mr-3"></i> Buat Pengaduan
            </button>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Berita Terkini</h2>
                <a href="#" class="text-green-600 hover:text-green-800 font-medium">
                    Lihat Semua Berita <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            <div class="flex overflow-x-auto pb-6 scrollbar-hide -mx-2">
                <!-- News Item 1 -->
                <div class="flex-shrink-0 px-2 w-80">
                    <div class="news-card bg-white rounded-lg shadow-md overflow-hidden h-full">
                        <img src="https://images.unsplash.com/photo-1580130732478-4d4f1d3a4f6f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                             alt="Berita 1" 
                             class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <span><i class="far fa-calendar-alt mr-1"></i> 15 Agustus 2023</span>
                                <span class="mx-2">•</span>
                                <span><i class="far fa-user mr-1"></i> Admin Desa</span>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Pembangunan Jalan Desa Tahap II Dimulai</h3>
                            <p class="text-gray-600 mb-4">Pembangunan jalan desa tahap II sepanjang 1.5 km telah dimulai dan ditargetkan selesai dalam 3 bulan.</p>
                            <a href="#" class="text-green-600 hover:text-green-800 font-medium">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- News Item 2 -->
                <div class="flex-shrink-0 px-2 w-80">
                    <div class="news-card bg-white rounded-lg shadow-md overflow-hidden h-full">
                        <img src="https://images.unsplash.com/photo-1580130732478-4d4f1d3a4f6f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                             alt="Berita 2" 
                             class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <span><i class="far fa-calendar-alt mr-1"></i> 10 Agustus 2023</span>
                                <span class="mx-2">•</span>
                                <span><i class="far fa-user mr-1"></i> Admin Desa</span>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Pelatihan Pembuatan Kompos untuk Warga</h3>
                            <p class="text-gray-600 mb-4">Desa mengadakan pelatihan pembuatan kompos organik untuk memanfaatkan limbah rumah tangga.</p>
                            <a href="#" class="text-green-600 hover:text-green-800 font-medium">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- News Item 3 -->
                <div class="flex-shrink-0 px-2 w-80">
                    <div class="news-card bg-white rounded-lg shadow-md overflow-hidden h-full">
                        <img src="https://images.unsplash.com/photo-1580130732478-4d4f1d3a4f6f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                             alt="Berita 3" 
                             class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <span><i class="far fa-calendar-alt mr-1"></i> 5 Agustus 2023</span>
                                <span class="mx-2">•</span>
                                <span><i class="far fa-user mr-1"></i> Admin Desa</span>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Festival Budaya Desa Maju Jaya 2023</h3>
                            <p class="text-gray-600 mb-4">Festival budaya tahunan akan digelar pada 20 Agustus mendatang dengan berbagai pertunjukan seni.</p>
                            <a href="#" class="text-green-600 hover:text-green-800 font-medium">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- News Item 4 -->
                <div class="flex-shrink-0 px-2 w-80">
                    <div class="news-card bg-white rounded-lg shadow-md overflow-hidden h-full">
                        <img src="https://images.unsplash.com/photo-1580130732478-4d4f1d3a4f6f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                             alt="Berita 4" 
                             class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <span><i class="far fa-calendar-alt mr-1"></i> 1 Agustus 2023</span>
                                <span class="mx-2">•</span>
                                <span><i class="far fa-user mr-1"></i> Admin Desa</span>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Pembagian Bantuan Sosial Tahap III</h3>
                            <p class="text-gray-600 mb-4">Pemerintah desa akan membagikan bantuan sosial kepada 150 keluarga kurang mampu.</p>
                            <a href="#" class="text-green-600 hover:text-green-800 font-medium">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Profile Section -->
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Video Profil Desa</h2>
            <div class="max-w-4xl mx-auto">
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-96 rounded-lg shadow-xl" 
                            src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
                            title="YouTube video player" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen></iframe>
                </div>
                <div class="mt-6 text-center">
                    <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition">
                        <i class="fas fa-share-alt mr-2"></i> Bagikan Video Ini
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <i class="fas fa-tree mr-2"></i> Nagari Guguak Malalo
                    </h3>
                    <p class="text-gray-300">Desa Maju Jaya adalah desa yang terletak di kecamatan Sukamaju, kabupaten Maju Jaya, provinsi Jawa Barat.</p>
                    <div class="mt-4 flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white text-xl">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white text-xl">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white text-xl">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">Beranda</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Profil Desa</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Informasi</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">UMKM</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Pelayanan</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Kontak</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Kontak Kami</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-green-400"></i>
                            <span class="text-gray-300">Jl. Desa Maju No. 123, Kec. Sukamaju, Kab. Maju Jaya, Jawa Barat</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-green-400"></i>
                            <span class="text-gray-300">(0265) 1234567</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-green-400"></i>
                            <span class="text-gray-300">desamajujaya@email.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-300 text-sm mb-4 md:mb-0">© 2025 Nagari Guguak Malalo. Seluruh hak cipta dilindungi.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-300 hover:text-white text-sm">Kebijakan Privasi</a>
                    <a href="#" class="text-gray-300 hover:text-white text-sm">Syarat & Ketentuan</a>
                    <a href="#" class="text-gray-300 hover:text-white text-sm">Peta Situs</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Hero Slider Navigation
        const heroSlider = document.querySelector('.hero-slide');
        const slideIndicators = document.querySelectorAll('.slide-indicator');
        
        slideIndicators.forEach(indicator => {
            indicator.addEventListener('click', function() {
                const slideIndex = parseInt(this.getAttribute('data-slide'));
                const slideWidth = document.querySelector('.hero-slide-item').offsetWidth;
                heroSlider.scrollTo({
                    left: slideWidth * slideIndex,
                    behavior: 'smooth'
                });
                
                // Update active indicator
                slideIndicators.forEach(ind => ind.classList.remove('bg-opacity-100'));
                this.classList.add('bg-opacity-100');
            });
        });

        // Auto slide change
        let currentSlide = 0;
        setInterval(() => {
            currentSlide = (currentSlide + 1) % 3;
            const slideWidth = document.querySelector('.hero-slide-item').offsetWidth;
            heroSlider.scrollTo({
                left: slideWidth * currentSlide,
                behavior: 'smooth'
            });
            
            // Update active indicator
            slideIndicators.forEach((ind, index) => {
                if(index === currentSlide) {
                    ind.classList.add('bg-opacity-100');
                } else {
                    ind.classList.remove('bg-opacity-100');
                }
            });
        }, 5000);

        // Update indicators on scroll
        heroSlider.addEventListener('scroll', function() {
            const slideWidth = document.querySelector('.hero-slide-item').offsetWidth;
            const current = Math.round(this.scrollLeft / slideWidth);
            
            slideIndicators.forEach((ind, index) => {
                if(index === current) {
                    ind.classList.add('bg-opacity-100');
                } else {
                    ind.classList.remove('bg-opacity-100');
                }
            });
        });
    </script>
</body>
</html>