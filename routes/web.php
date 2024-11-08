<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\JualController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\KasirController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Pengguna\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('index');
Route::get('/kontak', [DashboardController::class, 'kontak'])->name('kontak');
Route::get('/jadwal', [DashboardController::class, 'jadwal'])->name('jadwal');
Route::get('/jual', [DashboardController::class, 'jual'])->name('jual');
Route::get('/promo', [DashboardController::class, 'promo'])->name('promo');
Route::post('/laporan', [DashboardController::class, 'store'])->name('laporan');

// Rute untuk menampilkan halaman reset password
Route::get('/reset-password', [ResetPasswordController::class, 'create'])->name('password.reset');
// Rute untuk memproses reset password
Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('laporan', LaporanController::class);
        Route::post('laporan/deleteAll', [LaporanController::class, 'deleteAll'])->name('laporan.deleteAll');
        Route::resource('jual', JualController::class);
        Route::post('jual/deleteAll', [JualController::class, 'deleteAll'])->name('jual.deleteAll');
        Route::resource('jadwal', JadwalController::class);
        Route::post('jadwal/deleteAll', [JadwalController::class, 'deleteAll'])->name('jadwal.deleteAll');
        Route::resource('promo', PromoController::class);
        Route::post('promo/deleteAll', [PromoController::class, 'deleteAll'])->name('promo.deleteAll');
        Route::resource('kasir', KasirController::class);
        Route::get('kasir/print/{id}', [KasirController::class, 'print'])->name('kasir.print');
        Route::get('admin/kasir/history', [KasirController::class, 'getHistory'])->name('kasir.history');
        Route::get('admin/kasir/monthly-earnings', [KasirController::class, 'getMonthlyEarnings'])->name('kasir.monthly-earnings');
        Route::get('admin/kasir/store', [KasirController::class, 'store'])->name('kasir.store');
    });
});


require __DIR__ . '/auth.php';
