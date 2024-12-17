<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\PoliKlinik;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::with('poliklinik')->latest()->get();
        return view('dokter.index', compact('dokters'));
    }

    public function create()
    {
        $polikliniks = PoliKlinik::all();
        return view('dokter.create', compact('polikliniks'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_dokter' => 'required|unique:dokters,nama_dokter|max:255',
            'spesialis' => 'required|max:255',
            'nomor_telepon' => 'required|numeric',
            'email' => 'required|email|unique:dokters,email',
            'poliklinik_id' => 'required|exists:poli_kliniks,id'
        ]);

        $validatedData['slug'] = SlugService::createSlug(Dokter::class, 'slug', $validatedData['nama_dokter']);

        Dokter::create($validatedData);

        alert()->success('Sukses', 'Dokter berhasil ditambahkan');
        return redirect()->route('dokter.index');
    }

    public function show(string $slug)
    {
        $dokter = Dokter::where('slug', $slug)->with('poliklinik')->firstOrFail();
        return view('dokter.show', compact('dokter'));
    }

    public function edit(string $slug)
    {
        $dokter = Dokter::where('slug', $slug)->firstOrFail();
        $polikliniks = PoliKlinik::all();
        return view('dokter.edit', compact('dokter', 'polikliniks'));
    }

    public function update(Request $request, string $slug)
    {
        $dokter = Dokter::where('slug', $slug)->firstOrFail();

        $validatedData = $request->validate([
            'nama_dokter' => [
                'required',
                'max:255',
                Rule::unique('dokters')->ignore($dokter->id)
            ],
            'spesialis' => 'required|max:255',
            'nomor_telepon' => 'required|numeric',
            'email' => [
                'required',
                'email',
                Rule::unique('dokters')->ignore($dokter->id)
            ],
            'poliklinik_id' => 'required|exists:poli_kliniks,id'
        ]);

        $validatedData['slug'] = SlugService::createSlug(Dokter::class, 'slug', $validatedData['nama_dokter']);

        $dokter->update($validatedData);

        alert()->success('Sukses', 'Dokter berhasil diperbarui');
        return redirect()->route('dokter.index');
    }

    public function destroy(string $slug)
    {
        $dokter = Dokter::where('slug', $slug)->firstOrFail();
        $dokter->delete();

        alert()->success('Sukses', 'Dokter berhasil dihapus');
        return redirect()->route('dokter.index');
    }
}
