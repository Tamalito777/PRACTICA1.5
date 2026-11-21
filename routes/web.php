<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ReservacionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Auth.Login');
});

Route::get('/login', function () {
    return view('Auth.Login');
})->name('login');

Route::post('/iniciarsesion', [AuthController::class, 'login'])
    ->name('iniciarsesion');

Route::middleware('auth')->group(function () {

    Route::get('/cerrarsesion', [AuthController::class, 'cerrarSesion'])
        ->name('cerrarSesion');
        
    Route::get('/home', [EquipoController::class, 'GetEquipos'])
        ->name('home');

    Route::post('/equipos/create', [EquipoController::class, 'CreateEquipo'])
        ->middleware('rol:administrador')
        ->name('equipos.create');

    Route::put('/equipos/update/{id}', [EquipoController::class, 'UpdateEquipo'])
        ->middleware('rol:administrador')
        ->name('equipos.update');

    Route::delete('/equipos/delete/{id}', [EquipoController::class, 'DeleteEquipo'])
        ->middleware('rol:administrador')
        ->name('equipos.delete');

    Route::get('/reservaciones', [ReservacionController::class, 'GetReservaciones'])
        ->name('reservaciones.index');

    Route::post('/reservaciones/create', [ReservacionController::class, 'CreateReservacion'])
        ->name('reservaciones.create');

    Route::put('/reservaciones/cancelar/{id}', [ReservacionController::class, 'CancelarReservacion'])
        ->name('reservaciones.cancelar');
});