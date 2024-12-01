<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PengajuanPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data user dengan role 'anggota' dan bidang tertentu
        $users = User::where('role', 'anggota')
            ->whereIn('bidang', ['Inti', 'PSDM', 'Kerohanian', 'Humas', 'Kominfo', 'Danus', 'Minbak'])
            ->get();

        // Ambil semua data pengeluaran dari tabel Transaksi dengan status 'proses'
        $pengajuanPengeluaran = Transaksi::whereIn('status', ['proses', 'tolak']) // Perlihatkan yang statusnya "proses" atau "ditolak"
        ->with('user')
        ->whereNotNull('pengeluaran') // Hanya data pengeluaran
        ->orderBy('tanggal', 'desc')
        ->get();
        // dd($pengajuanpengeluaran);


        // Kirim data ke view
        return view('pengeluaran.pengajuan', compact('pengajuanPengeluaran', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data user dengan role 'anggota' dan bidang tertentu
        $users = User::where('role', 'anggota')
            ->whereIn('bidang', ['Inti', 'PSDM', 'Kerohanian', 'Humas', 'Kominfo', 'Danus', 'Minbak'])
            ->get();

        // Kirim data ke view
        return view('pengeluaran.pengajuan', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil daftar bidang untuk validasi
        $bidangList = ['Inti', 'PSDM', 'Kerohanian', 'Humas', 'Kominfo', 'Danus', 'Minbak'];

        // Validasi input
        $validated = $request->validate([
            'penanggungjawab' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'pengeluaran' => 'required|in:proker,inventaris,lainnya',
            'uraian' => 'nullable|string',
            'bidang' => 'required|in:' . implode(',', $bidangList), // Validasi berdasarkan bidang yang ada
            'nominal' => 'required|numeric|min:0',
            'dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Upload dokumen jika ada
        $dokumenPath = null;
        if ($request->hasFile('dokumen')) {
            $dokumenPath = $request->file('dokumen')->store('dokumen', 'public');
        }

        // Simpan data transaksi
        Transaksi::create([
            'user_id' => $validated['penanggungjawab'], // Menyimpan user_id sebagai penanggungjawab
            'tanggal' => $validated['tanggal'],
            'pengeluaran' => $validated['pengeluaran'],
            'uraian' => $validated['uraian'],
            'bidang' => $validated['bidang'],
            'nominal' => $validated['nominal'],
            'dokumen' => $dokumenPath,
            'status' => 'proses',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('pengeluaran.pengajuan')->with('success', 'Pengajuan pengeluaran berhasil diajukan!');
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'status' => 'required|in:setuju,tolak',
        ]);

        // Temukan data berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // Perbarui status
        $transaksi->update([
            'status' => $validated['status'],
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('pengeluaran.pengajuan')->with('success', 'Status pengajuan berhasil diperbarui!');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
