<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportesController;

<<<<<<< HEAD
Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes');
=======
Route::view('admin/reportes', 'vistasLeo.Admin.reportes')->name('admin.reportes');
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f


require __DIR__ . '/auth.php';
