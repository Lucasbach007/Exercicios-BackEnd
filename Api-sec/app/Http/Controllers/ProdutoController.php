<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Http\Response; // Importar para usar constantes de HTTP

class ProdutoController extends Controller
{
    /**
     * READ (Todos) - Retorna a lista de produtos (Método: GET)
     * Endpoint: /api/produtos
     */
    public function index()
    {
        $produtos = Produto::all();
        // Retorna a coleção de produtos e o código HTTP 200 (OK)
        return response()->json($produtos, Response::HTTP_OK);
    }

    /**
     * CREATE - Salva um novo produto (Método: POST)
     * Endpoint: /api/produtos
     */
    public function store(Request $request)
    {
        // 1. Validação dos dados (MUITO importante em APIs)
        $request->validate([
            'nome_produto' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
        ]);

        // 2. Cria o recurso
        $produto = Produto::create($request->all());

        // 3. Retorna o recurso criado e o código HTTP 201 (Created)
        return response()->json($produto, Response::HTTP_CREATED);
    }

    /**
     * READ (Unitário) - Mostra um produto específico (Método: GET)
     * Endpoint: /api/produtos/{id}
     */
    // *Nota: Para API, é comum usar Route Model Binding (Produto $produto)*
    public function show($id)
    {
        $produto = Produto::findOrFail($id);
        // Retorna o produto e o código HTTP 200 (OK)
        return response()->json($produto, Response::HTTP_OK);
    }

    /**
     * UPDATE - Atualiza um produto (Método: PUT/PATCH)
     * Endpoint: /api/produtos/{id}
     */
    public function update(Request $request, $id)
    {
        // 1. Validação
        $request->validate([
            'nome_produto' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
        ]);


        $produto = Produto::findOrFail($id);
        $produto->update($request->all());


        return response()->json($produto, Response::HTTP_OK);
    }


    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();


        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
