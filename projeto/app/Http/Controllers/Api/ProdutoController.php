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
            'estoque' => 'required|integer|min:0',
            'imagem' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Mapear 'nome' para 'nome_produto'
        $data['nome_produto'] = $data['nome'];
        unset($data['nome']);

        // Se houver imagem, processar upload
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $caminho = $imagem->store('produtos', 'public');
            $data['imagem'] = $caminho;
        }

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
            'estoque' => 'sometimes|required|integer|min:0',
            'imagem' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Mapear 'nome' para 'nome_produto'
        if (isset($data['nome'])) {
            $data['nome_produto'] = $data['nome'];
            unset($data['nome']);
        }

        // Se houver imagem, processar upload
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $caminho = $imagem->store('produtos', 'public');
            $data['imagem'] = $caminho;
        }

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
