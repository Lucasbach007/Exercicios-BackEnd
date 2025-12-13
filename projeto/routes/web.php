<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
//rota produtos
Route::get('produtos',[ProdutoController::class, 'index']
);
Route::prefix('servicos')->group(function () {
    Route::get('/', [App\Http\Controllers\ServicosController::class, 'index'])->name('servicos.index');
    Route::get('/create', [App\Http\Controllers\ServicosController::class, 'create'])->name('servicos.create');
    Route::post('/', [App\Http\Controllers\ServicosController::class, 'store'])->name('servicos.store');
    Route::get('/{servicos}', [App\Http\Controllers\ServicosController::class, 'show'])->name('servicos.show');
    Route::get('/{servicos}/edit', [App\Http\Controllers\ServicosController::class, 'edit'])->name('servicos.edit');
    Route::put('/{servicos}', [App\Http\Controllers\ServicosController::class, 'update'])->name('servicos.update');
    Route::delete('/{servicos}', [App\Http\Controllers\ServicosController::class, 'destroy'])->name('servicos.destroy');
});

Route::prefix('produtos')->group(function () {
    Route::get('/', [App\Http\Controllers\ProdutoController::class, 'index'])->name('produtos.index');
    Route::get('/create', [App\Http\Controllers\ProdutoController::class, 'create'])->name('produtos.create');
    Route::post('/', [App\Http\Controllers\ProdutoController::class, 'store'])->name('produtos.store');
    Route::get('/{produtos}', [App\Http\Controllers\ProdutoController::class, 'show'])->name('produtos.show');
    Route::get('/{produtos}/edit', [App\Http\Controllers\ProdutoController::class, 'edit'])->name('produtos.edit');
    Route::put('/{produtos}', [App\Http\Controllers\ProdutoController::class, 'update'])->name('produtos.update');
    Route::delete('/{produtos}', [App\Http\Controllers\ProdutoController::class, 'destroy'])->name('produtos.destroy');
});



//rota usuarios
Route::get('usuarios',[UsuarioController::class, 'index']);

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');



require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
