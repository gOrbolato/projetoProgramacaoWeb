<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Pergunta</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Detalhes da Pergunta</h1>

    <p><strong>Nome da Pergunta:</strong> {{ $pergunta->nome_pergunta }}</p>
    <p><strong>Tipo da Pergunta:</strong> {{ $pergunta->tipo_pergunta }}</p>

    <a href="{{ route('perguntas.index') }}">Voltar</a>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>