<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\AuthController;

Route::apiResource('users', UserApiController::class);
Route::apiResource('books', BookController::class);
Route::apiResource('produks', ProdukController::class);
Route::apiResource('orders', OrderController::class);
Route::put('orders/{id}/status', [OrderController::class, 'updateStatus']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        // Contoh: return data user yang login
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']); // Optional: revoke token
    // Tambah route API lain di sini, misal Route::apiResource('posts', PostController::class);
});
