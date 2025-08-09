<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Nagari Guguak Malalo - Login</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo_nagari.png') }}">
    
    <!-- Custom fonts for this template-->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<style>
    body {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        position: relative; /* Penting untuk pseudo-element overlay */
        overflow: hidden;
        display: flex; /* Memusatkan konten */
        align-items: center;
        justify-content: center;
    }

    /* Menambahkan overlay gelap sebagai pseudo-element */
    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7); /* Hitam dengan opacity 70% */
        z-index: 1;
    }

    .container { /* Sesuaikan selektor ini jika kontainer konten kamu punya kelas lain */
        position: relative;
        z-index: 2; /* Harus lebih tinggi dari z-index overlay */
    }

    .bg-login-image {
        background: url('{{ asset('images/hero_slide3.jpg') }}'); /* Ganti dengan path gambar kamu */
        background-position: center;
        background-size: cover;
    }
    
    .btn-custom-login{
        background-color: #003d4d !important;
        border-color: #003d4d !important;
        color: #ffffff !important;
    }

    /* Opsional: Efek hover untuk tombol */
    .btn-custom-login:hover{
        background-color: #002a36 !important;
        border-color: #8acfe0 !important;
    }
</style>

<body class="bg-cover d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('images/hero_slide1.jpg') }}');">

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->any())
        <script>
            Swal.fire({
            title: "Terjadi Kesalahan",
            text: "@foreach ($errors->all() as $error) {{ $error }}{{ $loop->last ? '.' : ',' }} @endforeach",
            icon: "error"
            });
        </script>
    @endif
    
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <a href="{{ route('index') }}" class="btn btn-light position-absolute top-0 end-0 m-3 rounded-circle" style="width: 40px; height: 40px; display: flex; justify-content: center; align-items: center; z-index: 10;">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="{{ asset('images/logo_nagari.png') }}" alt="Logo" width="36" height="36" class="me-2">
                                        <h4 class="text-gray-900 mb-4 mt-2">Sistem Informasi Nagari Guguak Malalo</h4>
                                    </div>
                                    <form class="user" action="/login" method="POST">
                                        @csrf
                                        @method('POST')
                                        
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="inputEmail" name="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="inputPassword" name="password" placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-custom-login btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" style="color: #003d4d;" href="/register">Buat Akun!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}{"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>



</body>

</html>