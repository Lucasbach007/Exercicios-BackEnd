<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServicosRequest;
use App\Http\Requests\UpdateServicosRequest;
use App\Models\Servicos;

class ServicosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     return view ('servico'. ['servicos'=>Servicos::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    public function store(StoreServicosRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicos $servicos)
    {
        return view ('servico.show', ['servicos'=>$servicos]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicos $servicos)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServicosRequest $request, Servicos $servicos)
    {
    $request->validate ([
        'nome'=>'required',
        'descricao'=>'required',
        'preco'=>'required'
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicos $servicos)
    {
        //
    }
}
