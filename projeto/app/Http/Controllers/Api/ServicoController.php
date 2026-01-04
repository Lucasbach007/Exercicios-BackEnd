<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index()
    {
        return response()->json(Servico::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0'
        ]);

        $servico = Servico::create($data);

        return response()->json($servico, 201);
    }

    public function show(Servico $servico)
    {
        return response()->json($servico);
    }

    public function update(Request $request, Servico $servico)
    {
        $data = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'sometimes|required|numeric|min:0'
        ]);

        $servico->update($data);

        return response()->json($servico);
    }

    public function destroy(Servico $servico)
    {
        $servico->delete();

        return response()->json(null, 204);
    }
}
