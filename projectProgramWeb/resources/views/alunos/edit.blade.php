<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Editar Aluno</h1>

    <form action="{{ route('alunos.update', $aluno->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" value="{{ $aluno->name }}" required>
        <br>
        <label for="idade">Idade:</label>
        <input type="number" name="idade" id="idade" value="{{ $aluno->idade }}" required>
        <br>
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" value="{{ $aluno->cpf }}" required>
        <br>
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" value="{{ $aluno->telefone }}" required>
        <br>
        <label for="ano_letivo">Ano Letivo:</label>
        <input type="number" name="ano_letivo" id="ano_letivo" value="{{ $aluno->ano_letivo }}" required>
        <br>
        <button type="submit">Atualizar</button>
    </form>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>