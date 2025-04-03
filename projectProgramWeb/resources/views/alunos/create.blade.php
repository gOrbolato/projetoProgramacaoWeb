<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Novo Aluno</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Criar Novo Aluno</h1>

    <form action="{{ route('alunos.store') }}" method="POST">
        @csrf
        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="idade">Idade:</label>
        <input type="number" name="idade" id="idade" required>
        <br>
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" required>
        <br>
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" required>
        <br>
        <label for="ano_letivo">Ano Letivo:</label>
        <input type="number" name="ano_letivo" id="ano_letivo" required>
        <br>
        <button type="submit">Salvar</button>
    </form>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>