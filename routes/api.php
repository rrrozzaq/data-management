<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KKController;
use App\Http\Controllers\KTPController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// API Routes for KK
Route::get('kk', [KKController::class, 'apiIndex']);           // List all KK (JSON)
Route::post('kk', [KKController::class, 'apiStore']);          // Create KK (JSON)
Route::get('kk/{id}', [KKController::class, 'apiShow']);       // Show a specific KK (JSON)
Route::put('kk/{id}', [KKController::class, 'apiUpdate']);     // Update KK (JSON)
Route::delete('kk/{id}', [KKController::class, 'apiDestroy']); // Delete KK (JSON)

// API Routes for KTP
Route::get('ktp', [KTPController::class, 'apiIndex']);          // List all KTP (JSON)
Route::post('ktp', [KTPController::class, 'apiStore']);         // Create KTP (JSON)
Route::get('ktp/{id}', [KTPController::class, 'apiShow']);      // Show a specific KTP (JSON)
Route::put('ktp/{id}', [KTPController::class, 'apiUpdate']);    // Update KTP (JSON)
Route::delete('ktp/{id}', [KTPController::class, 'apiDestroy']); // Delete KTP (JSON)

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
