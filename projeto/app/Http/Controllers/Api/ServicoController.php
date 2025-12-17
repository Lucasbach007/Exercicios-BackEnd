<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\App\Models\Servicos;
use App\Models\Servicos as ModelsServicos;

class ServicoController extends Controller
{
    
    public function index()
    {
      return ModelsServicos::all();
    }

  
    public function store(Request $request)
    {
        $servico = ModelsServicos::create($request->all());
        return response()->json($servico,201);
    }

    public function show(string $id)
    {
        return ModelsServicos::findorfail($id);
    }

   
    public function update(Request $request, string $id)
    {
          $servico = ModelsServicos::findOrFail($id);
        $servico->update($request->all());

        return response()->json($servico);
    }


    public function destroy(string $id)
    {
        ModelsServicos::findOrFail($id)->delete();

        return response()->json(['message' => 'Servico deletado']);
    }
}
