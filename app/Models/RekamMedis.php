<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'pendaftaran.kode_pendaftaran',
                'separator' => '-',
                'unique' => true,
                'onUpdate' => true
            ]
        ];
    }

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranPasien::class, 'pendaftaran_id');
    }
}
