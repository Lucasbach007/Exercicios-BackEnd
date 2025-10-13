<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
//rota produtos
Route::get('produtos',[ProdutoController::class, 'index']
);
//rota usuarios
Route::get('usuarios',[UsuarioController::class, 'index']);

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
