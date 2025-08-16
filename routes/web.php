<?php

use App\Http\Controllers\AntrianPasienController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalDokterController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PendaftaranPasienController;
use App\Http\Controllers\PoliKlinikController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\RiwayatMedisController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda')->middleware('auth');

// autentikasi
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('poli-klinik', PoliKlinikController::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('jadwal-dokter', JadwalDokterController::class);
    Route::resource('rekam-medis', RekamMedisController::class);
    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::get('/pasien/{slug}', [PasienController::class, 'show'])->name('pasien.show');
    Route::patch('/antrian/{slug}/update-status', [AntrianPasienController::class, 'updateStatus'])->name('antrian.updateStatus');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

Route::middleware(['auth', 'role:admin,pasien'])->group(function () {
    Route::get('/antrian', [AntrianPasienController::class, 'index'])->name('antrian.index');
    Route::get('/riwayat-medis', [RiwayatMedisController::class, 'index'])->name('riwayat-medis.index');
    Route::get('/riwayat-medis/{slug}', [RiwayatMedisController::class, 'show'])->name('riwayat-medis.show');
    Route::resource('pendaftaran-pasien', PendaftaranPasienController::class);
    Route::patch('/pendaftaran-pasien/{slug}/batalkan', [PendaftaranPasienController::class, 'batalkan'])->name('pendaftaran-pasien.batalkan');
});
