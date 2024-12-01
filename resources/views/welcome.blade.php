<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Home</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('asset_dash/img/logo-himatif.png') }}" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('asset_dash/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('asset_dash/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('asset_dash/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('asset_dash/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('asset_dash/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('asset_dash/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">

  <!-- Header Section -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('asset_dash/img/logo-himatif.png') }}" alt="">
        <h1 class="sitename">Adminkeu HIMATIF</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ url('/') }}" class="active">Home</a></li>
          <li><a href="{{ url('login') }}" >Login</a></li>
          <li><a href="{{ url('register') }}" >Register</a></li>
          {{-- <li><a href="{{ url('dashboardUser') }}" >Dashboard</a></li> --}}
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>
  <!-- End Header -->

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div class="container">
        <div class="row gy-4 justify-content-between">
          <div class="col-lg-4 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
            <img src="{{ asset('asset_dash/img/dashboard-image.png') }}" class="img-fluid animated" alt="">
          </div>

          <div class="col-lg-6  d-flex flex-column justify-content-center" data-aos="fade-in">
            <h1>Selamat Datang di Website <span>Administrasi dan Keuangan HIMATIF</span></h1>
            <p>Mau ngapain hari ini?</p>
          </div>

        </div>
      </div>

      <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
          <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
        </defs>
        <g class="wave1">
          <use xlink:href="#wave-path" x="50" y="3"></use>
        </g>
        <g class="wave2">
          <use xlink:href="#wave-path" x="50" y="0"></use>
        </g>
        <g class="wave3">
          <use xlink:href="#wave-path" x="50" y="9"></use>
        </g>
      </svg>

    </section><!-- End Hero Section -->

  </main><!-- End Main -->

  <!-- Footer Section -->
  <footer id="footer" class="footer dark-background">
    <div class="container footer-top">
      <!-- Add any footer content here if necessary -->
    </div>

    <div class="container copyright text-center mt-4">
      <p><span>Administrasi dan Keuangan HIMATIF 2024</span></p>
    </div>
  </footer><!-- End Footer -->

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('asset_dash/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('asset_dash/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('asset_dash/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('asset_dash/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('asset_dash/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('asset_dash/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('asset_dash/js/main.js') }}"></script>

</body>

</html>
