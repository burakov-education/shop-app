<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'auth'])->name('login.send');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories/create', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/categories/{category}/edit', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

        Route::get('/categories/{category}/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/categories/{category}/products/create', [ProductController::class, 'store'])->name('products.store');
    });
});
