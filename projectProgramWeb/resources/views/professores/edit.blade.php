<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Professor</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Editar Professor</h1>

    <form action="{{ route('professores.update', $professor->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="{{ $professor->nome }}" required>
        <br>
        <label for="idade">Idade:</label>
        <input type="number" name="idade" id="idade" value="{{ $professor->idade }}" required>
        <br>
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" value="{{ $professor->cpf }}" required>
        <br>
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" value="{{ $professor->telefone }}" required>
        <br>
        <label for="coordenador_id">Coordenador:</label>
        <select name="coordenador_id" id="coordenador_id" required>
            <option value="">Selecione um coordenador</option>
            @foreach ($coordenadores as $coordenador)
                <option value="{{ $coordenador->id }}" {{ $professor->coordenador_id == $coordenador->id ? 'selected' : '' }}>
                    {{ $coordenador->nome }}
                </option>
            @endforeach
        </select>
        <br>
        <button type="submit">Atualizar</button>
    </form>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>