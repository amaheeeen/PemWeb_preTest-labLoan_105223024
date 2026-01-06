<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;


Route::get('/', [LoanController::class, 'index'])->name('dashboard');

// Route untuk Halaman Utama
Route::get('/', [LoanController::class, 'index'])->name('dashboard');
    
// Route Action (Pinjam & Kembali)
Route::post('/loan', [LoanController::class, 'store'])->name('loan.store');
Route::post('/loan/{id}/return', [LoanController::class, 'returnItem'])->name('loan.return');