<?php

namespace App\Http\Controllers;

use App\Models\JadwalDokter;
use App\Models\PendaftaranPasien;
use App\Models\RekamMedis;
use App\Models\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PendaftaranPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaftaranPasien = PendaftaranPasien::with(['pasien', 'jadwaldokter.dokter.poliklinik'])->latest()->paginate(10);
        return view('pendaftaran.index', compact('pendaftaranPasien'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jadwalDokter = JadwalDokter::all();
        $pasien = User::where('role', 'pasien')->get();
        return view('pendaftaran.create', compact('jadwalDokter', 'pasien'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'keterangan' => 'required|max:255',
            'user_id' => 'required|max:255',
            'tanggal_pendaftaran' => 'required|max:255',
            'jadwaldokter_id' => 'required|max:255',
        ]);

        $tanggal = \Carbon\Carbon::parse($request->tanggal_pendaftaran)->format('Ymd');

        $uniqueString = $tanggal .
            \Carbon\Carbon::now()->format('His') .
            Str::random(5);

        $validatedData['kode_pendaftaran'] = 'PZM' . $uniqueString;

        $terakhirAntrian = PendaftaranPasien::where('tanggal_pendaftaran', $request->tanggal_pendaftaran)
            ->where('jadwaldokter_id', $request->jadwaldokter_id)
            ->max('nomor_antrian');

        $nomorAntrian = $terakhirAntrian ? $terakhirAntrian + 1 : 1;
        $validatedData['nomor_antrian'] = $nomorAntrian;

        $validatedData['slug'] = SlugService::createSlug(PendaftaranPasien::class, 'slug', $validatedData['kode_pendaftaran']);

        PendaftaranPasien::create($validatedData);

        alert()->success('Sukses', 'Pendaftaran Pasien berhasil ditambahkan');
        return redirect()->route('pendaftaran-pasien.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $pendaftaranPasien = PendaftaranPasien::where('slug', $slug)->firstOrFail();
        return view('pendaftaran.show', compact('pendaftaranPasien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $pendaftaranPasien = PendaftaranPasien::where('slug', $slug)->firstOrFail();
        $jadwalDokter = JadwalDokter::all();
        $pasien = User::where('role', 'pasien')->get();
        return view('pendaftaran.edit', compact('jadwalDokter', 'pasien', 'pendaftaranPasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $pendaftaranPasien = PendaftaranPasien::where('slug', $slug)->firstOrFail();

        $validatedData = $request->validate([
            'keterangan' => 'required|max:255',
            'user_id' => 'required|max:255',
            'tanggal_pendaftaran' => 'required|max:255',
            'jadwaldokter_id' => 'required|max:255',
        ]);

        $tanggal = \Carbon\Carbon::parse($request->tanggal_pendaftaran)->format('Ymd');

        $uniqueString = $tanggal .
            \Carbon\Carbon::now()->format('His') .
            Str::random(5);

        $validatedData['kode_pendaftaran'] = 'PZM' . $uniqueString;

        $terakhirAntrian = PendaftaranPasien::where('tanggal_pendaftaran', $request->tanggal_pendaftaran)
            ->where('jadwaldokter_id', $request->jadwaldokter_id)
            ->max('nomor_antrian');

        $nomorAntrian = $terakhirAntrian ? $terakhirAntrian + 1 : 1;
        $validatedData['nomor_antrian'] = $nomorAntrian;

        $validatedData['slug'] = SlugService::createSlug(PendaftaranPasien::class, 'slug', $validatedData['kode_pendaftaran']);

        PendaftaranPasien::where('id', $pendaftaranPasien->id)->update($validatedData);

        alert()->success('Sukses', 'Pendaftaran Pasien berhasil diubah');
        return redirect()->route('pendaftaran-pasien.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $pendaftaranPasien = PendaftaranPasien::where('slug', $slug)->firstOrFail();
        $pendaftaranPasien->delete();

        alert()->success('Sukses', 'Pendaftaran Pasien berhasil dihapus');
        return redirect()->route('pendaftaran-pasien.index');
    }

    public function batalkan(string $slug)
    {
        $pendaftaranPasien = PendaftaranPasien::where('slug', $slug)->firstOrFail();
        $pendaftaranPasien->update(['status' => 'gagal']);

        alert()->success('Sukses', 'Pendaftaran berhasil dibatalkan.');
        return redirect()->route('pendaftaran-pasien.index');
    }
}
