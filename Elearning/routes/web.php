<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;


// Halaman login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);

// Halaman registrasi
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('dosen')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dosen.dashboard');

    // Kelas
    Route::prefix('kelas')->group(function () {
        Route::get('/dosen', [ClassController::class, 'index'])->name('dosen.kelas.index');
        Route::post('/dosen', [ClassController::class, 'store'])->name('dosen.kelas.store');
        Route::get('/dosen', [ClassController::class, 'show'])->name('dosen.kelas.show');
        Route::put('/dosen', [ClassController::class, 'update'])->name('dosen.kelas.update');
        Route::delete('/dosen', [ClassController::class, 'destroy'])->name('dosen.kelas.destroy');
    });
});

// Dashboard Mahasiswa
Route::get('/mahasiswa/dashboard', function () {
    return 'Dashboard Mahasiswa';
})->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notification');
    Route::get('/notifications/create', [NotificationController::class, 'create'])->middleware('can:create-notification')->name('notifications.create');
    Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
    Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('/notifications/user', [NotificationController::class, 'getByUser'])->name('notifications.by_user');
    Route::get('/notifications/demo', [NotificationController::class, 'demo'])->middleware('can:create-notification')->name('notifications.demo');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/classes', [ClassController::class, 'index'])->name('dosen.daftar');
    Route::get('/classes/create', [ClassController::class, 'create'])->name('dosen.create');
    Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
    Route::get('/classes/{id}/edit', [ClassController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/{id}', [ClassController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{id}', [ClassController::class, 'destroy'])->name('classes.destroy');
});
