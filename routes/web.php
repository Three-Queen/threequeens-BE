<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BerandaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PesanController;
use App\Http\Controllers\Admin\PortofolioController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\TentangController;
use Illuminate\Support\Facades\Route;

// ============================================================
// AUTH ROUTES
// ============================================================
Route::middleware('guest')->group(function () {
    Route::get('/', fn () => redirect()->route('login'));
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('throttle:5,1');
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ============================================================
// ADMIN ROUTES (Protected)
// ============================================================
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Kategori Interior
        Route::resource('kategori', KategoriController::class)->except(['show']);

        // Produk Interior
        Route::resource('produk', ProdukController::class);

        // Portofolio Proyek
        Route::resource('portofolio', PortofolioController::class);

        // Manajemen Beranda
        Route::get('/beranda/edit', [BerandaController::class, 'edit'])->name('beranda.edit');
        Route::put('/beranda/update', [BerandaController::class, 'update'])->name('beranda.update');

        // Manajemen Tentang
        Route::get('/tentang/edit', [TentangController::class, 'edit'])->name('tentang.edit');
        Route::put('/tentang/update', [TentangController::class, 'update'])->name('tentang.update');

        // Manajemen Kontak
        Route::get('/kontak/edit', [KontakController::class, 'edit'])->name('kontak.edit');
        Route::put('/kontak/update', [KontakController::class, 'update'])->name('kontak.update');

        // Pesan Masuk
        Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index');
        Route::get('/pesan/{pesan}', [PesanController::class, 'show'])->name('pesan.show');
        Route::patch('/pesan/{pesan}/tandai', [PesanController::class, 'tandai'])->name('pesan.tandai');
        Route::delete('/pesan/{pesan}', [PesanController::class, 'destroy'])->name('pesan.destroy');

        // Pengaturan Akun
        Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
        Route::put('/pengaturan/profil', [PengaturanController::class, 'updateProfil'])->name('pengaturan.profil');
        Route::put('/pengaturan/password', [PengaturanController::class, 'updatePassword'])->name('pengaturan.password');
    });
