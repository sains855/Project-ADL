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

<<<<<<< HEAD
// Dashboard Dosen
Route::get('/dosen/dashboard', [DashboardController::class, 'index'])->name('dosen.dashboard')->middleware('auth');

// Dashboard Mahasiswa
=======
// Dummy route dashboard (bisa Anda ganti dengan controller asli nantinya)
Route::get('/dosen/dashboard', function () {
    return 'Dosen.Dashboard';
})->middleware('auth');
>>>>>>> 745de83413cf3221983263df9a10267f24928321
Route::get('/mahasiswa/dashboard', function () {
    return 'Dashboard Mahasiswa';
})->middleware('auth');
//