<?php

use App\Http\Controllers\Api\BukuController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\PelangganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;


// Users
Route::apiResource('users', UserApiController::class);

// Buku
Route::apiResource('bukus', BukuController::class);

// Produk
Route::apiResource('produks', ProdukController::class);
Route::post('/produks/{id}/images', [ProdukController::class, 'uploadImages']);

// Orders
Route::apiResource('orders', OrdersController::class);
Route::put('orders/{id}/status', [OrdersController::class, 'updateStatus']);

// Pelanggan
Route::get('/pelanggan', [PelangganController::class, 'index']);
Route::post('/pelanggan', [PelangganController::class, 'store']);
Route::get('/pelanggan/phone/{no_hp}', [PelangganController::class, 'findByPhone']);
Route::put('/pelanggan/{id}', [PelangganController::class, 'update']);
Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy']);

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Route
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});

// Default Route
Route::get('/', function () {
    return 'API sukses';
});
