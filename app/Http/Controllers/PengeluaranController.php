<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua transaksi pengeluaran yang sudah disetujui
        $transaksis = Transaksi::where('status', 'setuju')
            ->whereNotNull('pengeluaran') // Filter hanya data pengeluaran
            ->whereNull('pemasukan')     // Pastikan data pemasukan tidak ikut
            ->orderBy('tanggal', 'desc') // Urutkan berdasarkan tanggal
            ->get();

        // Ambil data user untuk dropdown atau kebutuhan lainnya
        $users = User::where('role', 'anggota')
            ->whereIn('bidang', ['Inti', 'PSDM', 'Kerohanian', 'Humas', 'Kominfo', 'Danus', 'Minbak'])
            ->get();

        return view('pengeluaran.catatan', compact('transaksis', 'users'));
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
    public function edit($id)
    {
        // Cari data pengeluaran berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);
        $users = User::all();

        return view('pengeluaran.edit', compact('transaksi', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'pengeluaran' => 'required|in:proker,inventaris,lainnya',
            'uraian' => 'nullable|string',
            'bidang' => 'required|in:Inti,PSDM,Kerohanian,Humas,Kominfo,Danus,Minbak',
            'nominal' => 'required|numeric|min:0',
            'dokumen' => 'nullable|file|mimes:pdf,xlsx,xls,csv',
            'penanggungjawab' => 'required|exists:users,id',
        ]);

        // Temukan data transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // Update file dokumen jika ada
        if ($request->hasFile('dokumen')) {
            $dokumenPath = $request->file('dokumen')->store('dokumen', 'public');
            $transaksi->dokumen = $dokumenPath;
        }

        // Update data transaksi
        $transaksi->update([
            'tanggal' => $validated['tanggal'],
            'pengeluaran' => $validated['pengeluaran'],
            'uraian' => $validated['uraian'],
            'bidang' => $validated['bidang'],
            'nominal' => $validated['nominal'],
            'user_id' => $validated['penanggungjawab'], // Update penanggungjawab
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('pengeluaran.catatan')->with('success', 'Data pengeluaran berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan data berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // Hapus dokumen jika ada
        if ($transaksi->dokumen && Storage::disk('public')->exists($transaksi->dokumen)) {
            Storage::disk('public')->delete($transaksi->dokumen);
        }

        // Hapus data transaksi
        $transaksi->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('pengeluaran.catatan')->with('success', 'Data pengeluaran berhasil dihapus!');
    }
}
