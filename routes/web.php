<?php

use App\Http\Controllers\Admin\AsistenciaController;
use App\Http\Controllers\Admin\ContratoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmpleadoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
Route::get('/empleado',[EmpleadoController::class,'index'])->name('empleado');
Route::get('/contratos',[ContratoController::class,'index'])->name('contratos');
Route::get('/asistencias',[AsistenciaController::class,'index'])->name('asistencias');