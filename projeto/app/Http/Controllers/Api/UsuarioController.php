<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Usuarios;
use Illuminate\Support\Facades\Storage;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Usuarios::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usuario = Usuarios::create($request->all());
        return response()->json($usuario,201);
         
       
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
     return Usuarios::findorfail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario = Usuarios::findorfail($id);
        $usuario->update($request->all());

        return response()->json($usuario);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Usuarios::findOrFail($id)->delete();
        return response()->json(['message' => 'Este Usuario/a foi deletado']);
    }

public function uploadFoto(Request $request, $id)
{
    $request->validate([
        'foto' => 'required|image|max:2048'
    ]);

    $usuario = Usuarios::findOrFail($id);

    if ($usuario->foto) {
        Storage::disk('public')->delete($usuario->foto);
    }

    $path = $request->file('foto')->store('usuarios', 'public');

    $usuario->foto = $path;
    $usuario->save();

    return response()->json($usuario);
}
}