<?php

use App\Http\Controllers\KKController;
use App\Http\Controllers\KTPController;
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
// Route::get('/', function () {
//     return view('welcome');  
// });

// Halaman utama diarahkan ke Admin Panel
Route::get('/', function () {
    return view('home.index');   // Menampilkan halaman Admin Panel
});

// Web Routes for KK
Route::get('kk', [KKController::class, 'index']);           // List all KK (View)
Route::get('kk/create', [KKController::class, 'create']);   // Show form to create KK
Route::post('kk', [KKController::class, 'store']);          // Store new KK
Route::get('kk/{id}', [KKController::class, 'show']);       // Show specific KK (View)
Route::get('kk/{id}/edit', [KKController::class, 'edit']);  // Show form to edit KK
Route::put('kk/{id}', [KKController::class, 'update']);     // Update KK
Route::delete('kk/{id}', [KKController::class, 'destroy']); // Delete KK

// Web Routes for KTP
Route::get('ktp', [KTPController::class, 'index']);         // List all KTP (View)
Route::get('ktp/create', [KTPController::class, 'create']); // Show form to create KTP
Route::post('ktp', [KTPController::class, 'store']);        // Store new KTP
Route::get('ktp/{id}', [KTPController::class, 'show']);     // Show specific KTP (View)
Route::get('ktp/{id}/edit', [KTPController::class, 'edit']); // Show form to edit KTP
Route::put('ktp/{id}', [KTPController::class, 'update']);    // Update KTP
Route::delete('ktp/{id}', [KTPController::class, 'destroy']); // Delete KTP

// Route untuk CRUD Kartu Keluarga (KK)
Route::resource('kk', KKController::class);

// Route untuk CRUD Kartu Tanda Penduduk (KTP)
Route::resource('ktp', KTPController::class);

// Route untuk halaman daftar Kartu Keluarga dan anggota keluarga
Route::get('/daftar-kartu-keluarga', [KKController::class, 'daftarKartuKeluarga'])->name('kk.daftar');

