<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Halaman Depan (Redirect ke Login)
Route::get('/', function () { return redirect()->route('login'); });

// --- TAMU (GUEST) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// --- MEMBER (AUTH) ---
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard & Transaksi
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/borrow/{item}', [DashboardController::class, 'borrow'])->name('borrow');
    Route::patch('/return/{loan}', [DashboardController::class, 'returnItem'])->name('return');
});