<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JadwalDokter;
use App\Models\Dokter;

class JadwalDokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua dokter
        $dokters = Dokter::all();

        // Jadwal untuk dr. Ahmad Wijaya (Poli Umum)
        $drAhmad = $dokters->where('nama_dokter', 'dr. Ahmad Wijaya')->first();
        JadwalDokter::create([
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '12:00',
            'dokter_id' => $drAhmad->id
        ]);
        JadwalDokter::create([
            'hari' => 'Rabu',
            'jam_mulai' => '13:00',
            'jam_selesai' => '17:00',
            'dokter_id' => $drAhmad->id
        ]);
        JadwalDokter::create([
            'hari' => 'Jumat',
            'jam_mulai' => '08:00',
            'jam_selesai' => '12:00',
            'dokter_id' => $drAhmad->id
        ]);

        // Jadwal untuk dr. Siti Nurhaliza (Poli Anak)
        $drSiti = $dokters->where('nama_dokter', 'dr. Siti Nurhaliza, Sp.A')->first();
        JadwalDokter::create([
            'hari' => 'Selasa',
            'jam_mulai' => '09:00',
            'jam_selesai' => '13:00',
            'dokter_id' => $drSiti->id
        ]);
        JadwalDokter::create([
            'hari' => 'Kamis',
            'jam_mulai' => '14:00',
            'jam_selesai' => '18:00',
            'dokter_id' => $drSiti->id
        ]);
        JadwalDokter::create([
            'hari' => 'Sabtu',
            'jam_mulai' => '08:00',
            'jam_selesai' => '12:00',
            'dokter_id' => $drSiti->id
        ]);

        // Jadwal untuk drg. Budi Santoso (Poli Gigi)
        $drgBudi = $dokters->where('nama_dokter', 'drg. Budi Santoso')->first();
        JadwalDokter::create([
            'hari' => 'Senin',
            'jam_mulai' => '13:00',
            'jam_selesai' => '17:00',
            'dokter_id' => $drgBudi->id
        ]);
        JadwalDokter::create([
            'hari' => 'Rabu',
            'jam_mulai' => '08:00',
            'jam_selesai' => '12:00',
            'dokter_id' => $drgBudi->id
        ]);
        JadwalDokter::create([
            'hari' => 'Jumat',
            'jam_mulai' => '14:00',
            'jam_selesai' => '18:00',
            'dokter_id' => $drgBudi->id
        ]);

        // Jadwal untuk dr. Maya Sari (Poli Mata)
        $drMaya = $dokters->where('nama_dokter', 'dr. Maya Sari, Sp.M')->first();
        JadwalDokter::create([
            'hari' => 'Selasa',
            'jam_mulai' => '13:00',
            'jam_selesai' => '17:00',
            'dokter_id' => $drMaya->id
        ]);
        JadwalDokter::create([
            'hari' => 'Kamis',
            'jam_mulai' => '08:00',
            'jam_selesai' => '12:00',
            'dokter_id' => $drMaya->id
        ]);
        JadwalDokter::create([
            'hari' => 'Sabtu',
            'jam_mulai' => '14:00',
            'jam_selesai' => '18:00',
            'dokter_id' => $drMaya->id
        ]);

        // Jadwal untuk dr. Indra Gunawan (Poli Jantung)
        $drIndra = $dokters->where('nama_dokter', 'dr. Indra Gunawan, Sp.JP')->first();
        JadwalDokter::create([
            'hari' => 'Senin',
            'jam_mulai' => '14:00',
            'jam_selesai' => '18:00',
            'dokter_id' => $drIndra->id
        ]);
        JadwalDokter::create([
            'hari' => 'Rabu',
            'jam_mulai' => '09:00',
            'jam_selesai' => '13:00',
            'dokter_id' => $drIndra->id
        ]);
        JadwalDokter::create([
            'hari' => 'Jumat',
            'jam_mulai' => '13:00',
            'jam_selesai' => '17:00',
            'dokter_id' => $drIndra->id
        ]);
    }
}