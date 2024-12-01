<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'transaksi_id',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
