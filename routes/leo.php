<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Rutas de hoteles 
Route::view('/hoteles', 'vistasLeo.Hoteles.index')->name('hoteles.index');

//Rutas para las vistas de administrador
Route::view('/admin', 'vistasLeo.Admin.index')->name('admin.index');
Route::view('admin/gestionador', 'vistasLeo.Admin.gestionador')->name('admin.gestionador');
Route::view('admin/hoteles', 'vistasLeo.Admin.hoteles')->name('admin.hoteles');
Route::view('admin/viajes', 'vistasLeo.Admin.vuelos')->name('admin.viajes');
Route::view('admin/hoteles/politicas', 'vistasLeo.Admin.politicasCancelacion')->name('admin.hoteles.politicas');


require __DIR__ . '/auth.php';
