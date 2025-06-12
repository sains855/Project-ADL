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

// // Dummy route dashboard (bisa Anda ganti dengan controller asli nantinya)
// Route::get('/dosen/dashboard', function () {
//     return 'Dosen.Dashboard';
// })->middleware('auth');
route::get('/dosen/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dosen.dashboard');
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
