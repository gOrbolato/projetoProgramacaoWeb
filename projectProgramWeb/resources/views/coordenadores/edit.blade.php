<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Coordenador</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Editar Coordenador</h1>

    <form action="{{ route('coordenadores.update', $coordenador->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="{{ $coordenador->nome }}" required>
        <br>
        <label for="idade">Idade:</label>
        <input type="number" name="idade" id="idade" value="{{ $coordenador->idade }}" required>
        <br>
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" value="{{ $coordenador->cpf }}" required>
        <br>
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" value="{{ $coordenador->telefone }}" required>
        <br>
        <button type="submit">Atualizar</button>
    </form>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>