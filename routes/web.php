<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\TagihanController;
use App\Http\Controllers\Admin\ProdukWifiController;
Use App\Http\Controllers\User\ProdukController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;


// 🔹 Route untuk User Login
Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
// 🔹 Route untuk User Register
Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('user.register');
Route::post('/register', [UserAuthController::class, 'register'])->name('user.register.post');

Route::middleware(['auth:web'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/produk', [ProdukController::class, 'index'])->name('user.produk.index');
    Route::get('/user/produk/pesan/{id}', [ProdukController::class, 'pesan'])->name('user.produk.pesan');

});

Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('tagihan', [UserDashboardController::class, 'tagihan'])->name('tagihan');
        Route::get('layanan', [UserDashboardController::class, 'layanan'])->name('layanan');
    });
});

Route::middleware(['auth:web'])->prefix('profile')->group(function () {
    Route::get('/', [App\Http\Controllers\User\UserProfileController::class, 'index'])->name('user.profile.index');
    Route::get('/create', [App\Http\Controllers\User\UserProfileController::class, 'create'])->name('user.profile.create');
    Route::post('/store', [App\Http\Controllers\User\UserProfileController::class, 'store'])->name('user.profile.store');
    Route::get('/edit', [App\Http\Controllers\User\UserProfileController::class, 'edit'])->name('user.profile.edit');
    Route::post('/update', [App\Http\Controllers\User\UserProfileController::class, 'update'])->name('user.profile.update');
    Route::delete('/destroy', [App\Http\Controllers\User\UserProfileController::class, 'destroy'])->name('user.profile.destroy');
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

            Route::get('/admin/produk', [ProdukWifiController::class, 'index'])->name('admin.produk.index');
            Route::get('/admin/produk/create', [ProdukWifiController::class, 'create'])->name('admin.produk.create');
            Route::post('/admin/produk', [ProdukWifiController::class, 'store'])->name('admin.produk.store');
            Route::get('/admin/produk/{id}/edit', [ProdukWifiController::class, 'edit'])->name('admin.produk.edit');
Route::put('/admin/produk/{id}', [ProdukWifiController::class, 'update'])->name('admin.produk.update');

            Route::delete('/admin/produk/{id}', [ProdukWifiController::class, 'destroy'])->name('admin.produk.destroy');

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
