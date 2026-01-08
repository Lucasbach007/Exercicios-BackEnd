<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ServicoController;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\AvaliacaoController;
use App\Http\Controllers\Api\UsuarioController;

//rotas Publicas

Route::post('/teste', function () {
    return response()->json(['ok' => true]);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Rotas Protegidas com Sanctum

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('servicos', ServicoController::class);
    Route::apiResource('produtos', ProdutoController::class);

    Route::middleware('auth:sanctum')->group(function () {
    Route::post('/avaliacoes/{tipo}/{id}', [AvaliacaoController::class, 'store']);

   Route::post('/usuarios/{id}/foto', [UsuarioController::class, 'updateFoto'])
  ->middleware('auth:sanctum');
});

});
