<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header>
        <h1>Meu Sistema</h1>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2023 Meu Sistema</p>
    </footer>
</body>
</html>