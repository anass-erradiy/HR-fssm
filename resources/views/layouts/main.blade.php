<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>FSSM </title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free HTML Templates" name="keywords">
        <meta content="Free HTML Templates" name="description">

		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">

		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">

		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="assets/css/line-awesome.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="images/logo/logo.png">

		<!-- Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">

        <title>@yield('title')</title>

        {{-- ------------------------------------ --}}
            <!-- Favicon -->
    <link href="assets1/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets1/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets1/css/style.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
    </head>
    <body>
        <div>
            <!-- Topbar Start -->
            {{-- <div class="container-fluid bg-secondary ps-5 pe-0 d-none d-lg-block">
                <div class="row gx-0">
                    <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                        <div class="d-inline-flex align-items-center">

                        </div>
                    </div>
                    <div class="col-md-6 text-center text-lg-end">
                            <div class="position-relative d-inline-flex align-items-center bg-primary text-white top-shape px-5">
                            <div class="me-3 pe-3 border-end py-2">
                                <p class="m-0"><i class="fa fa-envelope-open me-2"></i>uca-exemple@uca.com</p>
                            </div>
                            <div class="py-2">
                                <p class="m-0"><i class="fa fa-phone-alt me-2"></i>+012 345 6789</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- Topbar End -->
            <style>
                #navbar-welcome{
                    background-color: rgba(255, 255, 255, 0.9) ;
                }
            </style>

            <!-- Navbar Start -->
            <nav class="navbar navbar-expand-lg navbar-light shadow-sm px-5 py-1 py-lg-0" id="navbar-welcome">
                <a href="/" class="navbar-brand p-0">
                    <h3 class="m-0 text-uppercase text-primary"><img src="assets/img/U-C-A-logo.png" height="70px"></i>Faculté des science semlalia marrakech</h3>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 me-n3">
                        <a href="/" class="nav-item nav-link">Home</a>
                        <a href="#" class="nav-item nav-link">About</a>
                        <a href="#" class="nav-item nav-link">Service</a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/home') }}" class="nav-item nav-link"> <strong>Home</strong></a>
                            @else
                                <a href="{{ route('login') }}"class="nav-item nav-link"><strong>Login</strong></a>
                            @endauth
                    @endif
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            @yield('content')

            <!-- Carousel Start -->
            <div class="container-fluid bg-dark text-secondary p-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Localisation</h3>
                        <div class="d-flex flex-column justify-content-start">
                            <p class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i>Bd. Prince My Abdellah, B.P. 2390, 40000 Marrakech</p>
                            </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Email</h3>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="mb-2" href="mailto:fssm@uca.ma"><i class="bi bi-envelope-open text-primary me-2"></i> fssm@uca.ma</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Contact</h3>


                        <p class="mb-0"><i class="bi bi-telephone text-primary me-2"></i>(+212) 5 24 43 46 49</p>
                        <p class="mb-0"><i class="bi bi-telephone text-primary me-2"></i>(+212) 5 24 43 67 69</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Suivez-nous</h3>
                        <div class="d-flex">
                            <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="https://www.facebook.com/profile.php?id=100045233509511"><i class="fab fa-facebook-f fw-normal"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid bg-dark text-secondary text-center border-top py-4 px-5" style="border-color: rgba(256, 256, 256, .1) !important;">
                <p class="m-0">&copy; <a class="text-secondary border-bottom" href="#">FSSM</a>. All Rights Reserved.</p>
            </div>

        </body>
    <script src="assets1/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets1/lib/easing/easing.min.js"></script>
    <script src="assets1/lib/waypoints/waypoints.min.js"></script>
    <script src="assets1/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="assets1/js/main.js"></script>
    </html>

