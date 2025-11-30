<h1> Cadastrar Novo Produto</h1>
<form action="{{ route('prod.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Nome do Produto:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="price">Preço:</label>
        <input type="number" id="price" name="price" step="0.01" required>
    </div>
    <div>
        <label for="description">Descrição:</label>
        <textarea id="description" name="description" required></textarea>
    </div>
    <button type="submit">Cadastrar Produto</button>
</form>
<a href="{{ route('prod.index') }}">Voltar para a lista de produtos</a> 