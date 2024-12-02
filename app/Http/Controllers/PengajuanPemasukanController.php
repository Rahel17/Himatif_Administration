<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanPemasukanController extends Controller
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

        // Ambil semua data pemasukan dari tabel Transaksi dengan status 'proses'
        $pengajuanPemasukan = Transaksi::whereIn('status', ['proses', 'tolak']) // Perlihatkan yang statusnya "proses" atau "ditolak"
        ->with('user')
        ->whereNotNull('pemasukan') // Hanya data pemasukan
        ->orderBy('tanggal', 'desc')
        ->get();
        // dd($pengajuanPemasukan);


        // Kirim data ke view
        return view('pemasukan.pengajuan', compact('pengajuanPemasukan', 'users'));
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
        return view('pemasukan.pengajuan', compact('users'));
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
            'pemasukan' => 'required|in:proposal,sisa_proker,inventaris,kas_anggota,lainnya',
            'uraian' => 'nullable|string',
            'bidang' => 'required|in:' . implode(',', $bidangList), // Validasi berdasarkan bidang yang ada
            'nominal' => 'required|numeric|min:0',
            'dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png,xlsx,xls,csv',
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
            'pemasukan' => $validated['pemasukan'],
            'uraian' => $validated['uraian'],
            'bidang' => $validated['bidang'],
            'nominal' => $validated['nominal'],
            'dokumen' => $dokumenPath,
            'status' => 'proses',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('pemasukan.pengajuan')->with('success', 'Pengajuan pemasukan berhasil diajukan!');
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
        return redirect()->route('pemasukan.pengajuan')->with('success', 'Status pengajuan berhasil diperbarui!');
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
