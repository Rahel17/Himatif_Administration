<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'user_id',
        'tanggal',
        'pemasukan',
        'pengeluaran',
        'bulan',
        'uraian',
        'bidang',
        'nominal',
        'dokumen',
        'bukti',
        'status',

    ];    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}
