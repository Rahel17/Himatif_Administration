<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengeluarans = [
            
            [
                'tanggal' => '15-01-2024',
                'pengeluaran' => 'lainnya',
                'uraian' => 'cetak foto mantan ketua Himatif',
                'bidang' => 'Inti',
                'nominal' => '30000',
                'user_id' => '5',
                'status' => 'setuju',
            ],

            [
                'tanggal' => '31-01-2024',
                'pengeluaran' => 'inventaris',
                'uraian' => 'Pembelian baygon dan superpel',
                'bidang' => 'Inti',
                'nominal' => '18000',
                'user_id' => '5',
                'status' => 'setuju',
            ],

            [
                'tanggal' => '01-02-2024',
                'pengeluaran' => 'lainnya',
                'uraian' => 'Rapat kerja Himatif 2023/2024',
                'bidang' => 'Inti',
                'nominal' => '270000',
                'user_id' => '5',
                'status' => 'setuju',
            ],

            [
                'tanggal' => '12-02-2024',
                'pengeluaran' => 'proker',
                'uraian' => 'Pendanaan CHROME IX',
                'bidang' => 'PSDM',
                'nominal' => '250000',
                'user_id' => '5',
                'status' => 'setuju',
            ],

            [
                'tanggal' => '05-03-2024',
                'pengeluaran' => 'lainnya',
                'uraian' => 'Modal kewirausahaan',
                'bidang' => 'Danus',
                'nominal' => '150000',
                'user_id' => '5',
                'status' => 'setuju',
            ],

            [
                'tanggal' => '18-03-2024',
                'pengeluaran' => 'proker',
                'uraian' => 'Domain Himatif',
                'bidang' => 'Kominfo',
                'nominal' => '194000',
                'user_id' => '5',
                'status' => 'setuju',
            ],

            [
                'tanggal' => '31-03-2024',
                'pengeluaran' => 'proker',
                'uraian' => 'SABDA (Santunan Kaum Duafa)',
                'bidang' => 'Kerohanian',
                'nominal' => '200000',
                'user_id' => '5',
                'status' => 'setuju',
            ],

            [
                'tanggal' => '30-04-2024',
                'pengeluaran' => 'proker',
                'uraian' => 'KEBATIK (Kemah Bakti Informatika 2024)',
                'bidang' => 'PSDM',
                'nominal' => '500000',
                'user_id' => '5',
                'status' => 'setuju',
            ],

            [
                'tanggal' => '21-05-2024',
                'pengeluaran' => 'proker',
                'uraian' => 'Hosting',
                'bidang' => 'Kominfo',
                'nominal' => '200000',
                'user_id' => '5',
                'status' => 'setuju',
            ],
            
        ];

        foreach ($pengeluarans as $pengeluaran) {
            \App\Models\Transaksi::create($pengeluaran);
        }
    }
}
