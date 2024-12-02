<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $currentYear = Carbon::now()->year;

        // Total pemasukan dalam 1 tahun
        $totalPemasukan = Transaksi::whereNotNull('pemasukan')
            ->whereYear('tanggal', $currentYear) // Filter tahun berjalan
            ->where('status', 'setuju')
            ->sum('nominal');

        // Total pengeluaran dalam 1 tahun
        $totalPengeluaran = Transaksi::whereNotNull('pengeluaran')
            ->whereYear('tanggal', $currentYear) // Filter tahun berjalan
            ->where('status', 'setuju')
            ->sum('nominal');

        // Total kas anggota dalam 1 tahun
        $totalKasAnggota = Transaksi::whereNotNull('bulan') // Kas anggota spesifik
            ->whereYear('tanggal', $currentYear) // Filter tahun berjalan
            ->where('status', 'setuju')
            ->sum('nominal');

        // dd($totalPemasukan, $totalPengeluaran, $totalKasAnggota);
        // Data bulanan untuk grafik
        $pemasukanBulanan = Transaksi::selectRaw("strftime('%m', tanggal) as month, SUM(nominal) as total")
            ->whereNotNull('pemasukan')
            ->whereYear('tanggal', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $pengeluaranBulanan = Transaksi::selectRaw("strftime('%m', tanggal) as month, SUM(nominal) as total")
            ->whereNotNull('pengeluaran')
            ->whereYear('tanggal', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $kasBulanan = Transaksi::selectRaw("strftime('%m', tanggal) as month, SUM(nominal) as total")
            ->where('pemasukan', 'kas_anggota')
            ->whereYear('tanggal', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // Kirim variabel ke view
        return view('dashboard', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'totalKasAnggota',
            'pemasukanBulanan',
            'pengeluaranBulanan',
            'kasBulanan'
        ));
    }
}
