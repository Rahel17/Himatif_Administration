<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BayarKasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PersetujuanKasController;
use App\Http\Controllers\PengajuanPemasukanController;
use App\Http\Controllers\PengajuanPengeluaranController;
use App\Http\Controllers\PersetujuanPemasukanController;
use App\Http\Controllers\PersetujuanPengeluaranController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('anggota.store');

Route::get('/CatatanPemasukan', [PemasukanController::class, 'index'])->name('pemasukan.catatan');
Route::put('/pemasukan/{id}', [PemasukanController::class, 'update'])->name('pemasukan.update');
Route::delete('/pemasukan/{id}', [PemasukanController::class, 'destroy'])->name('pemasukan.destroy');

Route::get('/PersetujuanPemasukan', [PersetujuanPemasukanController::class, 'index'])->name('pemasukan.persetujuan');
Route::put('/persetujuan-pemasukan/setujui/{id}', [PersetujuanPemasukanController::class, 'setujui'])->name('pemasukan.setujui');
Route::put('/persetujuan-pemasukan/tolak/{id}', [PersetujuanPemasukanController::class, 'tolak'])->name('pemasukan.tolak');
Route::get('/pemasukan/pengajuan', [PersetujuanPemasukanController::class, 'index'])->name('pemasukan.pengajuan');

Route::get('/PengajuanPemasukan', [PengajuanPemasukanController::class, 'index'])->name('pemasukan.pengajuan');
Route::post('/pemasukan/store', [PengajuanPemasukanController::class, 'store'])->name('pemasukan.store');
Route::put('/pemasukan/{id}/status', [PengajuanPemasukanController::class, 'updateStatus'])->name('pemasukan.updateStatus');


Route::get('/CatatanPengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.catatan');
Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroy'])->name('pengeluaran.destroy');

Route::get('/PersetujuanPengeluaran', [PersetujuanPengeluaranController::class, 'index'])->name('pengeluaran.persetujuan');
Route::put('/persetujuan-pengeluaran/setujui/{id}', [PersetujuanPengeluaranController::class, 'setujui'])->name('pengeluaran.setujui');
Route::put('/persetujuan-pengeluaran/tolak/{id}', [PersetujuanPengeluaranController::class, 'tolak'])->name('pengeluaran.tolak');
Route::get('/pengeluaran/pengajuan', [PersetujuanPengeluaranController::class, 'index'])->name('pengeluaran.pengajuan');

Route::get('/PengajuanPengeluaran', [PengajuanPengeluaranController::class, 'index'])->name('pengeluaran.pengajuan');
Route::post('/pengeluaran/store', [PengajuanPengeluaranController::class, 'store'])->name('pengeluaran.store');
Route::put('/pengeluaran/{id}/status', [PengajuanPengeluaranController::class, 'updateStatus'])->name('pengeluaran.updateStatus');


Route::get('/CatatanKas', [KasController::class, 'index'])->name('kas.catatan');
Route::delete('/kas/{id}', [KasController::class, 'destroy'])->name('kas.destroy');

Route::get('/PersetujuanKas', [PersetujuanKasController::class, 'index'])->name('kas.persetujuan');
Route::put('/kas/setujui/{id}', [PersetujuanKasController::class, 'setujui'])->name('kas.setujui');
Route::put('/kas/tolak/{id}', [PersetujuanKasController::class, 'tolak'])->name('kas.tolak');

Route::get('/BayarKas', [BayarKasController::class, 'index'])->name('kas.bayar');
Route::post('/BayarKas/store', [BayarKasController::class, 'store'])->name('kas.store');
Route::post('/kas/update-status/{id}', [BayarKasController::class, 'updateStatus'])->name('kas.updateStatus');



require __DIR__ . '/auth.php';
