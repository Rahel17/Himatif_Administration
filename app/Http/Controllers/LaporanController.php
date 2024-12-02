<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LaporanController extends Controller
{
    public function laporanKeuangan()
    {
        $currentYear = Carbon::now()->year;

        // Total pemasukan
        $totalPemasukan = Transaksi::whereNotNull('pemasukan')
            ->where('status', 'setuju')
            ->whereYear('tanggal', $currentYear)
            ->sum('nominal');

        // Total pengeluaran
        $totalPengeluaran = Transaksi::whereNotNull('pengeluaran')
            ->where('status', 'setuju')
            ->whereYear('tanggal', $currentYear)
            ->sum('nominal');

        // Total kas anggota
        $totalKasAnggota = Transaksi::where('pemasukan', 'kas_anggota')
            ->where('status', 'setuju')
            ->whereYear('tanggal', $currentYear)
            ->sum('nominal');

        return view('laporan-keuangan', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'totalKasAnggota',
            'currentYear'
        ));
    }
}
