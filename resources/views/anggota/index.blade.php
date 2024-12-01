<x-app-layout>
    <div class="pagetitle">
        <h1>Anggota</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Anggota</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Anggota Himatif Tahun 2024</h5>

                        {{-- Tombol Tambah Anggota --}}
                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#anggotaModal">
                            <i class="bi bi-plus-circle"></i> Tambah Anggota
                        </button>

                        {{-- Notification Success --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center"
                                role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <div>{{ session('success') }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

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


                        {{-- Modal Tambah Anggota --}}
                        <div class="modal fade" id="anggotaModal" tabindex="-1" aria-labelledby="anggotaModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="anggotaModalLabel">Tambah Anggota</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Tambah Anggota -->
                                        <form action="{{ route('anggota.store') }}" method="POST" class="row g-3">
                                            @csrf
                                            <div class="col-12">
                                                <label for="name" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name') }}" required>
                                                @if ($errors->has('name'))
                                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-12">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ old('email') }}" required>
                                                @if ($errors->has('email'))
                                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-12">
                                                <label for="npm" class="form-label">NPM</label>
                                                <input type="text" class="form-control" id="npm" name="npm"
                                                    value="{{ old('npm') }}" required>
                                                @if ($errors->has('npm'))
                                                    <small class="text-danger">{{ $errors->first('npm') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-12">
                                                <label for="bidang" class="form-label">Bidang</label>
                                                <select class="form-control" id="bidang" name="bidang" required>
                                                    <option value="">Pilih Bidang</option>
                                                    <option value="Inti"
                                                        {{ old('bidang') == 'Inti' ? 'selected' : '' }}>Inti</option>
                                                    <option value="PSDM"
                                                        {{ old('bidang') == 'PSDM' ? 'selected' : '' }}>PSDM</option>
                                                    <option value="Kerohanian"
                                                        {{ old('bidang') == 'Kerohanian' ? 'selected' : '' }}>
                                                        Kerohanian</option>
                                                    <option value="Humas"
                                                        {{ old('bidang') == 'Humas' ? 'selected' : '' }}>Humas</option>
                                                    <option value="Kominfo"
                                                        {{ old('bidang') == 'Kominfo' ? 'selected' : '' }}>Kominfo
                                                    </option>
                                                    <option value="Danus"
                                                        {{ old('bidang') == 'Danus' ? 'selected' : '' }}>Danus</option>
                                                    <option value="Minbak"
                                                        {{ old('bidang') == 'Minbak' ? 'selected' : '' }}>Minbak
                                                    </option>
                                                </select>
                                                @if ($errors->has('bidang'))
                                                    <small class="text-danger">{{ $errors->first('bidang') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-12">
                                                <label for="no_hp" class="form-label">No Hp</label>
                                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                                    value="{{ old('no_hp') }}" required>
                                                @if ($errors->has('no_hp'))
                                                    <small class="text-danger">{{ $errors->first('no_hp') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password"
                                                    name="password" required>
                                                @if ($errors->has('password'))
                                                    <small
                                                        class="text-danger">{{ $errors->first('password') }}</small>
                                                @endif
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-info">Tambah</button>
                                                <button type="reset" class="btn btn-secondary">Batalkan</button>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NPM</th>
                                    <th>Bidang</th>
                                    <th>No Hp</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->npm }}</td>
                                        <td>{{ $user->bidang }}</td>
                                        <td>{{ $user->no_hp }}</td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <a href="#" class="btn btn-warning secondary me-2">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger secondary"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- animation (gaya saja hehe :))--}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('animate__fadeOutUp'); // Tambahkan animasi keluar
                    setTimeout(() => alert.remove(), 1000); // Hapus elemen setelah animasi
                }, 5000); // Waktu delay (5 detik)
            });
        });
    </script>
</x-app-layout>
