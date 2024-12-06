<x-app-layout>
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> --}}
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

        <!-- Left side columns -->

        <div class="row">

            <!-- Pemasukan Card -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Pemasukan <span>| Tahun {{ now()->year }}</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>Rp{{ number_format((float) ($totalPemasukan ?? 0), 0, ',', '.') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Pemasukan Card -->

            <!-- Pengeluaran Card -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Pengeluaran <span>| Tahun {{ now()->year }}</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>Rp{{ number_format((float) ($totalPengeluaran ?? 0), 0, ',', '.') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Pengeluaran Card -->

            <!-- Kas Card -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Pembayaran Kas Anggota <span>| Tahun {{ now()->year }}</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <h6>Rp{{ number_format((float) ($totalKasAnggota ?? 0), 0, ',', '.') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Kas Card -->

            <!-- Reports -->
            <div class="col-lg-8">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Grafik Keungan <span>| Tahun {{ now()->year }}</span></h5>

                            <!-- Line Chart -->
                            <div id="reportsChart"></div>

                            <!-- End Line Chart -->

                        </div>

                    </div>
                </div>
                <!-- End Reports -->
            </div>
            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Statistik Keuangan <span>| Tahun {{ now()->year }}</span></h5>

                        <div id="financialChart" style="min-height: 400px;" class="echart"></div>
                    </div>
                </div><!-- End Statistik Keuangan -->

            </div>

            @if (auth()->user()->role === 'admin')
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Laporan Keuangan Himatif</h5>
                            <p class="card-text text-muted">
                                Cetak laporan keuangan yang diterima
                            </p>

                            {{-- Tombol Cetak --}}
                            <button type="button" class="btn btn-info" onclick="showPrintArea()">
                                <a href="{{ route('laporan-keuangan') }}" class="btn btn-info" target="_blank">
                                    <i class="bi bi-printer"></i> Cetak
                                </a>
                            </button>

                            <!-- Div untuk tampilkan laporan setelah tombol cetak diklik -->
                            {{-- <div id="printableArea" style="display:none; margin-top: 20px;">
                                <title>Laporan Keuangan</title>
                                <style>
                                    body {
                                        font-family: Arial, sans-serif;
                                        line-height: 1.5;
                                        margin: 40px;
                                    }

                                    .header,
                                    .footer {
                                        text-align: center;
                                        margin-bottom: 20px;
                                    }

                                    .content {
                                        margin-top: 20px;
                                    }

                                    table {
                                        width: 100%;
                                        border-collapse: collapse;
                                        margin-top: 20px;
                                    }

                                    th,
                                    td {
                                        border: 1px solid black;
                                        padding: 10px;
                                        text-align: left;
                                    }

                                    th {
                                        background-color: #f4f4f4;
                                    }
                                </style>

                                <body>
                                    <div class="header">
                                        <h2>Laporan Keuangan Tahun 2024</h2>
                                        <p>Himpunan Mahasiswa Teknik Informatika</p>
                                    </div>

                                    <div class="content">
                                        <h3>Ringkasan Keuangan</h3>
                                        <table>
                                            <tr>
                                                <th>Keterangan</th>
                                                <th>Nominal (Rp)</th>
                                            </tr>
                                            <tr>
                                                <td>Total Pemasukan</td>
                                                <td>{{ number_format($totalPemasukan, 2, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Pengeluaran</td>
                                                <td>{{ number_format($totalPengeluaran, 2, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Kas Anggota</td>
                                                <td>{{ number_format($totalKasAnggota, 2, ',', '.') }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="footer">
                                        <p>Mengetahui</p>
                                        <p><strong>Kepala Bagian Administrasi dan Keuangan</strong></p>
                                        <br><br>
                                        <p>Rana Qonitah Helida</p>
                                    </div>
                                </body>
                            </div> --}}
                        </div>
                    </div>
                </div>
        </div>
        @endif

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                // Data dari controller
                const pemasukanData = @json(array_values($pemasukanBulanan->toArray()));
                const pengeluaranData = @json(array_values($pengeluaranBulanan->toArray()));
                const kasData = @json(array_values($kasBulanan->toArray()));

                // Labels (bulan dalam format singkat)
                const months = [
                    "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                ];

                new ApexCharts(document.querySelector("#reportsChart"), {
                    series: [{
                            name: 'Pemasukan',
                            data: pemasukanData
                        },
                        {
                            name: 'Pengeluaran',
                            data: pengeluaranData
                        },
                        {
                            name: 'Kas Anggota',
                            data: kasData
                        }
                    ],
                    chart: {
                        height: 350,
                        type: 'area',
                        toolbar: {
                            show: false
                        },
                    },
                    markers: {
                        size: 4
                    },
                    colors: ['#4154f1', '#ff3d71', '#2eca6a'],
                    fill: {
                        type: "gradient",
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    xaxis: {
                        categories: months,
                        title: {
                            text: "Bulan"
                        }
                    },
                    tooltip: {
                        x: {
                            format: 'MMMM'
                        },
                    }
                }).render();
            });

            document.addEventListener("DOMContentLoaded", () => {
                // Data dari server (Laravel Controller)
                const pemasukan = @json($totalPemasukan);
                const pengeluaran = @json($totalPengeluaran);
                const kasAnggota = @json($totalKasAnggota);

                // Inisialisasi ECharts
                echarts.init(document.querySelector("#financialChart")).setOption({
                    tooltip: {
                        trigger: 'item',
                        formatter: '{a} <br/>{b}: {c} ({d}%)' // Format tooltip
                    },
                    legend: {
                        top: '5%',
                        left: 'center'
                    },
                    series: [{
                        name: 'Keuangan',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '18',
                                fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        data: [{
                                value: pemasukan,
                                name: 'Pemasukan'
                            },
                            {
                                value: pengeluaran,
                                name: 'Pengeluaran'
                            },
                            {
                                value: kasAnggota,
                                name: 'Kas Anggota'
                            }
                        ]
                    }]
                });
            });

            // function showPrintArea() {
            //     // Menyembunyikan semua konten di luar area cetak
            //     var originalContent = document.body.innerHTML;
            //     var printContent = document.getElementById('printableArea').innerHTML;
            //     document.body.innerHTML = printContent;

            //     // Menampilkan area untuk dicetak
            //     window.print();

            //     // Setelah pencetakan selesai, mengembalikan konten asli halaman
            //     document.body.innerHTML = originalContent;
            // }
        </script>
    </section>

</x-app-layout>
