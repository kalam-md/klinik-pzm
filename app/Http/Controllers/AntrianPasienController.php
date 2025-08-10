<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranPasien;
use App\Models\Dokter;
use App\Models\PoliKlinik;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AntrianPasienController extends Controller
{
    public function index(Request $request)
    {
        $query = PendaftaranPasien::with([
            'pasien.biodata',
            'jadwaldokter.dokter.poliklinik'
        ]);

        // Debug: Tampilkan semua data untuk testing
        $totalData = PendaftaranPasien::count();
        
        // Filter berdasarkan status (hanya pending dan selesai untuk antrian)
        $query->whereIn('status', ['pending', 'selesai']);

        // Jika tidak ada filter apapun, tampilkan semua data
        if (!$request->hasAny(['tanggal', 'bulan', 'tahun', 'dokter_id', 'poli_id', 'hari', 'status'])) {
            // Tidak ada filter tambahan, tampilkan semua
        } else {
            // Filter berdasarkan tanggal
            if ($request->filled('tanggal')) {
                $query->whereDate('tanggal_pendaftaran', $request->tanggal);
            }

            // Filter berdasarkan bulan dan tahun
            if ($request->filled('bulan') && $request->filled('tahun')) {
                $query->whereMonth('tanggal_pendaftaran', $request->bulan)
                      ->whereYear('tanggal_pendaftaran', $request->tahun);
            }

            // Filter berdasarkan dokter
            if ($request->filled('dokter_id')) {
                $query->whereHas('jadwaldokter', function($q) use ($request) {
                    $q->where('dokter_id', $request->dokter_id);
                });
            }

            // Filter berdasarkan poli klinik
            if ($request->filled('poli_id')) {
                $query->whereHas('jadwaldokter.dokter', function($q) use ($request) {
                    $q->where('poliklinik_id', $request->poli_id);
                });
            }

            // Filter berdasarkan hari
            if ($request->filled('hari')) {
                $query->whereHas('jadwaldokter', function($q) use ($request) {
                    $q->where('hari', $request->hari);
                });
            }

            // Filter berdasarkan status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }
        }

        // Urutkan berdasarkan nomor antrian
        $antrians = $query->orderBy('nomor_antrian', 'asc')->get();

        // Data untuk dropdown filter
        $dokters = Dokter::with('poliklinik')->get();
        $polis = PoliKlinik::all();
        $haris = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $bulans = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return view('antrian.index', compact('antrians', 'dokters', 'polis', 'haris', 'bulans'));
    }

    public function updateStatus(Request $request, $slug)
    {
        $request->validate([
            'status' => 'required|in:pending,selesai'
        ]);

        $antrian = PendaftaranPasien::where('slug', $slug)->firstOrFail();
        $antrian->update(['status' => $request->status]);

        return response()->json(['success' => true, 'message' => 'Status antrian berhasil diupdate']);
    }
}