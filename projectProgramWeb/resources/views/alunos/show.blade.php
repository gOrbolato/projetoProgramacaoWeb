<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Aluno</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Detalhes do Aluno</h1>

    <p><strong>Nome:</strong> {{ $aluno->name }}</p>
    <p><strong>Idade:</strong> {{ $aluno->idade }}</p>
    <p><strong>CPF:</strong> {{ $aluno->cpf }}</p>
    <p><strong>Telefone:</strong> {{ $aluno->telefone }}</p>
    <p><strong>Ano Letivo:</strong> {{ $aluno->ano_letivo }}</p>

    <a href="{{ route('alunos.index') }}">Voltar</a>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>