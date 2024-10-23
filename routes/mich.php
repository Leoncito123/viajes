<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/pruebaMich', function () {
    return "Hola mundo";
});


require __DIR__.'/auth.php';