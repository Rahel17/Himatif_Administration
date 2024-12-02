<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            
            [
                'name' => 'Admin Keuangan Himatif',
                'email' => 'admin@gmail.com',
                'npm' => 'ADMIN1234',
                // 'bidang' => 'admin',
                'no_hp' => '08123456789',
                'password' => bcrypt('admin'),
                'role' => 'admin',
            ],

            [
                'name' => 'Bendum',
                'email' => 'bendum@gmail.com',
                'npm' => 'BENDUM1234',
                // 'bidang' => 'bendum',
                'no_hp' => '08123456789',
                'password' => bcrypt('bendum'),
                'role' => 'bendum',
            ],

            [
                'name' => 'Fiter Ramadansyah',
                'email' => 'ter@gmail.com',
                'npm' => 'G1A022053',
                'bidang' => 'Inti',
                'no_hp' => '08123456789',
                'password' => bcrypt('121212'),
                'role' => 'anggota',
            ],

            [
                'name' => 'Azilzah Nur Zanafa',
                'email' => 'zilza@gmail.com',
                'npm' => 'G1A022003',
                'bidang' => 'Inti',
                'no_hp' => '08123456789',
                'password' => bcrypt('121212'),
                'role' => 'anggota',
            ],

            [
                'name' => 'Resyaliana Esa Putri',
                'email' => 'eca@gmail.com',
                'npm' => 'G1A022038',
                'bidang' => 'Inti',
                'no_hp' => '08123456789',
                'password' => bcrypt('121212'),
                'role' => 'anggota',                
            ],

            [
                'name' => 'Diodo Arrahman',
                'email' => 'diodo@gmail.com',
                'npm' => 'G1A022027',
                'bidang' => 'Inti',
                'no_hp' => '08123456789',
                'password' => bcrypt('121212'),
                'role' => 'anggota',
            ],

            [
                'name' => 'Rana Qonitah Helida',
                'email' => 'ran@gmail.com',
                'npm' => 'G1A022017',
                'bidang' => 'Inti',
                'no_hp' => '08123456789',
                'password' => bcrypt('121212'),
                'role' => 'anggota',                
            ],

            //PSDM
            [
                'name' => 'Ferdy Fitriansyah Rowi',
                'email' => 'ferdy@gmail.com',
                'npm' => 'G1A022082',
                'no_hp' => '08123456789',
                'password' => bcrypt('121212'),
                'role' => 'anggota',
                'bidang' => 'PSDM',
            ],

            
            [
                'name' => 'Anissa Shanniyah Aprilia',
                'email' => 'acel@gmail.com',
                'npm' => 'G1A022044',
                'no_hp' => '08123456789',
                'password' => bcrypt('121212'),
                'role' => 'anggota',
                'bidang' => 'PSDM',
            ],
            
            [
                'name' => 'Akram Analis',
                'email' => 'akram@gmail.com',
                'npm' => 'G1A022004',
                'no_hp' => '08123456789',
                'password' => bcrypt('121212'),
                'role' => 'anggota',
                'bidang' => 'Minbak',
            ],
            [
                'name' => 'Sophina Shafa Salsabila',
                'email' => 'sopi@gmail.com',
                'npm' => 'G1A022021',
                'no_hp' => '08123456789',
                'password' => bcrypt('121212'),
                'role' => 'anggota',
                'bidang' => 'Minbak',
            ],

            [
                'name' => 'Delvi Nur Ropiq Sitepu',
                'email' => 'ropiq@gmail.com',
                'npm' => 'G1A022005',
                'no_hp' => '08123456789',
                'password' => bcrypt('121212'),
                'role' => 'anggota',
                'bidang' => 'Kerohanian',
            ],

            [
                'name' => 'Rafi Afrian Al Haritz',
                'email' => 'rafi@gmail.com',
                'npm' => 'G1A022033',
                'no_hp' => '08123456789',
                'password' => bcrypt('121212'),
                'role' => 'anggota',
                'bidang' => 'Kerohanian',
            ],

            [
                'name' => 'Revan Averus Mufid',
                'email' => 'van@gmail.com',
                'npm' => 'G1A022065',
                'no_hp' => '08123456789',
                'password' => bcrypt('121212'),
                'role' => 'anggota',
                'bidang' => 'Humas',
            ],

            [
                'name' => 'Alif Nurhidayat',
                'email' => 'alif@gmail.com',
                'npm' => 'G1A022073',
                'no_hp' => '08123456789',
                'password' => bcrypt('121212'),
                'role' => 'anggota',
                'bidang' => 'Kominfo',
            ],

            [
                'name' => 'Wahyu Ozorah Manurung',
                'email' => 'wahyu@gmail.com',
                'npm' => 'G1A022060',
                'no_hp' => '08123456789',
                'password' => bcrypt('121212'),
                'role' => 'anggota',
                'bidang' => 'Danus',
            ],
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
