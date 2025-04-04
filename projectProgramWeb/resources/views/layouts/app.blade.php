<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        /* Estilos Globais */
        body {
            background-color: #ffffff; /* Fundo branco */
            color: #333333; /* Texto escuro */
        }
        header {
            background: linear-gradient(135deg, #4a148c, #6a11cb); /* Degradê roxo */
            color: white;
            padding: 20px 0;
            text-align: center;
            font-family: 'Arial', sans-serif;
        }
        footer {
            background-color: #000000; /* Preto sólido */
            color: #cccccc; /* Cinza claro */
            text-align: center;
            padding: 15px 0;
            margin-top: 30px;
        }

        /* Botões e Links */
        .btn-purple {
            background-color: #6a11cb; /* Roxo vibrante */
            color: white;
            border: none;
        }
        .btn-purple:hover {
            background-color: #4a148c; /* Roxo escuro */
        }
        .btn-outline-purple {
            color: #6a11cb; /* Roxo vibrante */
            border: 1px solid #6a11cb;
            background-color: transparent;
        }
        .btn-outline-purple:hover {
            color: white;
            background-color: #6a11cb; /* Roxo vibrante */
        }

        /* Cards */
        .card {
            background-color: #ffffff; /* Fundo branco */
            border: 1px solid #e0e0e0; /* Borda cinza clara */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333333; /* Texto escuro */
        }
        .card-text {
            font-size: 1rem;
            color: #666666; /* Cinza médio */
        }

        /* Alerta de Nenhum Registro */
        .alert-info {
            background-color: #e9ecef; /* Azul claro */
            border: 1px solid #b3d7ff; /* Azul mais claro */
            color: #333333; /* Texto escuro */
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <h1>Meu Sistema Escolar</h1>
        <p class="lead">Gerencie todos os recursos do sistema de forma fácil e eficiente.</p>
    </div>
</header>

<main class="container mt-5">
    @yield('content')
</main>

<footer>
    <div class="container">
        <p>&copy; 2023 Meu Sistema Escolar - Todos os direitos reservados.</p>
    </div>
</footer>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
