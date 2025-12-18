<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Servicos;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index()
    {
        return response()->json(Servicos::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0'
        ]);

        $servico = Servicos::create($data);

        return response()->json($servico, 201);
    }

    public function show(Servicos $servico)
    {
        return response()->json($servico);
    }

    public function update(Request $request, Servicos $servico)
    {
        $data = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'sometimes|required|numeric|min:0'
        ]);

        $servico->update($data);

        return response()->json($servico);
    }

    public function destroy(Servicos $servico)
    {
        $servico->delete();

        return response()->json(null, 204);
    }
}
