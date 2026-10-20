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

// 3. Halaman Register (untuk buat akun)
Route::get('/register', function () {
    return view('dashboard.register');
})->name('register');

// 4. Login berhasil -> Masuk ke halaman Home (Ringkasan Kinerja 8 Kartu)
Route::get('/home', function () {
    return view('dashboard.home');
})->name('home');

// 5. Dashboard khusus Kasus Penanganan Ijazah
Route::get('/dashboard/kasus-ijazah', [DashboardController::class, 'index'])->name('dashboard.kasus-ijazah');

// 6. Dashboard khusus Kompensasi
Route::get('/dashboard/kompensasi', function () {
    return view('dashboard.capaian.kompensasi');
})->name('dashboard.kompensasi');
