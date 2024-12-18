<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Administrasi dan Keuangan HIMATIF</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/logo-himatif.png" rel="icon">
    {{-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

    {{-- Notifications --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo-himatif.png" alt="">
                <span class="d-none d-lg-block text-small">AdminKeu Himatif</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->


        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->


                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                    </a>
                    <!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            @if (auth()->user()->role === 'admin')
                                <h6>Kepala AdminKeu</h6>
                            @endif

                            @if (auth()->user()->role === 'bendum')
                                <h6>Bendahara Umum</h6>
                            @endif

                            @if (auth()->user()->role === 'anggota')
                                <h6>{{ Auth::user()->name }}</h6>
                            @endif
                            {{-- <span>Web Designer</span> --}}
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        {{-- <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li> --}}

                        {{-- <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li> --}}
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" href="dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Beranda</span>
                </a>
            </li><!-- End Dashboard Nav -->
            @if (auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('anggota.index') }}">
                        <i class="bi bi-person"></i>
                        <span>Anggota</span>
                    </a>
                </li>
            @endif <!-- End Profile Page Nav -->

            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'bendum')
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-journal-text"></i><span>Pemasukan</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('pemasukan.catatan') }}">
                                <i class="bi bi-circle"></i><span>Catatan Pemasukan</span>
                            </a>
                        </li>
                        {{-- admin --}}
                        @if (auth()->user()->role === 'admin')
                            <li>
                                <a href="{{ route('pemasukan.persetujuan') }}">
                                    <i class="bi bi-circle"></i><span>Butuh Persetujuan</span>
                                </a>
                            </li>
                        @endif
                        {{-- bendum --}}
                        @if (auth()->user()->role === 'bendum')
                            <li>
                                <a href="{{ route('pemasukan.pengajuan') }}">
                                    <i class="bi bi-circle"></i><span>Pengajuan Pemasukan</span>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li><!-- End Components Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-journal-text"></i><span>Pengeluaran</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('pengeluaran.catatan') }}">
                                <i class="bi bi-circle"></i><span>Catatan Pengeluaran</span>
                            </a>
                        </li>
                        {{-- admin --}}
                        @if (auth()->user()->role === 'admin')
                            <li>
                                <a href="{{ route('pengeluaran.persetujuan') }}">
                                    <i class="bi bi-circle"></i><span>Butuh Persetujuan</span>
                                </a>
                            </li>
                        @endif
                        {{-- bendum --}}
                        @if (auth()->user()->role === 'bendum')
                            <li>
                                <a href="{{ route('pengeluaran.pengajuan') }}">
                                    <i class="bi bi-circle"></i><span>Pengajuan Pengeluaran</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Kas Anggota</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('kas.catatan') }}">
                            <i class="bi bi-circle"></i><span>Catatan Kas</span>
                        </a>
                    </li>
                    {{-- admin --}}
                    @if (auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('kas.persetujuan') }}">
                                <i class="bi bi-circle"></i><span>Butuh Persetujuan</span>
                            </a>
                        </li>
                    @endif
                    {{-- anggota --}}
                    @if (auth()->user()->role === 'anggota')
                        <li>
                            <a href="{{ route('kas.bayar') }}">
                                <i class="bi bi-circle"></i><span>Bayar Kas</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li><!-- End Tables Nav -->

            {{-- @if (auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('laporan-keuangan') }}">
                        <i class="bi bi-journal-bookmark"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            @endif --}}


        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        {{ $slot }}
    </main>

    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Himatif Unversitas Bengkulu</span></strong>. All Rights Reserved
        </div>
        <div class="credits">

            Designed by <a href="https://www.instagram.com/ranahelida_/">Kepala Administrasi dan Keuangan Himatif</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>


</body>

</html>
