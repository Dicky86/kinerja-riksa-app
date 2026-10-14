<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerempuanDanAnakController;

// 1. Buka web pertama kali -> Muncul halaman gedung
Route::get('/', function () {
    return view('dashboard.landing'); 
})->name('landing');

// 2. Klik masuk -> Muncul halaman login
Route::get('/login', function () {
    return view('dashboard.login'); 
})->name('login');

// 3. Halaman Register (BARU - untuk buat akun)
Route::get('/register', function () {
    return view('dashboard.register');
})->name('register');

// 4. Login berhasil -> Masuk Dashboard (Ini yang nanti kita rombak pakai sidebar)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// 5. Halaman khusus Perempuan dan Anak
Route::get('/dashboard/perempuan-dan-anak', [PerempuanDanAnakController::class, 'index'])->name('dashboard.perempuan-dan-anak');