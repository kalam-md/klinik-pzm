<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_dokter'
            ]
        ];
    }

    public function poliklinik()
    {
        return $this->belongsTo(PoliKlinik::class, 'poliklinik_id');
    }

    public function JadwalDokter()
    {
        return $this->hasMany(JadwalDokter::class);
    }
}
