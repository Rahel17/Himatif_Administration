<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data pengguna
        $users = User::whereNotIn('role', ['admin', 'bendum'])->get();

        // Kirim data ke view
        return view('anggota.index', compact('users'));
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'npm' => 'required|string|unique:users,npm',
            'bidang' => 'required|in:Inti,PSDM,Kerohanian,Humas,Kominfo,Danus,Minbak',
            'no_hp' => 'required|string|max:15',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'npm' => $validated['npm'],
            'bidang' => $validated['bidang'],
            'no_hp' => $validated['no_hp'],
            'password' => bcrypt($validated['password']),
            'role' => 'anggota',
        ]);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan!');
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'npm' => 'required|string|unique:users,npm,' . $id,
            'bidang' => 'required|in:Inti,PSDM,Kerohanian,Humas,Kominfo,Danus,Minbak',
            'no_hp' => 'required|string|max:15',
            'password' => 'nullable|string|min:8', // Password opsional, minimal 8 karakter jika diisi
        ]);

        // Cari anggota berdasarkan ID
        $user = User::findOrFail($id);

        // Perbarui data anggota
        $user->name = $validated['name'];
        $user->npm = $validated['npm'];
        $user->bidang = $validated['bidang'];
        $user->no_hp = $validated['no_hp'];

        // Perbarui password jika diisi
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari pengguna berdasarkan ID
        $user = User::find($id);

        // Jika pengguna tidak ditemukan, beri pesan error
        if (!$user) {
            return redirect()->route('anggota.index')->withErrors('Anggota tidak ditemukan.');
        }

        // Hapus pengguna
        $user->delete();

        // Redirect ke halaman anggota dengan pesan sukses
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
