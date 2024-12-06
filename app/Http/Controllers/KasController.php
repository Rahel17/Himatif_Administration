<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil bulan yang dipilih dari request
        $bulan = $request->input('bulan');

        // Logika filter berdasarkan peran pengguna
        if ($user->role === 'admin' || $user->role === 'bendum') {
            // Admin atau bendahara melihat semua catatan dengan status 'setuju', kecuali pemasukan dan pengeluaran
            $kas = Transaksi::with('user')
                ->where('status', 'setuju') // Hanya data dengan status 'setuju'
                ->whereNull('pemasukan') // Filter kecuali pemasukan/pengeluaran
                ->whereNull('pengeluaran') // Filter kecuali pemasukan/pengeluaran
                ->when($bulan, function ($query) use ($bulan) {
                    return $query->where('bulan', $bulan); // Filter bulan jika dipilih
                })
                ->orderBy('created_at', 'asc')
                ->get();
        } else {
            // Anggota hanya melihat catatan miliknya sendiri dengan status 'setuju', kecuali pemasukan/pengeluaran
            $kas = Transaksi::with('user')
                ->where('user_id', $user->id)
                ->where('status', 'setuju') // Hanya data dengan status 'setuju'
                ->whereNull('pemasukan') // Filter kecuali pemasukan/pengeluaran
                ->whereNull('pengeluaran') // Filter kecuali pemasukan/pengeluaran
                ->when($bulan, function ($query) use ($bulan) {
                    return $query->where('bulan', $bulan); // Filter bulan jika dipilih
                })
                ->orderBy('created_at', 'asc')
                ->get();
        }

        return view('kas.catatan', compact('kas'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mencari data kas berdasarkan ID
        $kas = Transaksi::findOrFail($id);

        // Periksa apakah kas memiliki bukti dan hapus file jika ada
        if ($kas->bukti && file_exists(storage_path('app/public/' . $kas->bukti))) {
            unlink(storage_path('app/public/' . $kas->bukti)); // Menghapus file bukti
        }

        // Menghapus data kas
        $kas->delete();

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('kas.catatan')->with('success', 'Data kas berhasil dihapus.');
    }
}
