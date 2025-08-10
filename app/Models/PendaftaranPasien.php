<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranPasien extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'kode_pendaftaran'
            ]
        ];
    }

    public function jadwaldokter()
    {
        return $this->belongsTo(JadwalDokter::class);
    }

    public function pasien()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rekammedis()
    {
        return $this->hasOne(RekamMedis::class, 'pendaftaran_id');
    }
}
