<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controladorMich;
use App\Http\Controllers\AdminVuelosController;

//rutas con controlador

Route::get('/mich/reservaciones', [controladorMich::class, 'reservaciones'])->name('rutareservaciones');
Route::get('/mich/usuarios', [controladorMich::class, 'usuarios'])->name('rutausuarios');
Route::post('/comentarios', [controladorMich::class, 'comentarios'])->name('guardarcomentarios');

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/mich/inicioAdmin', [controladorMich::class, 'inicioAdmin'])->name('rutainicioAdmin');
});

Route::post('/escalaAsignament', [AdminVuelosController::class, 'escalaAsignament'])->name('escala.asignament');

Route::get('/editFly/{id}', [AdminVuelosController::class, 'editFly'])->name('edit.vuelo');
Route::put('/updateFly/{id}', [AdminVuelosController::class, 'updateVuelo'])->name('update.vuelo');
Route::delete('/deleteFly/{id}', [AdminVuelosController::class, 'deleteFly'])->name('delete.vuelo');


require __DIR__.'/auth.php';