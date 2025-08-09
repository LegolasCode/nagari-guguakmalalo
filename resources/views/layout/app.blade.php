<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'Sistem Informasi Nagari Guguak Malalo')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo_nagari.png') }}">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @stack('styles')
    
</head>

<style>
    #sidebarToggleTop {
        margin-left: 100px; /* Margin default untuk tampilan responsif */
        transition: margin-left 0.3s ease; /* Transisi halus */
        position: relative;
        z-index: 1051;
    }
    body.sidebar-toggled #sidebarToggleTop {
        margin-left: 100px; /* Hapus margin ketika sidebar tertutup */
    }
    body:not(.sidebar-toggled) #sidebarToggleTop {
        margin-left: 0px; /* Kembali ke margin semula saat sidebar terbuka */
    }
    #content-wrapper {
        padding-top: 96px;
    }
    #accordionSidebar {
        z-index: 1050;
    }
    .navbar.fixed-top {
        z-index: 1030;
    }
    .collapse-inner {
        background-color: #003d4d; /* Contoh: Latar belakang putih */
        border-radius: 0.35rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
        padding: 0.25rem;
    }
    .collapse-inner .collapse-item {
        color: #ffffff !important; /* Warna teks yang lebih gelap agar terlihat di latar putih */
        padding: 0.5rem 1rem;
    }
    .collapse-inner .collapse-item:hover {
        background-color: #f8f9fa; /* Latar belakang abu-abu saat hover */
        color: #333333 !important;
    }

    .collapse-inner .collapse-item.active {
        background-color: #ffffff !important; /* Warna background putih */
        color: black !important; /* Warna teks hitam agar terlihat */
        font-weight: bold; /* Teks tebal */
    }


    /* Ini untuk menu utama di sidebar */
    .sidebar .nav-item .nav-link {
        color: rgba(255, 255, 255, 0.8) !important;
    }
    .sidebar .nav-item .nav-link.collapsed,
    .sidebar .nav-item .nav-link:hover {
        color: #ffffff !important;
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

<body id="page-top" class="sidebar-toggled">

    <div id="preloader">
        <div class="loader"></div>
    </div>

@stack('scripts')
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: '{{ session('success') }}',
        });
    </script>
    @endif

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layout.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layout.navbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')

                    <!-- Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('layout.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="/logout" method="POST">
                @csrf
                @method('POST')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin akan keluar dari aplikasi?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger">Logout</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <script>
    // Logika Preloader
    window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.classList.add('hidden');
        }
    });

        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggleTop');
            const body = document.querySelector('body'); // Ambil elemen body

            if (sidebarToggle && body) {
                sidebarToggle.addEventListener('click', function() {
                    // Toggle kelas 'sidebar-toggled' pada body saat tombol diklik
                    body.classList.toggle('sidebar-toggled');
                });
            }
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="{{ asset('template/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('template/js/demo/chart-pie-demo.js') }}"></script> -->

    
</body>

</html>