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

// Rotas públicas (listagem e visualização)
Route::get('/servicos', [ServicoController::class, 'index']);
Route::get('/servicos/{servico}', [ServicoController::class, 'show']);

Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos/{produto}', [ProdutoController::class, 'show']);

// Rotas Protegidas com Sanctum (criação/atualização/remoção e rotas de usuário)
Route::middleware('auth:sanctum')->group(function () {

        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);

        // proteger apenas as ações de escrita
        Route::apiResource('servicos', ServicoController::class)->except(['index', 'show']);
        Route::apiResource('produtos', ProdutoController::class)->except(['index', 'show']);

        Route::post('/avaliacoes/{tipo}/{id}', [AvaliacaoController::class, 'store']);

     Route::post('/usuarios/{id}/foto', [UsuarioController::class, 'updateFoto']);

});
