<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranPasien;
use App\Models\RekamMedis;
use App\Models\User;
use App\Models\Dokter;
use App\Models\PoliKlinik;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Default periode: bulan ini
        $tanggalMulai = $request->input('tanggal_mulai', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $tanggalSelesai = $request->input('tanggal_selesai', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // Statistik Umum
        $statistikUmum = $this->getStatistikUmum($tanggalMulai, $tanggalSelesai);
        
        // Data Pendaftaran per Hari
        $pendaftaranHarian = $this->getPendaftaranHarian($tanggalMulai, $tanggalSelesai);
        
        // Top Poli Klinik
        $topPoliKlinik = $this->getTopPoliKlinik($tanggalMulai, $tanggalSelesai);
        
        // Top Dokter
        $topDokter = $this->getTopDokter($tanggalMulai, $tanggalSelesai);
        
        // Distribusi Status
        $distribusiStatus = $this->getDistribusiStatus($tanggalMulai, $tanggalSelesai);

        // Data Pasien Terbaru
        $pasienTerbaru = $this->getPasienTerbaru($tanggalMulai, $tanggalSelesai);

        // Diagnosis Terbanyak
        $diagnosisTerbanyak = $this->getDiagnosisTerbanyak($tanggalMulai, $tanggalSelesai);

        return view('laporan.index', compact(
            'statistikUmum',
            'pendaftaranHarian', 
            'topPoliKlinik',
            'topDokter',
            'distribusiStatus',
            'pasienTerbaru',
            'diagnosisTerbanyak',
            'tanggalMulai',
            'tanggalSelesai'
        ));
    }

    private function getStatistikUmum($tanggalMulai, $tanggalSelesai)
    {
        $totalPendaftaran = PendaftaranPasien::whereBetween('tanggal_pendaftaran', [$tanggalMulai, $tanggalSelesai])->count();
        $totalPasien = User::where('role', 'pasien')->count();
        $totalDokter = Dokter::count();
        $totalPoliKlinik = PoliKlinik::count();
        $pendaftaranSelesai = PendaftaranPasien::whereBetween('tanggal_pendaftaran', [$tanggalMulai, $tanggalSelesai])
                                               ->where('status', 'selesai')->count();
        $rekamMedisTerisi = RekamMedis::whereHas('pendaftaran', function($q) use ($tanggalMulai, $tanggalSelesai) {
                                      $q->whereBetween('tanggal_pendaftaran', [$tanggalMulai, $tanggalSelesai]);
                                  })->whereNotNull('diagnosis')->count();

        return [
            'total_pendaftaran' => $totalPendaftaran,
            'total_pasien' => $totalPasien,
            'total_dokter' => $totalDokter,
            'total_poli_klinik' => $totalPoliKlinik,
            'pendaftaran_selesai' => $pendaftaranSelesai,
            'rekam_medis_terisi' => $rekamMedisTerisi
        ];
    }

    private function getPendaftaranHarian($tanggalMulai, $tanggalSelesai)
    {
        return PendaftaranPasien::selectRaw('DATE(tanggal_pendaftaran) as tanggal, COUNT(*) as jumlah')
                               ->whereBetween('tanggal_pendaftaran', [$tanggalMulai, $tanggalSelesai])
                               ->groupBy('tanggal')
                               ->orderBy('tanggal')
                               ->get();
    }

    private function getTopPoliKlinik($tanggalMulai, $tanggalSelesai)
    {
        return PoliKlinik::withCount(['dokter as total_pendaftaran' => function($q) use ($tanggalMulai, $tanggalSelesai) {
                                $q->join('jadwal_dokters', 'dokters.id', '=', 'jadwal_dokters.dokter_id')
                                ->join('pendaftaran_pasiens', 'jadwal_dokters.id', '=', 'pendaftaran_pasiens.jadwaldokter_id')
                                ->whereBetween('pendaftaran_pasiens.tanggal_pendaftaran', [$tanggalMulai, $tanggalSelesai]);
                            }])
                        ->orderBy('total_pendaftaran', 'desc')
                        ->take(5)
                        ->get();
    }

    private function getTopDokter($tanggalMulai, $tanggalSelesai)
    {
        return Dokter::withCount(['JadwalDokter as total_pendaftaran' => function($q) use ($tanggalMulai, $tanggalSelesai) {
                            $q->join('pendaftaran_pasiens', 'jadwal_dokters.id', '=', 'pendaftaran_pasiens.jadwaldokter_id')
                            ->whereBetween('pendaftaran_pasiens.tanggal_pendaftaran', [$tanggalMulai, $tanggalSelesai]);
                        }])
                    ->with('poliklinik')
                    ->orderBy('total_pendaftaran', 'desc')
                    ->take(5)
                    ->get();
    }

    private function getDistribusiStatus($tanggalMulai, $tanggalSelesai)
    {
        return PendaftaranPasien::selectRaw('status, COUNT(*) as jumlah')
                               ->whereBetween('tanggal_pendaftaran', [$tanggalMulai, $tanggalSelesai])
                               ->groupBy('status')
                               ->get();
    }

    private function getPasienTerbaru($tanggalMulai, $tanggalSelesai)
    {
        return PendaftaranPasien::with(['pasien.biodata', 'jadwaldokter.dokter.poliklinik'])
                               ->whereBetween('tanggal_pendaftaran', [$tanggalMulai, $tanggalSelesai])
                               ->latest('tanggal_pendaftaran')
                               ->take(10)
                               ->get();
    }

    private function getDiagnosisTerbanyak($tanggalMulai, $tanggalSelesai)
    {
        return RekamMedis::selectRaw('diagnosis, COUNT(*) as jumlah')
                        ->whereHas('pendaftaran', function($q) use ($tanggalMulai, $tanggalSelesai) {
                            $q->whereBetween('tanggal_pendaftaran', [$tanggalMulai, $tanggalSelesai]);
                        })
                        ->whereNotNull('diagnosis')
                        ->where('diagnosis', '!=', '')
                        ->groupBy('diagnosis')
                        ->orderBy('jumlah', 'desc')
                        ->take(10)
                        ->get();
    }
}