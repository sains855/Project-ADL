<?php

use App\Models\Classes;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\DashboardController;

// Halaman login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);

// Halaman registrasi
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Dosen
Route::get('/dosen', [DashboardController::class, 'dashboard'])->name('dosen.dashboard')->middleware('auth');
Route::delete('/dosen/{id}', [ClassController::class, 'destroy'])->name('dosen.destroy');
// Dashboard Mahasiswa

Route::get('/mahasiswa/dashboard', function () {
    return view ('modul.index');
})->name('modul.index')->middleware('auth');


// Route::get('/mahasiswa/modul/{id}', function ($id) {
//     $class = Classes::with('modules')->findOrFail($id);
//     return view('modul.dashboard', compact('class'));
// })->name('modul.dashboard')->middleware('auth');



Route::get('/mahasiswa/modul', function () {
    $classes = Classes::all(); // Menampilkan semua kelas
    return view('modul.kelas', compact('classes'));
})->name('modul.kelas')->middleware('auth');

Route::get('/mahasiswa/modul/{id}', [LearningController::class, 'showMahasiswaModul'])
    ->name('modul.dashboard')->middleware('auth');


Route::get('/mahasiswa/tugas', function (){
    return view('modul.tugas');
})->middleware('auth');



Route::middleware(['auth'])->group(function () {
    Route::get('/classes', [ClassController::class, 'index'])->name('classes.show');
    Route::get('/classes/create', [ClassController::class, 'create'])->name('classes.create');
    Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
    Route::get('/classes/{id}/edit', [ClassController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/{class}', [ClassController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{id}', [ClassController::class, 'destroy'])->name('classes.destroy');
});

Route::middleware(['auth'])->group(function () {

    // Route untuk learning detail
    Route::get('/learning/{classId}', [LearningController::class, 'show'])
        ->name('learning.detail');

    // Resource routes untuk modules dengan custom parameter
    Route::prefix('learning/{classId}')->group(function () {
        Route::post('/modules', [LearningController::class, 'storeModule'])
            ->name('learning.modules.store');
    });

    Route::prefix('learning/modules')->group(function () {
        Route::put('/{moduleId}', [LearningController::class, 'updateModule'])
            ->name('learning.modules.update');
        Route::delete('/{moduleId}', [LearningController::class, 'destroyModule'])
            ->name('learning.modules.destroy');
    });

    // Resource routes untuk assignments
    Route::prefix('learning/{classId}')->group(function () {
        Route::post('/assignments', [LearningController::class, 'storeAssignment'])
            ->name('learning.assignments.store');
    });

    Route::prefix('learning/assignments')->group(function () {
        Route::put('/{assignmentId}', [LearningController::class, 'updateAssignment'])
            ->name('learning.assignments.update');
        Route::delete('/{assignmentId}', [LearningController::class, 'destroyAssignment'])
            ->name('learning.assignments.destroy');
    });

});


    // Menampilkan daftar tugas untuk modul
Route::get('/mahasiswa/tugas', [TugasController::class, 'index'])->name('modul.tugas');

    // Menangani upload tugas
// Ganti dengan ini:
Route::post('/modul/{modul_id}/upload-tugas', [TugasController::class, 'uploadTugas'])->name('modul.tugas.upload');


// routes/web.php
Route::middleware('auth')->group(function () {
    Route::get('/message', function () {
        return view('message.index');
    })->name('message.index');
});

// routes/web.php
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/verify-email', [ProfileController::class, 'verifyEmail'])->name('profile.verify-email');
});
