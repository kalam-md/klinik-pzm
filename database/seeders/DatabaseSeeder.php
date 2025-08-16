<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama_lengkap' => 'Admin Utama',
                'username' => 'admin',
                'email' => 'admin@mail.com',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama_lengkap' => 'Bimo resnumurti',
                'username' => 'bimo',
                'email' => 'bimo@mail.com',
                'role' => 'pasien',
                'password' => Hash::make('bimo123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        $this->call([
            PoliKlinikSeeder::class,
            DokterSeeder::class,
            JadwalDokterSeeder::class,
        ]);
    }
}
