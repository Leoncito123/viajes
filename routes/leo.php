<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Rutas de hoteles 
Route::view('/hoteles', 'vistasLeo.Hoteles.index')->name('hoteles.index');


require __DIR__ . '/auth.php';
