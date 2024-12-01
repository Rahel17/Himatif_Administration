<x-app-layout>
    <div class="pagetitle">
        <h1>Pembayaran Kas Anggota</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Kas Anggota</li>
                <li class="breadcrumb-item active">Bayar Kas</li>
            </ol>
        </nav>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle"></i> Ada kesalahan:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <section class="section">
        <!-- Grid untuk menampilkan card -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 justify-content">
            @php
                $months = [
                    'januari',
                    'februari',
                    'maret',
                    'april',
                    'mei',
                    'juni',
                    'juli',
                    'agustus',
                    'september',
                    'oktober',
                ];
                $kasAmount = 5000;
            @endphp

            @foreach ($months as $month)
                <div class="col">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4 d-flex align-items-center justify-content-center">
                                <img src="assets/img/kas-icon.png" class="img-fluid rounded-start" alt="Icon Kas"
                                    style="width: 130px; height: 130px; object-fit: cover;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <!-- Bulan -->
                                    <h5 class="card-title mb-1">{{ $month }}</h5>

                                    <!-- Informasi Kas -->
                                    <p class="card-text mb-1">
                                        <strong>Uang kas perbulan sebesar
                                            Rp{{ number_format($kasAmount, 0, ',', '.') }}</strong>
                                    </p>

                                    <!-- Informasi Pengguna -->
                                    <p class="mb-1">Nama: {{ Auth::user()->name }}</p>
                                    <p class="mb-1">NPM: {{ Auth::user()->npm }}</p>
                                    <p class="mb-1">Bidang: {{ Auth::user()->bidang }}</p>

                                    <!-- Tombol Bayar -->
                                    <button type="button" class="btn btn-info bayar-btn"
                                        data-nama="{{ Auth::user()->name }}" data-npm="{{ Auth::user()->npm }}"
                                        data-bidang="{{ Auth::user()->bidang }}" data-bulan="{{ $month }}"
                                        data-nominal="{{ $kasAmount }}" data-tanggal="{{ now()->format('Y-m-d') }}"
                                        data-bs-toggle="modal" data-bs-target="#bayarKasModal">
                                        <i class="bi bi-plus-square"></i> Bayar
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    {{-- Modal ajukan pembayaran kas --}}
    <!-- Modal -->
    <div class="modal fade" id="bayarKasModal" tabindex="-1" aria-labelledby="bayarKasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bayarKasModalLabel">Pengajuan Pembayaran Kas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Pengajuan Pembayaran -->
                    <form action="{{ route('kas.store') }}" method="POST" enctype="multipart/form-data"
                        class="row g-3">
                        @csrf
                        <!-- Nama -->
                        <div class="col-12">
                            <label for="inputNama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="inputNama" name="nama" readonly>
                        </div>

                        <!-- NPM -->
                        <div class="col-12">
                            <label for="inputNPM" class="form-label">NPM</label>
                            <input type="text" class="form-control" id="inputNPM" name="npm" readonly>
                        </div>

                        <!-- Bidang -->
                        <div class="col-12">
                            <label for="inputBidang" class="form-label">Bidang</label>
                            <input type="text" class="form-control" id="inputBidang" name="bidang" readonly>
                        </div>

                        <!-- Bulan -->
                        <div class="col-12">
                            <label for="inputBulan" class="form-label">Bulan</label>
                            <input type="text" class="form-control" id="inputBulan" name="bulan" readonly>
                        </div>

                        <!-- Nominal -->
                        <div class="col-12">
                            <label for="inputNominal" class="form-label">Nominal</label>
                            <input type="number" class="form-control" id="inputNominal" name="nominal" readonly>
                        </div>

                        <!-- Tanggal Bayar -->
                        <div class="col-12">
                            <label for="inputTanggal" class="form-label">Tanggal Bayar</label>
                            <input type="date" class="form-control" id="inputTanggal" name="tanggal" readonly>
                        </div>

                        <!-- Bukti Pembayaran -->
                        <div class="col-12">
                            <label for="inputBukti" class="form-label">Bukti Pembayaran</label>
                            <input type="file" class="form-control" id="inputBukti" name="bukti"
                                accept=".jpg,.jpeg,.png,.pdf" required>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <button type="reset" class="btn btn-secondary"
                                data-bs-dismiss="modal">Batalkan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Ambil semua tombol bayar yang ada
        const bayarBtns = document.querySelectorAll('.bayar-btn');

        // Loop untuk menambahkan event listener pada setiap tombol bayar
        bayarBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Ambil data dari tombol
                const nama = this.getAttribute('data-nama');
                const npm = this.getAttribute('data-npm');
                const bidang = this.getAttribute('data-bidang');
                const bulan = this.getAttribute('data-bulan');
                const nominal = this.getAttribute('data-nominal');
                const tanggal = this.getAttribute('data-tanggal');

                // Isi form modal dengan data yang diambil
                document.getElementById('inputNama').value = nama;
                document.getElementById('inputNPM').value = npm;
                document.getElementById('inputBidang').value = bidang;
                document.getElementById('inputBulan').value = bulan;
                document.getElementById('inputNominal').value = nominal;
                document.getElementById('inputTanggal').value = tanggal;
            });
        });

        // Tangkap form pembayaran
        const bayarForm = document.querySelector('form');

        bayarForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Cegah form untuk mengirimkan secara langsung

            // Kirim form dengan AJAX
            fetch('{{ route('kas.store') }}', {
                    method: 'POST',
                    body: new FormData(bayarForm),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                }).then(response => response.json())
                .then(data => {
                    if (data.status === 'setuju') {
                        const button = document.querySelector('.bayar-btn[data-bulan="' + data.bulan + '"]');
                        button.textContent = 'Sudah Dibayar';
                        button.disabled = true;
                        button.classList.remove('btn-info');
                        button.classList.add('btn-success');
                        button.closest('.card').style.opacity = 0.6; // Card disabled
                    } else if (data.status === 'tolak') {
                        const button = document.querySelector('.bayar-btn[data-bulan="' + data.bulan + '"]');
                        button.textContent = 'Ditolak';
                        button.disabled = true;
                        button.classList.remove('btn-info');
                        button.classList.add('btn-warning');
                    }
                }).catch(error => {
                    alert('Terjadi kesalahan, coba lagi!');
                });
        });
    </script>

</x-app-layout>
