<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportesController;

Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes');


require __DIR__.'/auth.php';
