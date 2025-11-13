<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
public function edit($id){
    $Usuarios= Usuarios::findOrFail($id);
    return view ('usuarios.edit',Compact('Usuarios'));
}
public function store(Request $request){
    $request->validate([
        'name'=>'required|string|max:255',
        'email'=>'required|string|email|max:255|unique:usuarios',
        'password'=>'required|string|min:8|confirmed',
    ]);
    Usuarios::create($request->all());
    return redirect()->route('usuarios.index')
    ->with('success','Usuario criado com sucesso!');
}
public function destroy($id){
    $Usuarios= Usuarios::findOrFail($id);
    $Usuarios->delete();
    return redirect()->route('usuarios.index')
    ->with('success','Usuario deletado com sucesso!');
}
}
