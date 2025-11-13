<div class:container>
    <h1>Editar Produto</h1>

    <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $produto->nome }}" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" id="descricao" name="descricao" required>{{ $produto->descricao }}</textarea>
        </div>
        <div class="form-group">
            <label for="preco">Preço:</label>
            <input type="number" step="0.01" class="form-control" id        
            ="preco" name="preco" value="{{ $produto->preco }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
<!DOCTYPE html>
<head>

    <TITle>LISTA DE PRODUTOS DE SALÃO</TITle>
</head>
<body>
    <h1>Produtos</h1>
<ul>
@foreach($produtos as $produto)
<li>
    {{ $produtos->nome_produto }}- R$ {{ number_format($produto-
preco,2 ',','.') }}
</li>
@endforeach
</ul>
</body>
</html> 
