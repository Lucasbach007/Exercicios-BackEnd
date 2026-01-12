<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User as Usuarios;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuarios::all();
    }

    public function store(Request $request)
    {
        $usuario = Usuarios::create($request->all());
        return response()->json($usuario, 201);
    }

    public function show(string $id)
    {
        return Usuarios::findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $usuario = Usuarios::findOrFail($id);
        $usuario->update($request->all());

        return response()->json($usuario);
    }

    public function destroy(string $id)
    {
        Usuarios::findOrFail($id)->delete();
        return response()->json(['message' => 'Usuário deletado']);
    }

   
public function updateFoto(Request $request, $id)
{
    $request->validate([
        'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $usuario = Usuarios::findOrFail($id);

    // Apagar foto antiga
    if ($usuario->foto && Storage::disk('public')->exists($usuario->foto)) {
        Storage::disk('public')->delete($usuario->foto);
    }

    // Salvar nova foto
    $path = $request->file('foto')->store('usuarios', 'public');

    $usuario->foto = $path;
    $usuario->save();

    return response()->json([
        'message' => 'Foto atualizada com sucesso',
        'foto_url' => asset('storage/' . $path)
    ]);
}
}
