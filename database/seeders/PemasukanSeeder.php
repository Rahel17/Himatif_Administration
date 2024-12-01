<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemasukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pemasukans = [
            
            [
                'tanggal' => '06-01-2024',
                'pemasukan' => 'lainnya',
                'uraian' => 'Sisa kepengurusan tahun 2023',
                'bidang' => 'Inti',
                'nominal' => '3803000',
                'user_id' => '5',
                'status' => 'setuju',
            ],

            [
                'tanggal' => '20-01-2024',
                'pemasukan' => 'inventaris',
                'uraian' => 'Peminjaman lampu dari Himatif',
                'bidang' => 'Inti',
                'nominal' => '100000',
                'user_id' => '5',
                'status' => 'setuju',
            ],

            [
                'tanggal' => '13-03-2024',
                'pemasukan' => 'sisa_proker',
                'uraian' => 'Sisa kegiatan selebrasi wisudawan periode 105',
                'bidang' => 'PSDM',
                'nominal' => '61000',
                'user_id' => '5',
                'status' => 'setuju',
            ],

            [
                'tanggal' => '15-03-2024',
                'pemasukan' => 'inventaris',
                'uraian' => 'Peminjaman infokus dan layar dari Himatif',
                'bidang' => 'Inti',
                'nominal' => '120000',
                'user_id' => '5',
                'status' => 'setuju',
            ],

            [
                'tanggal' => '18-03-2024',
                'pemasukan' => 'lainnya',
                'uraian' => 'Sisa rapat kerja Himatif 2023-2024',
                'bidang' => 'Inti',
                'nominal' => '5600',
                'user_id' => '5',
                'status' => 'setuju',
            ],

            [
                'tanggal' => '17-04-2024',
                'pemasukan' => 'sisa_proker',
                'uraian' => 'Sisa kegiatan SABDA',
                'bidang' => 'Kerohanian',
                'nominal' => '1000',
                'user_id' => '5',
                'status' => 'setuju',
            ],

            [
                'tanggal' => '30-04-2024',
                'pemasukan' => 'sisa_proker',
                'uraian' => 'Sisa kegiatan CHROME IX',
                'bidang' => 'PSDM',
                'nominal' => '43500',
                'user_id' => '5',
                'status' => 'setuju',
            ],

            [
                'tanggal' => '02-05-2024',
                'pemasukan' => 'inventaris',
                'uraian' => 'Peminjaman layar dan infokus dari Himatif',
                'bidang' => 'Inti',
                'nominal' => '150000',
                'user_id' => '5',
                'status' => 'setuju',
            ],

            [
                'tanggal' => '17-05-2024',
                'pemasukan' => 'proposal',
                'uraian' => 'Pencairan proposal CHROME IX',
                'bidang' => 'PSDM',
                'nominal' => '2000000',
                'user_id' => '5',
                'status' => 'setuju',
            ],
            
        ];

        foreach ($pemasukans as $pemasukan) {
            \App\Models\Transaksi::create($pemasukan);
        }
    }
}
