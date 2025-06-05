<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/registration', [AuthController::class, 'registration']);
Route::post('/auth', [AuthController::class, 'auth']);

Route::get('/categories', [ProductController::class, 'categories']);
Route::get('/categories/{category}/products', [ProductController::class, 'index']);
Route::get('/categories/{category}/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/products/{product}/buy', [PaymentController::class, 'buy']);
    Route::get('/orders', [PaymentController::class, 'orders']);
});

Route::post('/payment-webhook', [PaymentController::class, 'webhook'])->name('payment-webhook');
