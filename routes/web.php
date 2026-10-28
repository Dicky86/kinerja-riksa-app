<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB; // <-- WAJIB DITAMBAHKAN UNTUK MENGAMBIL DATABASE
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerempuanDanAnakController;
use App\Http\Controllers\IjazahController; // Pindahkan ke atas agar rapi

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
Route::get('/dashboard/kasus-ijazah', function () {
    // Tarik semua data, filter baris kosong
    $dataIjazah = DB::table('penanganan_ijazah')
                    ->where('perusahaan', '!=', '')
                    ->where('perusahaan', '!=', '-')
                    ->whereNotNull('perusahaan')
                    ->orderBy('id', 'asc')
                    ->get();
    
    // PERHATIKAN BARIS INI: Menggunakan dashboard.capaian.kasus-ijazah
    return view('dashboard.capaian.kasus-ijazah', ['dataIjazah' => $dataIjazah]);
})->name('dashboard.kasus-ijazah');

// 6. Dashboard khusus Kompensasi
Route::get('/dashboard/kompensasi', function () {
    return view('dashboard.capaian.kompensasi');
})->name('dashboard.kompensasi');

// 7. Dashboard khusus Posko THR (Tampilan Dummy Front-End)
Route::get('/dashboard/posko-thr', function () {
    return view('dashboard.capaian.posko-thr');
})->name('dashboard.posko-thr');

// Rute untuk Form Upload Excel Kasus Ijazah
Route::post('/import-ijazah', [IjazahController::class, 'simpanData']);