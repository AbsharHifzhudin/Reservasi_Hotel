<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

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

// Public Route
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
// Route::post('user_login', [UserController::class, 'user_login']);
// Route::get('cek_kamar', [KamarController::class, 'cek_kamar']);
Route::post('cek_kamar', [UserController::class, 'cek_kamar']);
Route::post('pesan_kamar', [UserController::class, 'pesan_kamar']);
Route::post('bukti_pembayaran', [UserController::class, 'bukti_pembayaran']);
Route::apiResource('user', UserController::class);
Route::apiResource('kamar', KamarController::class);
Route::apiResource('admin', AdminController::class);
Route::apiResource('pembayaran', PembayaranController::class);

//Protected Route
Route::middleware('auth:sanctum')->group(function() {
    Route::post('logout', [AuthController::class, 'logout']);

    //Route::apiResource('user', UserController::class);
    //Route::apiResource('kamar', KamarController::class);
    // Route::apiResource('admin', AdminController::class);
    // Route::apiResource('pembayaran', PembayaranController::class);
});