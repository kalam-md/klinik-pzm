<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\PendaftaranPasien;
use App\Models\Dokter;
use App\Models\PoliKlinik;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RiwayatMedisController extends Controller
{
    public function index(Request $request)
    {
        $query = RekamMedis::with([
            'pendaftaran.pasien.biodata',
            'pendaftaran.jadwaldokter.dokter.poliklinik'
        ]);

        // Filter berdasarkan nama pasien
        if ($request->filled('nama_pasien')) {
            $query->whereHas('pendaftaran.pasien', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->nama_pasien . '%');
            });
        }

        // Filter berdasarkan dokter
        if ($request->filled('dokter_id')) {
            $query->whereHas('pendaftaran.jadwaldokter', function($q) use ($request) {
                $q->where('dokter_id', $request->dokter_id);
            });
        }

        // Filter berdasarkan poli klinik
        if ($request->filled('poli_id')) {
            $query->whereHas('pendaftaran.jadwaldokter.dokter', function($q) use ($request) {
                $q->where('poliklinik_id', $request->poli_id);
            });
        }

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
            $query->whereHas('pendaftaran', function($q) use ($request) {
                $q->whereBetween('tanggal_pendaftaran', [$request->tanggal_dari, $request->tanggal_sampai]);
            });
        }

        // Filter berdasarkan diagnosis
        if ($request->filled('diagnosis')) {
            $query->where('diagnosis', 'like', '%' . $request->diagnosis . '%');
        }

        // Urutkan berdasarkan tanggal terbaru
        $riwayatMedis = $query->latest()->paginate(20);

        // Data untuk dropdown filter
        $dokters = Dokter::with('poliklinik')->get();
        $polis = PoliKlinik::all();

        return view('riwayat-medis.index', compact('riwayatMedis', 'dokters', 'polis'));
    }

    public function show($slug)
    {
        $rekamMedis = RekamMedis::with([
            'pendaftaran.pasien.biodata',
            'pendaftaran.jadwaldokter.dokter.poliklinik'
        ])->where('slug', $slug)->firstOrFail();

        // Ambil riwayat medis lain dari pasien yang sama
        $riwayatLain = RekamMedis::with([
            'pendaftaran.jadwaldokter.dokter.poliklinik'
        ])
        ->whereHas('pendaftaran', function($q) use ($rekamMedis) {
            $q->where('user_id', $rekamMedis->pendaftaran->user_id);
        })
        ->where('id', '!=', $rekamMedis->id)
        ->latest()
        ->take(5)
        ->get();

        return view('riwayat-medis.show', compact('rekamMedis', 'riwayatLain'));
    }
}