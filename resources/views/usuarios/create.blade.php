<h1>Crie sua conta </h1>
<a href ="{{ route('home') }}">Voltar para a página inicial</a>
<form action="{{ route('usuarios.store') }}" method="POST">
    @csrf
    <label for="name">Nome:</label>
    <input type="text" id="name" name="name" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="password">Senha:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Cadastrar</button>
</form>
<a href ="{{ route('usuario.up') }}">Voltar para a página inicial</a>
