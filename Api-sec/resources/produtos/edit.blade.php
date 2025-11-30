<h1>Altere o Produto Aqui</h1>
<form action="{{ route('prod.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="name">Nome do Produto:</label>
        <input type="text" id="name" name="name" value="{{ $product->name }}" required>
    </div>
    <div>
        <label for="price">Preço:</label>
        <input type="number" id="price" name="price" step="0.01" value="{{ $product->price }}" required>
    </div>
    <div>
        <label for="description">Descrição:</label>
        <textarea id="description" name="description" required>{{ $product->description }}</textarea>
    </div>
    <button type="submit">Atualizar Produto</button>
</form>
<a href="{{ route('prod.index') }}">Voltar para a lista de produtos</a> 