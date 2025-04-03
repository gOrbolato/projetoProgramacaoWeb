<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Professor</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Detalhes do Professor</h1>

    <p><strong>Nome:</strong> {{ $professor->nome }}</p>
    <p><strong>Idade:</strong> {{ $professor->idade }}</p>
    <p><strong>CPF:</strong> {{ $professor->cpf }}</p>
    <p><strong>Telefone:</strong> {{ $professor->telefone }}</p>
    <p><strong>Coordenador:</strong> {{ $professor->coordenadore?->nome ?? 'Sem Coordenador' }}</p>

    <a href="{{ route('professores.index') }}">Voltar</a>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>