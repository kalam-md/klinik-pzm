<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranPasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = PendaftaranPasien::with([
            'pasien.biodata',
            'jadwaldokter.dokter.poliklinik'
        ])->latest()->get();

        return view('pasien.index', compact('pasiens'));
    }

    public function show($slug)
    {
        $pasien = PendaftaranPasien::with([
            'pasien.biodata',
            'jadwaldokter.dokter.poliklinik',
            'rekammedis'
        ])->where('slug', $slug)->firstOrFail();

        return view('pasien.show', compact('pasien'));
    }
}