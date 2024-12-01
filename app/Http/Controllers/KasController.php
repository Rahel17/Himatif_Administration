<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil bulan yang dipilih dari request
        $bulan = $request->input('bulan');

        // Ambil data kas yang disetujui dan memiliki bukti
        $kas = Transaksi::where('status', 'setuju') // Filter berdasarkan status 'setuju'
            ->whereNotNull('bukti') // Pastikan ada bukti (kolom bukti tidak null)
            ->when($bulan, function ($query) use ($bulan) {
                return $query->where('bulan', $bulan); // Filter berdasarkan bulan jika ada
            })
            ->get();

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
