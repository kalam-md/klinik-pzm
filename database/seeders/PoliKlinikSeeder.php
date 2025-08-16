<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PoliKlinik;

class PoliKlinikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polikliniks = [
            [
                'nama_poli' => 'Poli Umum',
                'deskripsi' => 'Pelayanan kesehatan umum untuk berbagai keluhan dan pemeriksaan rutin'
            ],
            [
                'nama_poli' => 'Poli Anak',
                'deskripsi' => 'Pelayanan kesehatan khusus untuk bayi, anak-anak, dan remaja'
            ],
            [
                'nama_poli' => 'Poli Gigi',
                'deskripsi' => 'Pelayanan kesehatan gigi dan mulut termasuk perawatan dan pembersihan'
            ],
            [
                'nama_poli' => 'Poli Mata',
                'deskripsi' => 'Pelayanan kesehatan mata termasuk pemeriksaan refraksi dan pengobatan'
            ],
            [
                'nama_poli' => 'Poli Jantung',
                'deskripsi' => 'Pelayanan kesehatan jantung dan pembuluh darah dengan teknologi modern'
            ]
        ];

        foreach ($polikliniks as $poli) {
            PoliKlinik::create($poli);
        }
    }
}