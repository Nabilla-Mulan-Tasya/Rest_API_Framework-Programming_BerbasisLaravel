<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\OrderController;

Route::apiResource('users', UserApiController::class);
Route::apiResource('books', BookController::class);
Route::apiResource('produks', ProdukController::class);
Route::apiResource('orders', OrderController::class);
Route::put('orders/{id}/status', [OrderController::class, 'updateStatus']);
