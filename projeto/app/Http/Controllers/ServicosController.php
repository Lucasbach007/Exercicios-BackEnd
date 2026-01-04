<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('servico', [
            'servicos' => Servico::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('servico.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'duracao_minutos' => 'required|integer',
            'imagem' => 'nullable|string',
            'ativo' => 'boolean',
            'user_id' => 'required|exists:users,id',
        ]);

        Servico::create($data);

        return redirect()
            ->route('servicos.index')
            ->with('success', 'Serviço cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Servico $servico)
    {
        return view('servico.show', [
            'servico' => $servico
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servico $servico)
    {
        return view('servico.edit', [
            'servico' => $servico
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servico $servico)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'duracao_minutos' => 'required|integer',
            'imagem' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        $servico->update($data);

        return redirect()
            ->route('servicos.index')
            ->with('success', 'Serviço atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servico $servico)
    {
        $servico->delete();

        return redirect()
            ->route('servicos.index')
            ->with('success', 'Serviço removido com sucesso!');
    }
}
