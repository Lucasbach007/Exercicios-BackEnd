<h1>Altere os seus dados<h1>
<a href ="{{ route('usuarios.show', $usuario->id) }}">Voltar para o seu perfil</a>
<form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Nome:</label>
    <input type="text" id="name" name="name" value="{{ $usuario->name }}" required>
    <br>        
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="{{ $usuario->email }}" required>
    <br>    
    <label for="password">Senha:</label>                            
    <input type="password" id="password" name="password">
    <br>    
    <button type="submit">Salvar alterações</button>
</form>         

<A href ="{{ route('home') }}">Voltar para a página inicial</a>