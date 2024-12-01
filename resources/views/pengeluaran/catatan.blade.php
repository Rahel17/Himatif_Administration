<x-app-layout>
    <div class="pagetitle mb-4">
        <h1>Pengeluaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Pengeluaran</li>
                <li class="breadcrumb-item active">Catatan Pengeluaran</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Catatan Pengeluaran Himatif</h5>
                        <p class="card-text text-muted">
                            Pengeluaran selama satu tahun kepengurusan. Akan dipertanggungjawabkan pada Musyawarah Besar.
                        </p>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle datatable">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Uraian</th>
                                        <th>Bidang</th>
                                        <th>Nominal</th>
                                        <th>Dokumen</th>
                                        <th>Penanggungjawab</th>
                                        @if (Auth::user()->role == 'admin')
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transaksis as $index => $transaksi)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d/m/Y') }}</td>
                                            <td>{{ $transaksi->pengeluaran }}</td>
                                            <td>{{ $transaksi->uraian }}</td>
                                            <td>{{ $transaksi->bidang ?? 'N/A' }}</td>
                                            <td>Rp{{ number_format($transaksi->nominal, 2, ',', '.') }}</td>
                                            <td>
                                                @if ($transaksi->dokumen)
                                                    <a href="{{ asset('storage/' . $transaksi->dokumen) }}"
                                                        class="btn btn-info btn-sm" target="_blank">
                                                        <i class="bi bi-file-earmark-pdf"></i> Dokumen
                                                    </a>
                                                @else
                                                    <span class="text-muted">Tidak ada</span>
                                                @endif
                                            </td>
                                            <td>{{ $transaksi->user->name ?? 'Tidak Diketahui' }}</td>
                                            @if (Auth::user()->role == 'admin')
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <!-- Tombol Edit -->
                                                        <a href="#" class="btn btn-warning btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $transaksi->id }}">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </a>
                                                        <!-- Tombol Hapus -->
                                                        <form action="{{ route('pengeluaran.destroy', $transaksi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Tidak ada data pengeluaran</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                @foreach ($transaksis as $transaksi)
                    <div class="modal fade" id="editModal{{ $transaksi->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $transaksi->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $transaksi->id }}">Edit Pengeluaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Edit Pengeluaran -->
                                    <form action="{{ route('pengeluaran.update', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row g-3">
                                            <!-- Tanggal -->
                                            <div class="col-md-6">
                                                <label for="inputTanggal{{ $transaksi->id }}" class="form-label">Tanggal</label>
                                                <input type="date" class="form-control" id="inputTanggal{{ $transaksi->id }}" name="tanggal" value="{{ $transaksi->tanggal }}" required>
                                            </div>

                                            <!-- Kategori -->
                                            <div class="col-md-6">
                                                <label for="inputKategori{{ $transaksi->id }}" class="form-label">Kategori</label>
                                                <select class="form-select" id="inputKategori{{ $transaksi->id }}" name="pengeluaran" required>
                                                    <option value="" disabled>Pilih Kategori</option>
                                                    <option value="proker" {{ $transaksi->pengeluaran == 'proker' ? 'selected' : '' }}>Proker</option>
                                                    <option value="inventaris" {{ $transaksi->pengeluaran == 'inventaris' ? 'selected' : '' }}>Inventaris</option>
                                                    <option value="lainnya" {{ $transaksi->pengeluaran == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                                </select>
                                            </div>

                                            <!-- Uraian -->
                                            <div class="col-12">
                                                <label for="inputUraian{{ $transaksi->id }}" class="form-label">Uraian</label>
                                                <textarea class="form-control" id="inputUraian{{ $transaksi->id }}" name="uraian" rows="3">{{ $transaksi->uraian }}</textarea>
                                            </div>
                                            
                                            {{-- Bidang --}}
                                            <div class="col-md-6">
                                                <label for="inputBidang{{ $transaksi->id }}" class="form-label">Bidang</label>
                                                <select type="text" class="form-control" id="inputBidang{{ $transaksi->id }}" name="bidang" value="{{ $transaksi->bidang }}" required>
                                                    <option value="" disabled>Pilih Bidang</option>
                                                    <option value="Inti" {{ $transaksi->bidang == 'Inti' ? 'selected' : '' }}>Inti</option>
                                                    <option value="PSDM" {{ $transaksi->bidang == 'PSDM' ? 'selected' : '' }}>PSDM</option>
                                                    <option value="Kerohanian" {{ $transaksi->bidang == 'Kerohanian' ? 'selected' : '' }}>Kerohanian</option>
                                                    <option value="Humas" {{ $transaksi->bidang == 'Humas' ? 'selected' : '' }}>Humas</option>
                                                    <option value="Kominfo" {{ $transaksi->bidang == 'Kominfo' ? 'selected' : '' }}>Kominfo</option>
                                                    <option value="Danus" {{ $transaksi->bidang == 'Danus' ? 'selected' : '' }}>Danus</option>
                                                    <option value="Minbak" {{ $transaksi->bidang == 'Minbak' ? 'selected' : '' }}>Minbak</option>
                                                </select>
                                            </div>

                                            {{-- Nominal --}}
                                            <div class="col-md-6">
                                                <label for="inputNominal{{ $transaksi->id }}" class="form-label">Nominal</label>
                                                <input type="number" class="form-control" id="inputNominal{{ $transaksi->id }}" name="nominal" value="{{ $transaksi->nominal }}" required>
                                            </div>

                                            <!-- Bukti -->
                                            <div class="col-12">
                                                <label for="inputBukti{{ $transaksi->id }}" class="form-label">Bukti</label>
                                                <input type="file" class="form-control" id="inputBukti{{ $transaksi->id }}" name="bukti">
                                            </div>

                                            {{-- Penananggung jawab --}}
                                            <div class="col-md-6">
                                                <label for="inputPenanggungJawab{{ $transaksi->id }}" class="form-label">Penanggung Jawab</label>
                                                <select class="form-select" id="inputPenanggungJawab{{ $transaksi->id }}" name="penanggungjawab" required>
                                                    <option value="" disabled>Pilih Penanggung Jawab</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}" {{ $transaksi->penanggung_jawab == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Tombol Aksi -->
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
</x-app-layout>