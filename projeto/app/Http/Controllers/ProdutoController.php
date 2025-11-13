<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    /**
     * Mostra todos os produtos.
     */
    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));
    }

    /**
     * Mostra o formulário de criação de um novo produto.
     */
    public function create()
    {
        return view('produtos.create');
    }

    /**
     * Salva um novo produto no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome_produto' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
        ]);

        Produto::create($request->all());

        return redirect()->route('produtos.index')
                         ->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Mostra o formulário de edição de um produto existente.
     */
    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produtos.edit', compact('produto'));
    }

    /**
     * Atualiza um produto no banco.
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

        return redirect()->route('produtos.index')
                         ->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Exclui um produto do banco.
     */
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return redirect()->route('produtos.index')
                         ->with('success', 'Produto excluído com sucesso!');
    }
}
