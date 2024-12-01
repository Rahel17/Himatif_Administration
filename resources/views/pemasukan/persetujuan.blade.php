<x-app-layout>
    <!-- Page Title -->
    <div class="pagetitle">
        <h1>Pemasukan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                <li class="breadcrumb-item">Pemasukan</li>
                <li class="breadcrumb-item active">Persetujuan Pemasukan</li>
            </ol>
        </nav>
    </div>

    @if(auth()->user()->role === 'bendum')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @endif

    <!-- Section -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <!-- Card Title -->
                        <h5 class="card-title">Persetujuan Pemasukan</h5>
                        <p class="card-text">Pemasukan yang diajukan oleh bendahara umum harus disetujui oleh kepala
                            bagian administrasi dan keuangan.</p>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Uraian</th>
                                        <th>Bidang</th>
                                        <th>Nominal</th>
                                        <th>Dokumen</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pengajuanPemasukan as $pengajuan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pengajuan->tanggal)->format('d M Y') }}</td>
                                            <td>{{ ucwords($pengajuan->pemasukan) }}</td>
                                            <td>{{ $pengajuan->uraian ?? '-' }}</td>
                                            <td>{{ ucwords($pengajuan->bidang ?? '-') }}</td>
                                            <td>Rp{{ number_format($pengajuan->nominal, 0, ',', '.') }}</td>
                                            <td>
                                                @if ($pengajuan->dokumen)
                                                    <a href="{{ asset('storage/' . $pengajuan->dokumen) }}"
                                                        class="btn btn-primary btn-sm" target="_blank">
                                                        <i class="bi bi-file-earmark-pdf"></i> Dokumen
                                                    </a>
                                                @else
                                                    <span class="text-muted">Tidak ada</span>
                                                @endif
                                            </td>
                                            <td>{{ $pengajuan->user->name ?? 'Tidak Diketahui' }}</td>
                                            <td>
                                                <!-- Cek status dan tampilkan aksi atau status -->
                                                @if ($pengajuan->status === 'proses')
                                                    <!-- Tampilkan tombol Setujui dan Tolak jika statusnya masih 'diajukan' -->
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle"
                                                            type="button" id="actionDropdown{{ $pengajuan->id }}"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            Pilih Aksi
                                                        </button>
                                                        <ul class="dropdown-menu"
                                                            aria-labelledby="actionDropdown{{ $pengajuan->id }}">
                                                            <!-- Setujui Form -->
                                                            <li>
                                                                <form
                                                                    action="{{ route('pemasukan.setujui', $pengajuan->id) }}"
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
                                                                <form
                                                                    action="{{ route('pemasukan.tolak', $pengajuan->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit"
                                                                        class="dropdown-item text-danger">
                                                                        <i class="bi bi-x-circle"></i> Ditolak
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @else
                                                    <!-- Tombol Berdasarkan Status -->
                                                    @if ($pengajuan->status === 'setuju')
                                                        <button type="submit" class="btn btn-success btn-sm disabled">
                                                            <i class="bi bi-check2-circle"></i> Disetujui
                                                        </button>
                                                    @else
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
                                                Tidak ada pengajuan pemasukan yang perlu disetujui.
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
