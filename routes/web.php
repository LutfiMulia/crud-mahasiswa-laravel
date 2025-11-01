<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

// Route untuk export CSV
Route::get('/mahasiswa/export', [MahasiswaController::class, 'export'])->name('mahasiswa.export');

// Route untuk cetak PDF
Route::get('/mahasiswa/cetak-pdf', [MahasiswaController::class, 'cetakPDF'])->name('mahasiswa.cetak-pdf');

// Route resource (CRUD)
Route::resource('mahasiswa', MahasiswaController::class);
