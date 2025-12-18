<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // GET /api/produtos
    public function index()
    {
        return response()->json(Produto::all());
    }

    // POST /api/produtos
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0'
        ]);

        $produto = Produto::create($data);

        return response()->json($produto, 201);
    }

    // GET /api/produtos/{id}
    public function show(Produto $produto)
    {
        return response()->json($produto);
    }

    // PUT /api/produtos/{id}
    public function update(Request $request, Produto $produto)
    {
        $data = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'sometimes|required|numeric|min:0',
            'estoque' => 'sometimes|required|integer|min:0'
        ]);

        $produto->update($data);

        return response()->json($produto);
    }

    // DELETE /api/produtos/{id}
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return response()->json(null, 204);
    }
}
