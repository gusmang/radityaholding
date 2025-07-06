<?php

use App\Http\Controllers\Api\ApiPengadaanController;
use Illuminate\Support\Facades\Route;

Route::prefix('apis')->group(function () {
    Route::get('/api-get-pengadaan', [ApiPengadaanController::class, 'index'])->name('api-get-pengadaan');
    Route::get('/api-get-urgent', [ApiPengadaanController::class, 'urgentRequest'])->name('api-get-urgent');

    Route::get('/api-get-progress', [ApiPengadaanController::class, 'progressRequest'])->name('api-get-progress');
});
