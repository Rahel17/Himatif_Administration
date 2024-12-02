<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua transaksi yang sudah disetujui dan bulan adalah null
        $transaksis = Transaksi::where('status', 'setuju')
            ->whereNull('bulan')  // Memfilter transaksi dengan bulan null
            ->whereNull('pengeluaran')  // Memfilter transaksi dengan bulan null
            ->get();

        $users = User::where('role', 'anggota')
            ->whereIn('bidang', ['Inti', 'PSDM', 'Kerohanian', 'Humas', 'Kominfo', 'Danus', 'Minbak'])
            ->get();

        return view('pemasukan.catatan', compact('transaksis', 'users'));
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
        // Cari data pemasukan berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);
        $users = User::all();

        return view('pemasukan.edit', compact('transaksi', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'pemasukan' => 'required|in:proposal,sisa_proker,inventaris,kas_anggota,lainnya',
            'uraian' => 'nullable|string',
            'bidang' => 'required|in:Inti,PSDM,Kerohanian,Humas,Kominfo,Danus,Minbak',
            'nominal' => 'required|numeric|min:0',
            'dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
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
            'pemasukan' => $validated['pemasukan'],
            'uraian' => $validated['uraian'],
            'bidang' => $validated['bidang'],
            'nominal' => $validated['nominal'],
            'user_id' => $validated['penanggungjawab'], // Update penanggungjawab
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('pemasukan.catatan')->with('success', 'Data pemasukan berhasil diperbarui!');
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
        return redirect()->route('pemasukan.catatan')->with('success', 'Data pemasukan berhasil dihapus!');
    }
}
