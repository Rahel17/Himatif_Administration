<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->date('tanggal');
            $table->enum('pemasukan',['proposal','sisa_proker','inventaris','kas_anggota','lainnya'])->nullable();
            $table->enum('pengeluaran',['proker','inventaris','lainnya'])->nullable();
            $table->enum('bulan',['januari','februari','maret','april','mei','juni','juli','agustus','september','oktober'])->nullable();
            $table->text('uraian')->nullable();
            $table->foreignId('bidang')->nullable();
            $table->decimal('nominal',15,2);
            $table->string('dokumen')->nullable();
            $table->string('bukti')->nullable();
            $table->enum('status', ['proses', 'setuju', 'tolak'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
