<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

// Dashboard Dosen
Route::get('/dosen', [DashboardController::class, 'index'])->name('dosen.dashboard')->middleware('auth');

// Dashboard Mahasiswa
Route::get('/mahasiswa/dashboard', function () {
    return 'Dashboard Mahasiswa';
})->middleware('auth');


Route::middleware('auth')->group(function () {


    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::get('/create', [NotificationController::class, 'create'])
            ->middleware('can:create-notification')
            ->name('create');
        Route::post('/', [NotificationController::class, 'store'])->name('store');
        Route::post('/read/{id}', [NotificationController::class, 'markAsRead'])->name('read');
        Route::get('/user', [NotificationController::class, 'getByUser'])->name('by_user');
        Route::get('/demo', [NotificationController::class, 'demo'])
            ->middleware('can:create-notification')
            ->name('demo');
    });

// Route utama untuk halaman notifikasi
Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');

// Route untuk mengambil notifikasi berdasarkan tipe via AJAX
Route::get('/notifications/{type}', [NotificationController::class, 'getByType'])->name('notifications.by_type');

// Route untuk menandai notifikasi sebagai dibaca
Route::post('/notifications/mark-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.mark_read');

// Route untuk menandai semua notifikasi sebagai dibaca
Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark_all_read');

// Route untuk menghapus notifikasi
Route::delete('/notifications/{id}', [NotificationController::class, 'deleteNotification'])->name('notifications.delete');

    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', function () {
            return view('mahasiswa.dashboard');
        })->name('dashboard');
    });


    Route::prefix('dosen')->name('dosen.')->middleware('role:dosen')->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index']); // Alias


        Route::prefix('kelas')->name('kelas.')->group(function () {
            // Dashboard view with stats
            Route::get('/dashboard', [ClassController::class, 'dashboard'])->name('dashboard');

            // CRUD Operations
            Route::get('/', [ClassController::class, 'index'])->name('index');
            Route::get('/create', [ClassController::class, 'create'])->name('create');
            Route::post('/', [ClassController::class, 'store'])->name('store');
            Route::get('/{id}', [ClassController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [ClassController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ClassController::class, 'update'])->name('update');
            Route::delete('/{id}', [ClassController::class, 'destroy'])->name('destroy');

            // Additional class routes can be added here
        });
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/classes', [ClassController::class, 'index'])->name('dosen.daftar');
    Route::get('/classes/create', [ClassController::class, 'create'])->name('dosen.create');
    Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
    Route::get('/classes/{id}/edit', [ClassController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/{id}', [ClassController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{id}', [ClassController::class, 'destroy'])->name('classes.destroy');
});
