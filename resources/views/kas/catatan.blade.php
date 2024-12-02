<x-app-layout>
    <div class="pagetitle">
        <h1>Catatan Kas Anggota</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Kas Anggota</li>
                <li class="breadcrumb-item active">Catatan Kas</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Catatan Kas Anggota Himatif</h5>
                        <p class="card-text">Kas anggota Himatif selama satu tahun kepengurusan. Akan
                            dipertanggungjawabkan pada Musyawarah Besar.</p>

                        <!-- Table with stripped rows -->
                        <div style="overflow-x: auto;">
                            <table class="table datatable table-bordered align-middle text-sm">
                                <thead>
                                    <tr>
                                        <th>Waktu Bayar</th>
                                        <th>Nama</th>
                                        <th>NPM</th>
                                        <th>Bidang</th>
                                        <th>Bulan</th>
                                        <th>Bukti</th>
                                        <th>Keterangan</th>
                                        @if (auth()->user()->role === 'admin')
                                            <th>Aksi</th>
                                        @endif
                                        @if (auth()->user()->role === 'anggota')
                                            <th>Status</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kas as $item)
                                        <tr>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->user->name ?? 'Tidak Diketahui' }}</td>
                                            <td>{{ $item->user->npm ?? 'NPM Tidak Diketahui' }}</td>
                                            <td>{{ $item->user->bidang ?? 'Bidang Tidak Diketahui' }}</td>
                                            <td>{{ ucfirst($item->bulan) }}</td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                @if ($item->bukti)
                                                    <a href="{{ asset('storage/' . $item->bukti) }}" class="btn btn-primary btn-sm me-2" target="_blank">
                                                        <i class="bi bi-cloud-arrow-down"></i> Bukti
                                                    </a>
                                                @else
                                                    <span class="text-muted">Tidak ada bukti</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->bulan <= 'Oktober' && $item->status === 'setuju' ? 'Lunas' : 'Lunas' }}</td>

                                            @if (auth()->user()->role === 'admin')
                                                <td class="d-flex justify-content-center align-items-center">
                                                    <!-- Edit Button -->
                                                    {{-- <a href="{{ route('kas.edit', $item->id) }}" class="btn btn-warning btn-sm me-2">
                                                        <i class="bi bi-pencil-fill"></i> Edit
                                                    </a> --}}
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('kas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash-fill"></i> Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif

                                            @if (auth()->user()->role === 'anggota')
                                                <td class="d-flex justify-content-center align-items-center">
                                                    @if ($item->status === 'setuju')
                                                        <button type="button" class="btn btn-success btn-sm disabled">
                                                            <i class="bi bi-check2-circle"></i> Disetujui
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-warning btn-sm disabled">
                                                            <i class="bi bi-clock"></i> Menunggu
                                                        </button>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
