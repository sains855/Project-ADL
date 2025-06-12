<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

Route::get('/', [NotificationController::class, 'index']);

Route::prefix('notifications')->group(function () {
    Route::get('/tugas', [NotificationController::class, 'tugasBaru']);
    Route::get('/pesan', [NotificationController::class, 'pesanMasuk']);
    Route::get('/nilai', [NotificationController::class, 'nilaiTersedia']);
    Route::get('/pengingat', [NotificationController::class, 'pengingatKelas']);
});
