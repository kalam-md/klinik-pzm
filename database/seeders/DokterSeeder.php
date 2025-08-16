<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dokter;
use App\Models\PoliKlinik;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan poliklinik sudah ada
        $poliUmum = PoliKlinik::where('nama_poli', 'Poli Umum')->first();
        $poliAnak = PoliKlinik::where('nama_poli', 'Poli Anak')->first();
        $poliGigi = PoliKlinik::where('nama_poli', 'Poli Gigi')->first();
        $poliMata = PoliKlinik::where('nama_poli', 'Poli Mata')->first();
        $poliJantung = PoliKlinik::where('nama_poli', 'Poli Jantung')->first();

        $dokters = [
            [
                'nama_dokter' => 'dr. Ahmad Wijaya',
                'spesialis' => 'Dokter Umum',
                'nomor_telepon' => '081234567890',
                'email' => 'ahmad.wijaya@klinik.com',
                'poliklinik_id' => $poliUmum->id
            ],
            [
                'nama_dokter' => 'dr. Siti Nurhaliza, Sp.A',
                'spesialis' => 'Spesialis Anak',
                'nomor_telepon' => '081234567891',
                'email' => 'siti.nurhaliza@klinik.com',
                'poliklinik_id' => $poliAnak->id
            ],
            [
                'nama_dokter' => 'drg. Budi Santoso',
                'spesialis' => 'Dokter Gigi',
                'nomor_telepon' => '081234567892',
                'email' => 'budi.santoso@klinik.com',
                'poliklinik_id' => $poliGigi->id
            ],
            [
                'nama_dokter' => 'dr. Maya Sari, Sp.M',
                'spesialis' => 'Spesialis Mata',
                'nomor_telepon' => '081234567893',
                'email' => 'maya.sari@klinik.com',
                'poliklinik_id' => $poliMata->id
            ],
            [
                'nama_dokter' => 'dr. Indra Gunawan, Sp.JP',
                'spesialis' => 'Spesialis Jantung',
                'nomor_telepon' => '081234567894',
                'email' => 'indra.gunawan@klinik.com',
                'poliklinik_id' => $poliJantung->id
            ]
        ];

        foreach ($dokters as $dokter) {
            Dokter::create($dokter);
        }
    }
}