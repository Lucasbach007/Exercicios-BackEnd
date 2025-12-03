<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index(){

        $produtos= Produto::all();

        return view('produtos.index', compact('produtos'));
}
 public function create(){
    return view('produtos.create');
}

public function store(Request $request){
    $produto = new Produto();
    $produto->nome = $request->input('nome');
    $produto->descricao = $request->input('descricao');
    $produto->preco = $request->input('preco');
    $produto->quantidade = $request->input('quantidade');
    $produto->save();

    return redirect()->route('produtos.index');
}
public function edit($id){
    $produto = Produto::findOrFail($id);
    return view('produtos.edit', compact('produto'));
}
public function update(Request $request, $id){
    $produto = Produto::findOrFail($id);
    $produto->nome = $request->input('nome');
    $produto->descricao = $request->input('descricao');
    $produto->preco = $request->input('preco');
    $produto->quantidade = $request->input('quantidade');
    $produto->save();

    return redirect()->route('produtos.index');
}
public function destroy($id){
    $produto = Produto::findOrFail($id);
    $produto->delete();
    return redirect()->route('produtos.index');
}
}
