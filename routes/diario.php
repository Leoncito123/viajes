<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VuelosController;
use App\Http\Controllers\AdminVuelosController;
use App\Http\Controllers\PayController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/volar', [VuelosController::class, 'main'])->name('vuelos.main');
    Route::get('/vuelos', [VuelosController::class, 'index'])->name('vuelos.index');
    Route::get('/vuelos/show', [VuelosController::class, 'show'])->name('vuelos.show');
    Route::post('/vuelos/reservation', [VuelosController::class, 'reservationStore'])->name('reservation.store');
    Route::get('/vuelos/detail', [VuelosController::class, 'reservationDetail'])->name('vuelos.detail');
    Route::post('/canasta', [VuelosController::class, 'reservationShop'])->name('vuelo.canasta');
    Route::get('/compras', [PayController::class, 'canasta'])->name('compras');


    Route::get('/adminVuelos', [AdminVuelosController::class, 'index'])->name('vuelos.adminVuelos');

    //Routes PAY
    Route::get('/pay', [PayController::class, 'index'])->name('pay');
});

require __DIR__.'/auth.php';
