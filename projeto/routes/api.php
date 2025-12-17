<?php 

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ServicoController;
use App\Http\Controllers\Api\ProdutoController;
use Illuminate\Support\Facades\Route;

//  Públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protegidas com Sanctum
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    //Route::apiResource('servicos', ServicoController::class);
    //Route::apiResource('produtos', ProdutoController::class);
});
