<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Novo Professor</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Criar Novo Professor</h1>

    <form action="{{ route('professores.store') }}" method="POST">
        @csrf
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
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
        <label for="coordenador_id">Coordenador:</label>
        <select name="coordenador_id" id="coordenador_id" required>
            <option value="">Selecione um coordenador</option>
            @foreach ($coordenadores as $coordenador)
                <option value="{{ $coordenador->id }}">{{ $coordenador->nome }}</option>
            @endforeach
        </select>
        <br>
        <button type="submit">Salvar</button>
    </form>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>