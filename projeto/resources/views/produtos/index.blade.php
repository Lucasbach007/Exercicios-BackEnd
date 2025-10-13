<!DOCTYPE html>
<head>
    <TITle>LISTA DE PRODUTOS DE SALÃO</TITle>

</head>
<body>
    <h1>Produtos</h1>
<ul>
@foreach($produtos as $produto)
<li>
{{ $produto->id }}- NM{{ $produto->nome_produto }}- R$ {{ number_format($produto->preco,2 ,',','.') }}
</li>
@endforeach
</ul>
</body>
</html>
