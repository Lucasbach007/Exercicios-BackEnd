<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Usuarios;
class UsuarioController extends Controller
{
    public function index(){
 $Usuarios= Usuarios::all();
 return view ('usuarios.index',Compact('Usuarios'));

}
    public function create(){
        return view ('usuarios.create');
    }
    public function store(Request $request){
        $Usuarios = new Usuarios();
        $Usuarios->nome = $request->input('nome');
        $Usuarios->email = $request->input('email');
        $Usuarios->senha = bcrypt($request->input('senha'));
        $Usuarios->save();
        return redirect()->route('usuarios.index');
    }
 public function edit($id){
    $Usuarios = Usuarios::find($id);
    return view('usuarios.edit', compact('Usuarios'));
 }
 public function update(Request $request, $id){
    $Usuarios = Usuarios::find($id);
    $Usuarios->nome = $request->input('nome');
    $Usuarios->email = $request->input('email');
    if($request->input('senha')){
        $Usuarios->senha = bcrypt($request->input('senha'));
}
    $Usuarios->save();
    return redirect()->route('usuarios.index');
 }
 public function uploadFoto(Request $request, $id)
{
    $request->validate([
        'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $user = Usuarios::findOrFail($id);

    // Remove foto antiga (se existir)
    if ($user->foto) {
        Storage::disk('public')->delete($user->foto);
    }

    // Salva nova foto
    $path = $request->file('foto')->store('usuarios', 'public');

    // Atualiza usuário
    $user->foto = $path;
    $user->save();

    return response()->json([
        'message' => 'Foto enviada com sucesso',
        'foto' => asset('storage/' . $path)
    ], 200);
}
public function updateFoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Usuarios::findOrFail($id);

        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }

        $path = $request->file('foto')->store('usuarios', 'public');

        $user->foto = $path;
        $user->save();

        return response()->json([
            'message' => 'Foto atualizada com sucesso',
            'foto' => asset('storage/' . $path),
        ], 200);
    }
}
