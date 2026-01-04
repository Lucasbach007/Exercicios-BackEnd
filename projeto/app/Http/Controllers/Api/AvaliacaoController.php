<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Produto;

class AvaliacaoController extends Controller
{
   public function store(Request $request, $tipo, $id)
{
    $request->validate([
        'nota' => 'required|integer|min:1|max:5',
        'comentario' => 'nullable|string'
    ]);

    if ($tipo === 'servico') {
        $avaliavel = Servico::findOrFail($id);
    } elseif ($tipo === 'produto') {
        $avaliavel = Produto::findOrFail($id);
    } else {
        return response()->json(['erro' => 'Tipo inválido'], 400);
    }

    $avaliacao = $avaliavel->avaliacoes()->create([
        'nota' => $request->nota,
        'comentario' => $request->comentario
    ]);

    return response()->json($avaliacao, 201);
}

}
