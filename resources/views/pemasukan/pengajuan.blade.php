<x-app-layout>
    <div class="pagetitle">
        <h1>Pemasukan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Pemasukan</li>
                <li class="breadcrumb-item active">Pengajuan Pemasukan</li>
            </ol>
        </nav>
    </div>

    {{-- Notification Success --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ajuan Pemasukan</h5>
                        <p class="card-text">Pemasukan yang diajukan bendahara umum harus disetujui oleh kepala bagian
                            administrasi dan keuangan. Input dengan teliti agar tidak merugi</p>

                        <!-- Button untuk membuka modal -->
                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#pemasukanModal">
                            <i class="bi bi-file-diff"></i> Ajukan Pemasukan
                        </button>

                        {{-- Notification Error --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center"
                                role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <div>
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Modal -->
                        <div class="modal fade" id="pemasukanModal" tabindex="-1" aria-labelledby="pemasukanModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <!-- Tambahkan modal-lg untuk ukuran modal lebih besar -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="pemasukanModalLabel">Ajukan Pemasukan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Pengajuan Pemasukan -->
                                        <form action="{{ route('pemasukan.store') }}" method="POST"
                                            enctype="multipart/form-data" class="row g-3">
                                            @csrf

                                            <!-- Tanggal -->
                                            <div class="col-md-6">
                                                <label for="inputTanggal" class="form-label">Tanggal</label>
                                                <input type="date" class="form-control" id="inputTanggal"
                                                    name="tanggal" value="{{ old('tanggal') }}" required>
                                                @error('tanggal')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Kategori -->
                                            <div class="col-md-6">
                                                <label for="inputKategori" class="form-label">Kategori</label>
                                                <select class="form-select" id="inputKategori" name="pemasukan"
                                                    required>
                                                    <option value="" selected disabled>Pilih Kategori</option>
                                                    <option value="proposal"
                                                        {{ old('pemasukan') == 'proposal' ? 'selected' : '' }}>Proposal
                                                    </option>
                                                    <option value="sisa_proker"
                                                        {{ old('pemasukan') == 'sisa_proker' ? 'selected' : '' }}>Sisa
                                                        Proker</option>
                                                    <option value="inventaris"
                                                        {{ old('pemasukan') == 'inventaris' ? 'selected' : '' }}>
                                                        Inventaris</option>
                                                    <option value="lainnya"
                                                        {{ old('pemasukan') == 'lainnya' ? 'selected' : '' }}>Lainnya
                                                    </option>
                                                </select>
                                                @error('pemasukan')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Uraian -->
                                            <div class="col-12">
                                                <label for="inputUraian" class="form-label">Uraian</label>
                                                <textarea class="form-control" id="inputUraian" name="uraian" rows="3">{{ old('uraian') }}</textarea>
                                                @error('uraian')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Bidang -->
                                            <div class="col-md-6">
                                                <label for="inputBidang" class="form-label">Bidang</label>
                                                <select class="form-select" id="inputBidang" name="bidang" required>
                                                    <option value="" selected disabled>Pilih Bidang</option>
                                                    @foreach ($users->unique('bidang') as $user)
                                                        <!-- Ambil bidang unik -->
                                                        <option value="{{ $user->bidang }}"
                                                            {{ old('bidang') == $user->bidang ? 'selected' : '' }}>
                                                            {{ $user->bidang }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('bidang')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Nominal -->
                                            <div class="col-md-6">
                                                <label for="inputNominal" class="form-label">Nominal</label>
                                                <input type="number" class="form-control" id="inputNominal"
                                                    name="nominal" value="{{ old('nominal') }}"
                                                    placeholder="Masukkan nominal" required>
                                                @error('nominal')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Dokumen -->
                                            <div class="col-md-6">
                                                <label for="inputDokumen" class="form-label">Dokumen</label>
                                                <input type="file" class="form-control" id="inputDokumen"
                                                    name="dokumen" accept="application/pdf,image/*">
                                                @error('dokumen')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Penanggungjawab -->
                                            <div class="col-md-6">
                                                <label for="inputPenanggungjawab"
                                                    class="form-label">Penanggungjawab</label>
                                                <select class="form-select" id="inputPenanggungjawab"
                                                    name="penanggungjawab" required>
                                                    <option value="" selected disabled>Pilih Penanggungjawab
                                                    </option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}"
                                                            {{ old('penanggungjawab') == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }} ({{ $user->bidang }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('penanggungjawab')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Tombol Aksi -->
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary">Kirim</button>
                                                <button type="reset" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batalkan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table with stripped rows -->
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
                                        <th>Penanggungjawab</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengajuanPemasukan as $pengajuan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pengajuan->tanggal }}</td>
                                            <td>{{ ucfirst($pengajuan->pemasukan) }}</td>
                                            <td>{{ $pengajuan->uraian ?? '-' }}</td>
                                            <td>{{ $pengajuan->user->bidang ?? '-' }}</td>
                                            <td>Rp{{ number_format($pengajuan->nominal, 2, ',', '.') }}</td>
                                            <td>
                                                @if ($pengajuan->dokumen)
                                                    <a href="{{ asset('storage/' . $pengajuan->dokumen) }}"
                                                        class="btn btn-info btn-sm" target="_blank">
                                                        <i class="bi bi-file-earmark-pdf"></i> Dokumen
                                                    </a>
                                                @else
                                                    <span class="text-muted">Tidak ada</span>
                                                @endif
                                            </td>
                                            <td>{{ $pengajuan->user->name }}</td>
                                            <td>
                                                @if (auth()->user()->role === 'bendum')
                                                    <!-- Tampilan untuk Bendahara -->
                                                    @if ($pengajuan->status === 'setuju' || $pengajuan->status === 'tolak')
                                                        <!-- Status Final -->
                                                        <button type="button"
                                                            class="btn btn-{{ $pengajuan->status === 'setuju' ? 'success' : 'danger' }} btn-sm"
                                                            disabled>
                                                            <i
                                                                class="bi {{ $pengajuan->status === 'setuju' ? 'bi-check2-circle' : 'bi-x-circle' }}"></i>
                                                            {{ ucfirst($pengajuan->status) }}
                                                        </button>
                                                    @else
                                                        <!-- Status Diproses -->
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            disabled>
                                                            <i class="bi bi-hourglass-split"></i> Diproses
                                                        </button>
                                                    @endif
                                                @elseif (auth()->user()->role === 'admin')
                                                    <!-- Tampilan untuk Admin -->
                                                    @can('update', $pengajuan)
                                                        <div class="d-flex align-items-center">
                                                            <form
                                                                action="{{ route('pemasukan.updateStatus', $pengajuan->id) }}"
                                                                method="POST" class="me-2">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="setuju">
                                                                <button type="submit" class="btn btn-success btn-sm">
                                                                    <i class="bi bi-check2-circle"></i> Disetujui
                                                                </button>
                                                            </form>
                                                            <form
                                                                action="{{ route('pemasukan.updateStatus', $pengajuan->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="tolak">
                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    <i class="bi bi-x-circle"></i> Ditolak
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endcan
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
</x-app-layout>
