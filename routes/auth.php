<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Rutas de autenticación
|--------------------------------------------------------------------------
|
| Login (GET) -> muestra formulario
| Login (POST) -> procesa credenciales
| Logout (POST) -> acción recomendada para cerrar sesión
| Logout (GET) -> respaldo para evitar MethodNotAllowed durante pruebas
|
*/

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

// Logout (POST) — recomendado
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Logout (GET) — respaldo para entornos de desarrollo / enlaces antiguos
Route::get('/logout', [LoginController::class, 'logout'])->name('logout.get');