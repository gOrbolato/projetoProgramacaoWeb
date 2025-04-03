<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Coordenador</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Detalhes do Coordenador</h1>

    <p><strong>Nome:</strong> {{ $coordenador->nome }}</p>
    <p><strong>Idade:</strong> {{ $coordenador->idade }}</p>
    <p><strong>CPF:</strong> {{ $coordenador->cpf }}</p>
    <p><strong>Telefone:</strong> {{ $coordenador->telefone }}</p>

    <a href="{{ route('coordenadores.index') }}">Voltar</a>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>