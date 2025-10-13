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
}
