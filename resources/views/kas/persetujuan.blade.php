<x-app-layout>
    <div class="pagetitle">
        <h1>Persetujuan Pembayaran Kas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Persetujuan Kas</li>
            </ol>
        </nav>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <!-- Card Title -->
                        <h5 class="card-title">Persetujuan Pembayaran Kas</h5>
                        <p class="card-text">Pembayaran kas yang diajukan anggota harus disetujui oleh kepala
                            bagian administrasi dan keuangan.</p>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NPM</th>
                                        <th>Bidang</th>
                                        <th>Bulan</th>
                                        <th>Nominal</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Bukti</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kas as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->user->name ?? 'Tidak Diketahui' }}</td>
                                            <td>{{ $item->user->npm ?? 'NPM Tidak Diketahui' }}</td>
                                            <td>{{ $item->user->bidang ?? 'Bidang Tidak Diketahui' }}</td>
                                            <td>{{ ucfirst($item->bulan) }}</td>
                                            <td>Rp{{ number_format($item->nominal, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                            <td>
                                                @if ($item->bukti)
                                                    <a href="{{ asset('storage/' . $item->bukti) }}" class="btn btn-primary btn-sm" target="_blank">
                                                        <i class="bi bi-file-earmark-pdf"></i> Dokumen
                                                    </a>
                                                @else
                                                    <span class="text-muted">Tidak ada</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Cek status dan tampilkan aksi atau status -->
                                                @if ($item->status === 'proses')
                                                    <!-- Tampilkan tombol Setujui dan Tolak jika statusnya masih 'pending' -->
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle"
                                                            type="button" id="actionDropdown{{ $item->id }}"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            Pilih Aksi
                                                        </button>
                                                        <ul class="dropdown-menu"
                                                            aria-labelledby="actionDropdown{{ $item->id }}">
                                                            <!-- Setujui Form -->
                                                            <li>
                                                                <form action="{{ route('kas.setujui', $item->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit"
                                                                        class="dropdown-item text-success">
                                                                        <i class="bi bi-check2-circle"></i> Setujui
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            <!-- Tolak Form -->
                                                            <li>
                                                                <form action="{{ route('kas.tolak', $item->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit"
                                                                        class="dropdown-item text-danger">
                                                                        <i class="bi bi-x-circle"></i> Tolak
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @else
                                                    <!-- Tombol Berdasarkan Status -->
                                                    @if ($item->status === 'setuju')
                                                        <button type="submit" class="btn btn-success btn-sm disabled">
                                                            <i class="bi bi-check2-circle"></i> Disetujui
                                                        </button>
                                                    @elseif ($item->status === 'tolak')
                                                        <button type="submit" class="btn btn-danger btn-sm disabled">
                                                            <i class="bi bi-x-circle"></i> Ditolak
                                                        </button>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                Tidak ada kas yang perlu disetujui.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->

                    </div>
                </div>

            </div>
        </div>
    </section>
</x-app-layout>
