<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'auth'])->name('login.send');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/', function () {
            return 'categories';
        })->name('categories.index');
    });
});
