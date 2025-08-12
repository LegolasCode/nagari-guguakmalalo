<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'Nagari Guguak Malalo')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo_nagari.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

    body {
    margin-top: 50px; /* Sesuaikan nilai ini sesuai tinggi navbar Anda */
    }
    
    .hero-slide {
    height: 100vh;
    background-size: cover;
    background-position: center;
    position: relative;
    }

    .hero-slide::before {
    content: "";
    position: absolute;
    inset: 0;
    background-color: rgba(0, 0, 0, 0.5); /* Efek gelap */
    z-index: 1;
    }

    .hero-slide > .text-center, /* Untuk slide 1 dan 2 */
    .hero-slide > .container {  /* Untuk slide 3 */
        z-index: 2;
        position: relative;
    }
    
    .carousel-control-prev,
    .carousel-control-next {
        z-index: 3; /* Pastikan ini lebih tinggi dari z-index overlay (z-index: 1) */
    }

    .btn-custom-readmore {
        background-color: transparent !important; 
        border-color: #003d4d !important; 
        color: #003d4d !important; 
    }

    .btn-custom-readmore:hover {
        background-color: #003d4d !important; 
        border-color: #003d4d !important; 
        color: #ffffff !important; 
    }

    .btn-custom-login, .btn-custom {
        background-color: #f0e68c !important; /* !important untuk menimpa gaya Bootstrap */
        border-color: #f0e68c !important;
        color: #000000 !important; /* Warna teks hitam agar terbaca */
    }

    /* Opsional: Efek hover untuk tombol */
    .btn-custom-login, .btn-custom:hover {
        background-color: #e0d67c !important; /* Warna sedikit lebih gelap saat di-hover */
        border-color: #e0d67c !important;
    }

    .text-custom-stats {
    color: #e0d67c !important; /* Warna kustom yang Anda inginkan */
    }

    .left-icon,
    .right-icon  {
        background-color: #003d4d;
        border-radius: 50%;
        width: 30px; /* Sesuaikan ukuran sesuai kebutuhan */
        height: 30px; /* Sesuaikan ukuran sesuai kebutuhan */
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 1; /* Pastikan ikon terlihat */
    }

    /* Animasi Fade Up */
    @keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
    }

    .hero-animate {
    animation: fadeUp 1s ease-out;
    }
    
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #fff;
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: opacity 0.5s ease-in-out;
    }

    #preloader.hidden {
        opacity: 0;
        pointer-events: none;
    }

    /* Styling animasi loader */
    .loader {
        width: 60px;
        height: 60px;
        border: 6px solid #f3f3f3;
        border-top: 6px solid #003d4d; /* Warna loading */
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    </style>
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <!-- Navbar -->
    @include('user.layout.navbar')

    <div id="main-content">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('user.layout.footer')
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stack('scripts')

<script>

// Logika Preloader
window.addEventListener('load', function() {
    const preloader = document.getElementById('preloader');
    if (preloader) {
        preloader.classList.add('hidden');
    }
});
        
// Logika AOS
AOS.init({
    duration: 1000,
     once: true
});

const carousel = document.querySelector('#heroCarousel');

if (carousel) {
    const bsCarousel = new bootstrap.Carousel(carousel, {
        interval: 5000,
        ride: 'carousel'
    });

    carousel.addEventListener('slide.bs.carousel', function (e) {
        const nextSlide = e.relatedTarget;
        const animatedElems = nextSlide.querySelectorAll('h1, p, ul, li');

        // Reset animasi elemen slide lainnya
        document.querySelectorAll('.carousel-item h1, .carousel-item p, .carousel-item ul, .carousel-item li')
            .forEach(el => el.classList.remove('hero-animate'));

        // Tambahkan animasi ke elemen slide aktif berikutnya
        animatedElems.forEach((el, i) => {
            setTimeout(() => {
                el.classList.add('hero-animate');
            }, i * 150);
        });
    });

    // Trigger animasi awal pada slide pertama
    window.addEventListener('DOMContentLoaded', () => {
        const firstSlideElems = document.querySelector('.carousel-item.active')?.querySelectorAll('h1, p, ul, li');
        if (firstSlideElems) {
            firstSlideElems.forEach((el, i) => {
                setTimeout(() => {
                    el.classList.add('hero-animate');
                }, i * 150);
            });
        }
    });
}
</script>

</body>

</html>