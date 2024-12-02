<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class PersetujuanKasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan data pembayaran kas yang belum disetujui
        $kas = Transaksi::whereIn('status', ['proses', 'tolak']) // Perlihatkan yang statusnya "proses" atau "ditolak"
            ->whereNotNull('bulan') // Hanya data pemasukan
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('kas.persetujuan', compact('kas'));
    }

    public function setujui($id)
    {
        // Menyetujui pembayaran kas
        $transaction = Transaksi::findOrFail($id);
        $transaction->status = 'setuju';
        $transaction->save();

        return redirect()->route('kas.persetujuan')->with('success', 'Pembayaran kas disetujui.');
    }

    public function tolak($id)
    {
        // Menolak pembayaran kas
        $transaction = Transaksi::findOrFail($id);
        $transaction->status = 'tolak';
        $transaction->save();

        return redirect()->route('kas.persetujuan')->with('error', 'Pembayaran kas ditolak.');
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
    public function destroy(string $id)
    {
        //
    }
}
