<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerempuanDanAnakController;

Route::get('/', function () {
    return view('welcome');
});

// Route Dashboard Perempuan dan Anak
Route::get('/dashboard/perempuan-dan-anak', [PerempuanDanAnakController::class, 'index'])->name('dashboard.perempuan-dan-anak');