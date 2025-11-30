<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // 1. Adicionado o Trait de Autorização

class UsuariosController extends Controller
{
    use AuthorizesRequests; // Habilita o uso de $this->authorize()

    // O índice pode ser público ou protegido dependendo do requisito.
    public function index()
    {
        $usuarios = Usuarios::all();
        // O Model Usuarios deve ter 'protected $hidden = ["password"];' para não expor senhas.
        return response()->json($usuarios, Response::HTTP_OK);
    }

    /**
     * CREATE - Salva um novo usuário (Método: POST)
     */
    public function store(Request $request)
    {
        // ... (Lógica de store inalterada, pois não exige autorização de registro existente)
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pessoa,email',
            'password' => 'required|string|min:8',
        ]);

        $dados = $request->validated();
        $dados['password'] = bcrypt($dados['password']);
        $usuario = Usuarios::create($dados);
        $usuario->makeHidden('password');

        return response()->json($usuario, Response::HTTP_CREATED);
    }

    /**
     * READ (Unitário) - Mostra um usuário específico (Método: GET)
     */
    public function show($id)
    {
        $usuario = Usuarios::findOrFail($id);

        // 2. APLICAÇÃO DA POLÍTICA 'view' (Requisito: ver apenas o seu)
        $this->authorize('view', $usuario);

        $usuario->makeHidden('password');
        return response()->json($usuario, Response::HTTP_OK);
    }

    /**
     * UPDATE - Atualiza um usuário existente (Método: PUT/PATCH)
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuarios::findOrFail($id);

        // 3. APLICAÇÃO DA POLÍTICA 'update' (Requisito: editar apenas o seu)
        $this->authorize('update', $usuario);

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pessoa,email,' . $usuario->id,
            'password' => 'nullable|string|min:8',
        ]);

        $dados = $request->validated();

        if (isset($dados['password'])) {
            $dados['password'] = bcrypt($dados['password']);
        }

        $usuario->fill($dados);
        $usuario->save();

        $usuario->makeHidden('password');

        return response()->json($usuario, Response::HTTP_OK);
    }

    /**
     * DELETE - Exclui um usuário (Método: DELETE)
     */
    public function destroy($id)
    {
        $usuario = Usuarios::findOrFail($id);

        // 4. APLICAÇÃO DA POLÍTICA 'delete' (Requisito: excluir apenas o seu)
        $this->authorize('delete', $usuario);

        $usuario->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
