<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('barangs', BarangController::class);
    Route::apiResource('mutasis', MutasiController::class);

    Route::get('barang/{id}/mutasi', [MutasiController::class, 'getByBarang']);
    Route::get('user/{id}/mutasi', [MutasiController::class, 'getByUser']);
});
