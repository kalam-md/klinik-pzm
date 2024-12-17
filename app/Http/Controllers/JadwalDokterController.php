<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\JadwalDokter;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JadwalDokterController extends Controller
{
    public function index()
    {
        $jadwalDokters = JadwalDokter::with('dokter')->latest()->paginate(10);
        return view('jadwal-dokter.index', compact('jadwalDokters'));
    }

    public function create()
    {
        $dokters = Dokter::all();
        $hari = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        ];
        return view('jadwal-dokter.create', compact('dokters', 'hari'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'dokter_id' => [
                'required',
                'exists:dokters,id',
                // Validasi unik berdasarkan hari dan dokter
                Rule::unique('jadwal_dokters')->where(function ($query) use ($request) {
                    return $query->where('hari', $request->hari)
                        ->where('dokter_id', $request->dokter_id);
                })
            ]
        ], [
            'jam_selesai.after' => 'Jam selesai harus lebih dari jam mulai.'
        ]);

        $dokter = Dokter::findOrFail($validatedData['dokter_id']);
        $validatedData['slug'] = SlugService::createSlug(
            JadwalDokter::class,
            'slug',
            $validatedData['hari'] . ' ' . $dokter->nama_dokter
        );


        JadwalDokter::create($validatedData);

        alert()->success('Sukses', 'Jadwal Dokter berhasil ditambahkan');
        return redirect()->route('jadwal-dokter.index');
    }

    public function show(string $slug)
    {
        $jadwalDokter = JadwalDokter::where('slug', $slug)->with('dokter')->firstOrFail();
        return view('jadwal-dokter.show', compact('jadwalDokter'));
    }

    public function edit(string $slug)
    {
        $jadwalDokter = JadwalDokter::where('slug', $slug)->firstOrFail();
        $dokters = Dokter::all();
        $hari = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        ];
        return view('jadwal-dokter.edit', compact('jadwalDokter', 'dokters', 'hari'));
    }

    public function update(Request $request, string $slug)
    {
        $jadwalDokter = JadwalDokter::where('slug', $slug)->firstOrFail();

        $validatedData = $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'dokter_id' => [
                'required',
                'exists:dokters,id',
                // Validasi unik berdasarkan hari dan dokter, mengecualikan jadwal saat ini
                Rule::unique('jadwal_dokters')->where(function ($query) use ($request, $jadwalDokter) {
                    return $query->where('hari', $request->hari)
                        ->where('dokter_id', $request->dokter_id)
                        ->where('id', '!=', $jadwalDokter->id);
                })
            ]
        ], [
            'jam_selesai.after' => 'Jam selesai harus lebih dari jam mulai.'
        ]);

        $jadwalDokter->update($validatedData);

        alert()->success('Sukses', 'Jadwal Dokter berhasil diperbarui');
        return redirect()->route('jadwal-dokter.index');
    }

    public function destroy(string $slug)
    {
        $jadwalDokter = JadwalDokter::where('slug', $slug)->firstOrFail();
        $jadwalDokter->delete();

        alert()->success('Sukses', 'Jadwal Dokter berhasil dihapus');
        return redirect()->route('jadwal-dokter.index');
    }
}
