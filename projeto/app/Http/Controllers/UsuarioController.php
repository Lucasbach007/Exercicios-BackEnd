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
}
