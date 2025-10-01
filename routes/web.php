<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\AdminAuthController;

// 🔹 Route untuk User
Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');

Route::middleware(['auth:web'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // dashboard user
    })->name('user.dashboard');
});

// 🔹 Route untuk Admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth:admin', 'admin.role:admin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard'); // dashboard admin biasa
        })->name('admin.dashboard');
    });

    Route::middleware(['auth:admin', 'admin.role:superadmin'])->group(function () {
        Route::get('/super-dashboard', function () {
            return view('admin.super-dashboard'); // dashboard khusus superadmin
        })->name('admin.super.dashboard');
    });
});



Route::get('/', function () {
    return view('welcome');
});
