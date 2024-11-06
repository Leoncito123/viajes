<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controladorMich;

//rutas con controlador
Route::get('/mich/reservaciones', [controladorMich::class, 'reservaciones'])->name('rutareservaciones');
Route::get('/mich/inicioAdmin', [controladorMich::class, 'inicioAdmin'])->name('rutainicioAdmin');
Route::get('/mich/usuarios', [controladorMich::class, 'usuarios'])->name('rutausuarios');
Route::post('/comentarios', [controladorMich::class, 'comentarios'])->name('guardarcomentarios');


//pruebas rutas sin controlador
// Route::get('/mich/reservaciones', function () {
//     return view('mich.reservaciones'); 
// });
// Route::get('/mich/inicioAdmin', function () {
//     return view('mich.inicioAdmin');
// });

require __DIR__.'/auth.php';