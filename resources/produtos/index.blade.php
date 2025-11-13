
<h1>Lista de Produtos</h1>

<a href="{{ route('produtos.cphp artisan route:list
reate') }}">Adicionar Novo Produto</a>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome do Produto</th>a
            <th>Descrição</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produtos as $produto)
            <tr>
                <td>{{ $produto->id }}</td>
                <td>{{ $produto->nome_produto }}</td>
                <td>{{ $produto->descricao }}</td>
                <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('produtos.edit', $produto->id) }}">Editar</a>
                    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Deseja realmente excluir este produto?')">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href ="{{ route('home') }}">Voltar para a página inicial
    </a>
<a href="{{ route(' produtos.create') }}">Adicionar Novo Produto</a>
<a href ="{{ route('produto.edit',$produto->id) }}">editar</a>