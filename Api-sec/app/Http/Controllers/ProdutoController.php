<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Adicionado

class ProdutoController extends Controller
{
    use AuthorizesRequests; // Habilita o uso de métodos de autorização

    /**
     * READ (Todos) - Retorna a lista de produtos (Método: GET)
     * Endpoint: /api/produtos
     * *NOTA: Rota definida como pública no api.php*
     */
    public function index()
    {
        $produtos = Produto::all();
        return response()->json($produtos, Response::HTTP_OK);
    }

    /**
     * CREATE - Salva um novo produto (Método: POST)
     * Endpoint: /api/produtos
     * *NOTA: Rota PROTEGIDA por auth:sanctum no api.php*
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome_produto' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
        ]);

        $produto = Produto::create($request->all());
        return response()->json($produto, Response::HTTP_CREATED);
    }

    /**
     * READ (Unitário) - Mostra um produto específico (Método: GET)
     * Endpoint: /api/produtos/{id}
     */
    public function show($id)
    {
        $produto = Produto::findOrFail($id);
        return response()->json($produto, Response::HTTP_OK);
    }

    /**
     * UPDATE - Atualiza um produto (Método: PUT/PATCH)
     * Endpoint: /api/produtos/{id}
     * *NOTA: Rota PROTEGIDA por auth:sanctum no api.php*
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_produto' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
        ]);

        $produto = Produto::findOrFail($id);
        $produto->update($request->all());

        return response()->json($produto, Response::HTTP_OK);
    }

    /**
     * DELETE - Exclui um produto
     * Endpoint: /api/produtos/{id}
     * *NOTA: Rota PROTEGIDA por auth:sanctum no api.php*
     */
    public function destroy($id)
    {
        // Exemplo de checagem interna de habilidade
        // Se a rota for protegida por 'abilities:admin,moderator', mas apenas 'admin' puder deletar.
        if (!auth()->user()->tokenCan('admin')) {
             abort(Response::HTTP_FORBIDDEN, 'Ação restrita a administradores.');
        }

        $produto = Produto::findOrFail($id);
        $produto->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
