<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\TagihanController;


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

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('pelanggan', PelangganController::class);

        Route::resource('tagihan', TagihanController::class);
        Route::get('/tagihan/{id}/print', [TagihanController::class, 'print'])
            ->name('tagihan.print');

        Route::get('/laporan/tagihan', [LaporanController::class, 'tagihan'])
            ->name('laporan.tagihan');
        Route::get('/laporan/pembayaran', [LaporanController::class, 'pembayaran'])
            ->name('laporan.pembayaran');
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
