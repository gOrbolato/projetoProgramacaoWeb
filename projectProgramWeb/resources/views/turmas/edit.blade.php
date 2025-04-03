<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Turma</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Editar Turma</h1>

    <form action="{{ route('turmas.update', $turma->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nome_turma">Nome da Turma:</label>
        <input type="text" name="nome_turma" id="nome_turma" value="{{ $turma->nome_turma }}" required>
        <br>
        <label for="id_coordenador">Coordenador:</label>
        <select name="id_coordenador" id="id_coordenador" required>
            <option value="">Selecione um coordenador</option>
            @foreach ($coordenadores as $coordenador)
                <option value="{{ $coordenador->id }}" {{ $turma->id_coordenador == $coordenador->id ? 'selected' : '' }}>
                    {{ $coordenador->nome }}
                </option>
            @endforeach
        </select>
        <br>
        <label for="id_professor">Professor:</label>
        <select name="id_professor" id="id_professor" required>
            <option value="">Selecione um professor</option>
            @foreach ($professores as $professor)
                <option value="{{ $professor->id }}" {{ $turma->id_professor == $professor->id ? 'selected' : '' }}>
                    {{ $professor->nome }}
                </option>
            @endforeach
        </select>
        <br>
        <label for="id_aluno">Aluno:</label>
        <select name="id_aluno" id="id_aluno" required>
            <option value="">Selecione um aluno</option>
            @foreach ($alunos as $aluno)
                <option value="{{ $aluno->id }}" {{ $turma->id_aluno == $aluno->id ? 'selected' : '' }}>
                    {{ $aluno->nome }}
                </option>
            @endforeach
        </select>
        <br>
        <button type="submit">Atualizar</button>
    </form>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>