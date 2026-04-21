<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;

// Route untuk yang BELUM Login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    // Route Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Transaksi Peminjaman (Semua Role)
    Route::get('loans', [LoanController::class, 'index'])->name('loans.index');
    Route::get('loans/create', [LoanController::class, 'create'])->name('loans.create');
    Route::post('loans/store', [LoanController::class, 'store'])->name('loans.store');
    Route::put('loans/{id}/return', [LoanController::class, 'returnItem'])->name('loans.return');

    // Manajemen Barang (Hanya Admin)
    Route::middleware('role:admin')->group(function () {
        Route::resource('items', ItemController::class);
    });
});

Route::post('/profile/upload', [ProfileController::class, 'update'])->name('profile.upload');
