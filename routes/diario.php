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
    Route::post('adminVuelos/vuelo/store', [AdminVuelosController::class, 'storeVuelo'])->name('vuelo.store');
    Route::post('/costoAsignament', [AdminVuelosController::class, 'costoAsignament'])->name('costo.asignament');

    //Routes PAY
    Route::get('/pay', [PayController::class, 'index'])->name('pay');
    Route::post('/payment', [PayController::class, 'pay'])->name('payment');

    //Rutas Aerolineas
    Route::post('/aerolinea/store', [AdminVuelosController::class, 'storeAirlane'])->name('airline.store');

    //Rutas Clases
    Route::post('/clase/store', [AdminVuelosController::class, 'storeClass'])->name('class.store');

    //Rutas Ages
    Route::post('/ages/store', [AdminVuelosController::class, 'storeAge'])->name('ages.store');

    //Rutas Aviones
    Route::post('/airplane/store', [AdminVuelosController::class, 'aiplaneStore'])->name('airplane.store');

    //Rutas asientos
    Route::post('/seats/store', [AdminVuelosController::class, 'seatStore'])->name('seats.store');
});

require __DIR__.'/auth.php';
