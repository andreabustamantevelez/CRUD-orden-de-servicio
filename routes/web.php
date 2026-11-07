<?php

use App\Http\Controllers\OrdenServicioController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/ordenes');

Route::resource('ordenes', OrdenServicioController::class)
    ->parameters(['ordenes' => 'orden'])
    ->except(['show', 'destroy']);
