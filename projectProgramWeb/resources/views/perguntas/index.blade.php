<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Perguntas</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Lista de Perguntas</h1>
    <a href="{{ route('perguntas.create') }}">Criar Nova Pergunta</a>

    <ul>
        @foreach ($perguntas as $pergunta)
            <li>
                {{ $pergunta->titulo }}
                <a href="{{ route('perguntas.edit', $pergunta->id) }}">Editar</a>
                <form action="{{ route('perguntas.destroy', $pergunta->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>