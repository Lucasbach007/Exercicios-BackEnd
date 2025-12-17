<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\App\Models\Usuarios;
use App\Models\Usuarios as ModelsUsuarios;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ModelsUsuarios::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usuario = ModelsUsuarios::create($request->all());
        return response()->json($usuario,201);
         
       
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
     return ModelsUsuarios::findorfail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario = ModelsUsuarios::findorfail($id);
        $usuario->update($request->all());

        return response()->json($usuario);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ModelsUsuarios::findOrFail($id)->delete();
        return response()->json(['message' => 'Este Usuario/a foi deletado']);
    }
}