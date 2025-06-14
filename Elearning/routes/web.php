<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;


// Halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

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
    return 'Dashboard Mahasiswa';
})->middleware('auth');

Route::get('/mahasiswa/modul', function () {
    return view('modul.dashboard');
})->middleware('auth');


Route::middleware(['auth'])->group(function () {
    Route::get('/classes', [ClassController::class, 'index'])->name('dosen.daftar');
    Route::get('/classes/create', [ClassController::class, 'create'])->name('dosen.create');
    Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
    Route::get('/classes/{id}/edit', [ClassController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/{class}', [ClassController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{id}', [ClassController::class, 'destroy'])->name('classes.destroy');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/learning/{subject}', [LearningController::class, 'show'])->name('learning.show');
    Route::post('/learning/{subject}/module', [LearningController::class, 'storeModule'])->name('learning.module.store');
    Route::put('/learning/module/{module}', [LearningController::class, 'updateModule'])->name('learning.module.update');
    Route::delete('/learning/module/{module}', [LearningController::class, 'destroyModule'])->name('learning.module.destroy');
    Route::post('/learning/{subject}/assignment', [LearningController::class, 'storeAssignment'])->name('learning.assignment.store');
    Route::put('/learning/assignment/{assignment}', [LearningController::class, 'updateAssignment'])->name('learning.assignment.update');
    Route::delete('/learning/assignment/{assignment}', [LearningController::class, 'destroyAssignment'])->name('learning.assignment.destroy');
});
