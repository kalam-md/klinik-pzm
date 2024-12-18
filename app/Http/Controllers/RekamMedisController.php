<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranPasien;
use App\Models\RekamMedis;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'diagnosis' => 'required|max:255',
            'perawatan' => 'required|max:255',
            'pendaftaran_id' => 'required|max:255',
        ]);

        $pendaftaran = PendaftaranPasien::findOrFail($validatedData['pendaftaran_id']);
        $validatedData['slug'] = SlugService::createSlug(RekamMedis::class, 'slug', $pendaftaran->kode_pendaftaran);

        RekamMedis::create($validatedData);

        $pendaftaran->update([
            'status' => 'selesai'
        ]);

        alert()->success('Sukses', 'Rekam Medis berhasil disimpan');
        return redirect()->route('pendaftaran-pasien.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
