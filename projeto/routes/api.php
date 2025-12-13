<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicosController;
use App\Models\Servicos;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;

Route::apiResource('/servicos', ServicosController::class);
Route::apiResource('/produtos', ProdutoController::class);
Route::apiResource('/usuarios', UsuarioController::class);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

