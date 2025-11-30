<?php
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuariosController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Rotas para Usuários
Route::apiResource('usuarios', UsuariosController::class);

// Rotas para Produtos
Route::apiResource('produtos', ProdutoController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

