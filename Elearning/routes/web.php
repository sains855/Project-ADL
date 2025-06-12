<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Halaman registrasi
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Dosen
Route::get('/dosen/dashboard', [DashboardController::class, 'index'])->name('dosen.dashboard')->middleware('auth');

// Dashboard Mahasiswa
Route::get('/mahasiswa/dashboard', function () {
    return 'Dashboard Mahasiswa';
})->middleware('auth');

use App\Http\Controllers\NotificationController;

Route::get('/', [NotificationController::class, 'index']);

Route::prefix('notifications')->group(function () {
    Route::get('/tugas', [NotificationController::class, 'tugasBaru']);
    Route::get('/pesan', [NotificationController::class, 'pesanMasuk']);
    Route::get('/nilai', [NotificationController::class, 'nilaiTersedia']);
    Route::get('/pengingat', [NotificationController::class, 'pengingatKelas']);
});
