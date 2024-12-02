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
                                <i class="bi bi-cart"></i>
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
                                        series: [
                                            {
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
                            </script>
                            
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

                        <script>
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
                                  data: [
                                    { value: pemasukan, name: 'Pemasukan' },
                                    { value: pengeluaran, name: 'Pengeluaran' },
                                    { value: kasAnggota, name: 'Kas Anggota' }
                                  ]
                                }]
                              });
                            });
                          </script>
                    </div>
                </div><!-- End Statistik Keuangan -->

            </div>
        </div>
        <!-- End Left side columns -->

    </section>

</x-app-layout>
