<?php

use App\Http\Controllers\ComentsController;
use App\Http\Controllers\leo\HotelesController;
use App\Http\Controllers\leo\ServicesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\Type_RoomsController;
use Illuminate\Support\Facades\Route;



//Rutas para las vistas de administrador
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('admin/hoteles', [HotelesController::class, 'index'])->name('admin.hoteles'); //index
    Route::get('admin/hoteles/create', [HotelesController::class, 'create'])->name('admin.hoteles.create'); //create
    Route::get('admin/hoteles/edit/{id}', [HotelesController::class, 'edit'])->name('admin.hoteles.edit'); //edit
    Route::get('admin/hoteles/rooms/{id}', [RoomsController::class, 'index'])->name('admin.hoteles.rooms'); //rooms
    Route::get('admin/hoteles/rooms/reservation/{id}', [ReservationController::class, 'index'])->name('admin.hoteles.rooms.reservation'); //reservation
    Route::get('admin/hoteles/coments/{id}', [ComentsController::class, 'index'])->name('admin.hoteles.coments'); //coments

    //Rutas crear
    Route::post('admin/hoteles/create', [HotelesController::class, 'store'])->name('admin.hoteles.create'); //Hoteles
    Route::post('admin/servicios/create', [ServicesController::class, 'create'])->name('admin.servicios.create'); //Servicios
    Route::post('admin/hoteles/type_rooms/create', [Type_RoomsController::class, 'store'])->name('admin.hoteles.type_rooms.create'); //Tipo de habitaciones

    //Rutas para editar
    Route::post('admin/hoteles/edit/politicas/{id}', [HotelesController::class, 'politicasStore'])->name('admin.hoteles.politicas.store');
    Route::post('admin/hoteles/edit/{id}', [HotelesController::class, 'update'])->name('admin.hoteles.update');
    Route::post('admin/servicios/edit/{id}', [ServicesController::class, 'update'])->name('admin.servicios.update');
    Route::post('admin/hoteles/type_rooms/edit/{id}', [Type_RoomsController::class, 'update'])->name('admin.hoteles.type_rooms.update');
    Route::post('admin/hoteles/rooms/edit/{id}', [RoomsController::class, 'update'])->name('admin.hoteles.rooms.update');

    //Rutas eliminar
    Route::delete('admin/servicios/delete/{id}', [ServicesController::class, 'delete'])->name('admin.servicios.delete');
    Route::delete('admin/hoteles/delete/{id}', [HotelesController::class, 'destroy'])->name('admin.hoteles.delete');
    Route::delete('admin/hoteles/type_rooms/delete/{id}', [Type_RoomsController::class, 'destroy'])->name('admin.hoteles.type_rooms.delete');
    Route::delete('admin/hoteles/images/delete/{id}', [HotelesController::class, 'deleteImage'])->name('admin.hoteles.images.delete');

    Route::view('/admin', 'vistasLeo.Admin.index')->name('admin.index');
    Route::view('admin/gestionador', 'vistasLeo.Admin.gestionador')->name('admin.gestionador');
    Route::get('admin/hoteles', [HotelesController::class, 'index'])->name('admin.hoteles');
    Route::view('admin/viajes', 'vistasLeo.Admin.vuelos')->name('admin.viajes');
    Route::get('admin/hoteles/politicas/{id}', [HotelesController::class, 'politicas'])->name('admin.hoteles.politicas');
});

//Rutas para las vistas de usuario
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/hoteles', [HotelesController::class, 'show'])->name('hoteles.index');
    Route::get('/hoteles/{id}', [HotelesController::class, 'showHotel'])->name('hoteles.show');
    Route::post('/hoteles/reservation', [ReservationController::class, 'store'])->name('reservation.hotel.store');
    Route::post('/hoteles/coment/{id}/{id_user}', [HotelesController::class, 'saveOpinion'])->name('comentarios.store');
});







require __DIR__ . '/auth.php';
