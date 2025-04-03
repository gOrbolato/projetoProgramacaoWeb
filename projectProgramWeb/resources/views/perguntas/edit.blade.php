<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pergunta</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Editar Pergunta</h1>

    <form action="{{ route('perguntas.update', $pergunta->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nome_pergunta">Nome da Pergunta:</label>
        <input type="text" name="nome_pergunta" id="nome_pergunta" value="{{ $pergunta->nome_pergunta }}" required>
        <br>
        <label for="tipo_pergunta">Tipo da Pergunta:</label>
        <input type="text" name="tipo_pergunta" id="tipo_pergunta" value="{{ $pergunta->tipo_pergunta }}" required>
        <br>
        <button type="submit">Atualizar</button>
    </form>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>