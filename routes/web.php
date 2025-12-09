<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryMovementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS (login)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');         // form (GET)
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');   // procesar login (POST)

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (requieren auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // home -> productos
    Route::get('/', function () {
        return redirect()->route('products.index');
    });

    // Productos - CRUD completo
    Route::resource('products', ProductController::class);

    // Movimientos de inventario (index, create, store)
    Route::resource('inventory', InventoryMovementController::class)
        ->only(['index','create','store']);

    // Perfil del usuario (mostrar + actualizar)
    Route::get('/perfil', [UserController::class, 'show'])->name('user.show');
    Route::put('/perfil', [UserController::class, 'update'])->name('user.update');

    // Logout (POST)
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
