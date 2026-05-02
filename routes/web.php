<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;

Route::get('/entrada', function () {
    return view('pages.entrada');
})->name('entrada.index');

Route::post('/entrada', [VehicleController::class, 'store']);

Route::get('/veiculos', [VehicleController::class, 'index'])->name('veiculos.index');

Route::get('/veiculos/{id}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');

Route::put('/veiculos/{id}', [VehicleController::class, 'update'])->name('vehicles.update');

Route::put('/veiculos/{id}/saida', [VehicleController::class, 'exit'])->name('vehicles.exit');

Route::get('/', [VehicleController::class, 'dashboard'])->name('dashboard');


