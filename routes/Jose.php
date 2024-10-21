<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/prueba', function () {
    return "Hola mundo";
});


require __DIR__.'/auth.php';
