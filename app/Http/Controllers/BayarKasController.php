<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BayarKasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = Auth::user();
    $kas = Transaksi::where('user_id', $user->id) // Ambil data sesuai user
        ->orderBy('tanggal', 'desc')
        ->get();

    
    $months = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
    ];

    return view('kas.bayar', compact('user', 'kas', 'months'));
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
        $request->validate([
            'nama' => 'required|string',
            'npm' => 'required|string',
            'bidang' => 'required|string',
            'bulan' => 'required|string|in:januari,februari,maret,april,mei,juni,juli,agustus,september,oktober',
            'nominal' => 'required|numeric|min:5000',
            'tanggal' => 'required|date',
            'bukti' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $buktiPath = $request->file('bukti')->store('bukti', 'public');

        Transaksi::create([
            'user_id' => Auth::id(), // Menambahkan ID user yang sedang login
            'nama' => $request->nama,
            'npm' => $request->npm,
            'bidang' => $request->bidang,
            'bulan' => $request->bulan,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
            'bukti' => $buktiPath,
            'status' => 'proses',
        ]);

        return redirect()->route('kas.bayar')->with('success', 'Kas Berhasil Diajukan');
    }

    public function updateStatus(Request $request, $id)
    {
        $transaction = Transaksi::findOrFail($id);
        $transaction->status = $request->status; // Status bisa berupa 'setuju' atau 'tolak'
        $transaction->save();

        return redirect()->route('kas.bayar')->with('success', 'Status Pembayaran Diperbarui');
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
