<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MascotaController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas para Mascotas
Route::get('/mascotas', [MascotaController::class, 'index'])->name('mascota.index');
Route::get('/mascota/create', [MascotaController::class, 'create'])->name('mascota.create');
Route::post('/mascota/store', [MascotaController::class, 'store'])->name('mascota.store');
Route::get('/mascota/{mascota}/edit', [MascotaController::class, 'edit'])->name('mascota.edit');
Route::put('/mascota/{mascota}/update', [MascotaController::class, 'update'])->name('mascota.update');
Route::delete('/mascota/{mascota}', [MascotaController::class, 'destroy'])->name('mascota.destroy');


// Rutas para Usuarios
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
