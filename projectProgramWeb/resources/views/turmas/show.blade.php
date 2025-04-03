<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Turma</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Detalhes da Turma</h1>

    <p><strong>Nome da Turma:</strong> {{ $turma->nome_turma }}</p>
    <p><strong>Coordenador:</strong> {{ $turma->coordenadore?->nome ?? 'Sem Coordenador' }}</p>
    <p><strong>Professor:</strong> {{ $turma->professore?->nome ?? 'Sem Professor' }}</p>
    <p><strong>Aluno:</strong> {{ $turma->aluno?->nome ?? 'Sem Aluno' }}</p>

    <a href="{{ route('turmas.index') }}">Voltar</a>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>