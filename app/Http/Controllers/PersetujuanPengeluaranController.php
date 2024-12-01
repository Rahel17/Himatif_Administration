<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class PersetujuanPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data transaksi dengan status "proses"
        $pengajuanPengeluaran = Transaksi::whereIn('status', ['proses', 'tolak']) // Perlihatkan yang statusnya "proses" atau "ditolak"
        ->whereNotNull('pengeluaran') // Hanya data pengeluaran
        ->orderBy('tanggal', 'desc')
        ->get();


        return view('pengeluaran.persetujuan', compact('pengajuanPengeluaran'));
    }

    public function setujui($id)
    {
        // Cari transaksi berdasarkan ID
        $pengajuan = Transaksi::findOrFail($id);

        // Update status menjadi "setuju"
        $pengajuan->status = 'setuju';
        $pengajuan->save();

        // Redirect ke halaman persetujuan pengeluaran setelah disetujui
        return redirect()->route('pengeluaran.persetujuan')
            ->with('success', 'Pengajuan pengeluaran berhasil disetujui.');
    }

    public function tolak($id)
    {
        // Cari transaksi berdasarkan ID
        $pengajuan = Transaksi::findOrFail($id);

        // Update status menjadi "ditolak"
        $pengajuan->status = 'tolak'; // Perbarui status menjadi ditolak
        $pengajuan->save();

        // Redirect ke halaman persetujuan pengeluaran setelah ditolak
        return redirect()->route('pengeluaran.persetujuan')->with('error', 'Pengajuan pengeluaran ditolak. Silakan hubungi admin.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:setuju,tolak',
        ]);

        // Cari transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = $request->status;
        $transaksi->save();

        return redirect()->route('pengeluaran.persetujuan')
            ->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
