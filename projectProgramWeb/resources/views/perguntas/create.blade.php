<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Nova Pergunta</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Criar Nova Pergunta</h1>

    <form action="{{ route('perguntas.store') }}" method="POST">
        @csrf
        <label for="nome_pergunta">Nome da Pergunta:</label>
        <input type="text" name="nome_pergunta" id="nome_pergunta" required>
        <br>
        <label for="tipo_pergunta">Tipo da Pergunta:</label>
        <input type="text" name="tipo_pergunta" id="tipo_pergunta" value="texto" required>
        <br>
        <button type="submit">Salvar</button>
    </form>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>