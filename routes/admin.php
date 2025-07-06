<?php

use App\Http\Controllers\Api\ApiPengadaanController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::get('/api-get-pengadaan-web', [ApiPengadaanController::class, 'index'])->name('api-get-pengadaan-web');
});
