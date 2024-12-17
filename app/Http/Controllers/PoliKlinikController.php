<?php

namespace App\Http\Controllers;

use App\Models\PoliKlinik;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PoliKlinikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $poliKliniks = PoliKlinik::all();
        return view('poli-klinik.index', compact('poliKliniks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('poli-klinik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_poli' => 'required|unique:poli_kliniks,nama_poli|max:255',
            'deskripsi' => 'required'
        ]);

        $validatedData['slug'] = SlugService::createSlug(PoliKlinik::class, 'slug', $validatedData['nama_poli']);

        PoliKlinik::create($validatedData);

        alert()->success('Sukses', 'Poli Klinik berhasil ditambahkan');
        return redirect()->route('poli-klinik.index');
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
    public function edit(string $slug)
    {
        $poliKlinik = PoliKlinik::where('slug', $slug)->firstOrFail();
        return view('poli-klinik.edit', compact('poliKlinik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $poliKlinik = PoliKlinik::where('slug', $slug)->firstOrFail();

        $validatedData = $request->validate([
            'nama_poli' => [
                'required',
                'max:255',
                Rule::unique('poli_kliniks')->ignore($poliKlinik->id)
            ],
            'deskripsi' => 'required'
        ]);

        $poliKlinik->update($validatedData);

        alert()->success('Sukses', 'Poli Klinik berhasil diperbarui');
        return redirect()->route('poli-klinik.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $poliKlinik = PoliKlinik::where('slug', $slug)->firstOrFail();
        $poliKlinik->delete();

        alert()->success('Sukses', 'Poli Klinik berhasil dihapus');
        return redirect()->route('poli-klinik.index');
    }
}
