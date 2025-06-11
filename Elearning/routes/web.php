<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Route::get('/', function () {
    return view('welcome');
});

// Halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dummy route dashboard (bisa Anda ganti dengan controller asli nantinya)
Route::get('/teacher/dashboard', function () {
    return 'Halaman Dashboard Guru';
})->middleware('auth');

Route::get('/student/dashboard', function () {
    return 'Halaman Dashboard Siswa';
})->middleware('auth');
