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
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" value="{{ $pergunta->titulo }}" required>
        <br>
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" required>{{ $pergunta->descricao }}</textarea>
        <br>
        <button type="submit">Atualizar</button>
    </form>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>