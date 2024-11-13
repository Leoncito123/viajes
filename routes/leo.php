<?php

use App\Http\Controllers\leo\HotelesController;
use App\Http\Controllers\leo\ServicesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomsController;
use Illuminate\Support\Facades\Route;


//Rutas de hoteles 
Route::view('/hoteles', 'vistasLeo.Hoteles.index')->name('hoteles.index');

//Rutas para las vistas de administrador

//Rutas vistas de hoteles
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
  Route::get('admin/hoteles', [HotelesController::class, 'index'])->name('admin.hoteles'); //index
  Route::get('admin/hoteles/create', [HotelesController::class, 'create'])->name('admin.hoteles.create'); //create
  Route::get('admin/hoteles/edit/', [HotelesController::class, 'edit'])->name('admin.hoteles.edit'); //edit
  Route::get('admin/hoteles/rooms/{id}', [RoomsController::class, 'index'])->name('admin.hoteles.rooms'); //rooms

  //Rutas crear 
  Route::post('admin/hoteles/create', [HotelesController::class, 'store'])->name('admin.hoteles.create'); //Hoteles
  Route::post('admin/servicios/create', [ServicesController::class, 'create'])->name('admin.servicios.create'); //Servicios

  //Rutas para editar
  Route::post('admin/hoteles/edit/politicas/{id}', [HotelesController::class, 'politicasStore'])->name('admin.hoteles.politicas.store');

  //Rutas eliminar
  Route::delete('admin/servicios/delete/{id}', [ServicesController::class, 'delete'])->name('admin.servicios.delete');
  Route::delete('admin/hoteles/delete/{id}', [HotelesController::class, 'destroy'])->name('admin.hoteles.delete');

  Route::view('/admin', 'vistasLeo.Admin.index')->name('admin.index');
  Route::view('admin/gestionador', 'vistasLeo.Admin.gestionador')->name('admin.gestionador');
  Route::get('admin/hoteles', [HotelesController::class, 'index'])->name('admin.hoteles');
  Route::view('admin/viajes', 'vistasLeo.Admin.vuelos')->name('admin.viajes');
  Route::get('admin/hoteles/politicas/{id}', [HotelesController::class, 'politicas'])->name('admin.hoteles.politicas');
});







require __DIR__ . '/auth.php';
