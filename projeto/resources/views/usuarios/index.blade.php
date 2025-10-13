<!DOCTYPE html>
<head>
    <TITle>LISTA DE USUARIOS</TITle>

</head>
<body>
    <h1>Usuarios</h1>
<ul>
@foreach($Usuarios as $usuario)
<li>
    {{ $usuario->nome }}- @ {{($usuario->email) }}
</li>
@endforeach
</ul>
</body>
</html>
