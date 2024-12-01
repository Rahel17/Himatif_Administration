<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class PersetujuanPemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data transaksi dengan status "proses"
        $pengajuanPemasukan = Transaksi::whereIn('status', ['proses', 'tolak']) // Perlihatkan yang statusnya "proses" atau "ditolak"
        ->whereNotNull('pemasukan') // Hanya data pemasukan
        ->orderBy('tanggal', 'desc')
        ->get();


        return view('pemasukan.persetujuan', compact('pengajuanPemasukan'));
    }


    public function setujui($id)
    {
        // Cari transaksi berdasarkan ID
        $pengajuan = Transaksi::findOrFail($id);

        // Update status menjadi "setuju"
        $pengajuan->status = 'setuju';
        $pengajuan->save();

        // Redirect ke halaman persetujuan pemasukan setelah disetujui
        return redirect()->route('pemasukan.persetujuan')
            ->with('success', 'Pengajuan pemasukan berhasil disetujui.');
    }

    public function tolak($id)
    {
        // Cari transaksi berdasarkan ID
        $pengajuan = Transaksi::findOrFail($id);

        // Update status menjadi "ditolak"
        $pengajuan->status = 'tolak'; // Perbarui status menjadi ditolak
        $pengajuan->save();

        // Redirect ke halaman persetujuan pemasukan setelah ditolak
        return redirect()->route('pemasukan.persetujuan')->with('error', 'Pengajuan pemasukan ditolak. Silakan hubungi admin.');
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

        return redirect()->route('pemasukan.persetujuan')
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
