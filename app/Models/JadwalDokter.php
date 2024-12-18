<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JadwalDokter extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['hari', 'dokter.nama_dokter'],
                'separator' => '-',
                'method' => function ($string, $separator) {
                    return Str::slug($string, $separator);
                },
                'unique' => true,
                'onUpdate' => true
            ]
        ];
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function pendaftaran()
    {
        return $this->hasMany(PendaftaranPasien::class);
    }
}
