<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VuelosController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/volar', [VuelosController::class, 'main'])->name('vuelos.main');
    Route::get('/vuelos', [VuelosController::class, 'index'])->name('vuelos.index');
    Route::get('/vuelos/show', [VuelosController::class, 'show'])->name('vuelos.show');
});

require __DIR__.'/auth.php';
