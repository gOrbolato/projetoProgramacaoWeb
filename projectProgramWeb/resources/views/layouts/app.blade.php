<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema Escolar')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('alunos.index') }}">Alunos</a></li>
                <li><a href="{{ route('professores.index') }}">Professores</a></li>
                <li><a href="{{ route('coordenadores.index') }}">Coordenadores</a></li>
                <li><a href="{{ route('perguntas.index') }}">Perguntas</a></li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2023 Sistema Escolar</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>