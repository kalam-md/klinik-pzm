<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $biodata = Auth::user()->biodata ?? new Biodata();

        return view('profil.index', [
            'biodata' => $biodata
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nomor_telepon' => 'required|numeric',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user->update([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
        ]);

        $biodata = $user->biodata ?? new Biodata();

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/profil'), $photoName);

            if ($biodata->photo && file_exists(public_path('uploads/profil/' . $biodata->photo))) {
                unlink(public_path('uploads/profil/' . $biodata->photo));
            }

            $biodata->photo = $photoName;
        }

        $biodata->fill([
            'user_id' => $user->id,
            'nomor_telepon' => $request->nomor_telepon,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat
        ])->save();

        alert()->success('Sukses', 'Profil berhasil diperbarui');
        return redirect()->route('profil');
    }
}
