<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PendaftaranPasien;
use App\Models\Dokter;
use App\Models\PoliKlinik;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BerandaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [];

        if ($user->role === 'admin') {
            // Data untuk admin
            $data = [
                'total_pasien' => User::where('role', 'pasien')->count(),
                'total_dokter' => Dokter::count(),
                'total_poliklinik' => PoliKlinik::count(),
                'total_pendaftaran_hari_ini' => PendaftaranPasien::whereDate('tanggal_pendaftaran', today())->count(),
                'pendaftaran_pending' => PendaftaranPasien::where('status', 'pending')->count(),
                'pendaftaran_selesai' => PendaftaranPasien::where('status', 'selesai')->count(),
                'total_rekam_medis' => RekamMedis::count(),
                
                // Pendaftaran terbaru untuk ditampilkan di tabel
                'pendaftaran_terbaru' => PendaftaranPasien::with(['pasien', 'jadwaldokter.dokter.poliklinik'])
                    ->latest()
                    ->limit(10)
                    ->get(),
                    
                // Statistik bulan ini
                'pendaftaran_bulan_ini' => PendaftaranPasien::whereMonth('tanggal_pendaftaran', now()->month)
                    ->whereYear('tanggal_pendaftaran', now()->year)
                    ->count(),
            ];
        } else {
            // Data untuk pasien
            $data = [
                'total_pendaftaran' => PendaftaranPasien::where('user_id', $user->id)->count(),
                'pendaftaran_pending' => PendaftaranPasien::where('user_id', $user->id)
                    ->where('status', 'pending')->count(),
                'pendaftaran_selesai' => PendaftaranPasien::where('user_id', $user->id)
                    ->where('status', 'selesai')->count(),
                'total_rekam_medis' => RekamMedis::whereHas('pendaftaran', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->count(),
                
                // Riwayat pendaftaran pasien
                'riwayat_pendaftaran' => PendaftaranPasien::with(['jadwaldokter.dokter.poliklinik', 'rekammedis'])
                    ->where('user_id', $user->id)
                    ->latest()
                    ->limit(5)
                    ->get(),
                    
                // Pendaftaran yang akan datang
                'pendaftaran_mendatang' => PendaftaranPasien::with(['jadwaldokter.dokter.poliklinik'])
                    ->where('user_id', $user->id)
                    ->where('tanggal_pendaftaran', '>=', today())
                    ->where('status', 'pending')
                    ->orderBy('tanggal_pendaftaran')
                    ->get(),
            ];
        }

        return view('beranda.index', compact('data'));
    }
}