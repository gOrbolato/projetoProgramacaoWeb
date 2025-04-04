@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')
    <div class="text-center mb-5">
        <h2>Bem-vindo ao Painel Administrativo</h2>
        <p class="lead">Selecione uma das opções abaixo para gerenciar os recursos:</p>
    </div>

    <div class="row justify-content-center">
        <!-- Card para Gerenciar Alunos -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('alunos.index') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm h-100 d-flex flex-column align-items-center justify-content-center p-4">
                    <i class="fas fa-users card-icon"></i>
                    <h5 class="card-title">Gerenciar Alunos</h5>
                    <p class="card-text">Cadastre, edite e visualize informações dos alunos.</p>
                </div>
            </a>
        </div>

        <!-- Card para Gerenciar Professores -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('professores.index') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm h-100 d-flex flex-column align-items-center justify-content-center p-4">
                    <i class="fas fa-chalkboard-teacher card-icon"></i>
                    <h5 class="card-title">Gerenciar Professores</h5>
                    <p class="card-text">Gerencie os dados dos professores do sistema.</p>
                </div>
            </a>
        </div>

        <!-- Card para Gerenciar Coordenadores -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('coordenadores.index') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm h-100 d-flex flex-column align-items-center justify-content-center p-4">
                    <i class="fas fa-user-tie card-icon"></i>
                    <h5 class="card-title">Gerenciar Coordenadores</h5>
                    <p class="card-text">Controle os coordenadores do sistema escolar.</p>
                </div>
            </a>
        </div>

        <!-- Card para Gerenciar Turmas -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('turmas.index') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm h-100 d-flex flex-column align-items-center justify-content-center p-4">
                    <i class="fas fa-school card-icon"></i>
                    <h5 class="card-title">Gerenciar Turmas</h5>
                    <p class="card-text">Organize turmas e seus respectivos alunos.</p>
                </div>
            </a>
        </div>

        <!-- Card para Gerenciar Perguntas -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('perguntas.index') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm h-100 d-flex flex-column align-items-center justify-content-center p-4">
                    <i class="fas fa-question-circle card-icon"></i>
                    <h5 class="card-title">Gerenciar Perguntas</h5>
                    <p class="card-text">Crie e edite perguntas para avaliações.</p>
                </div>
            </a>
        </div>

        <!-- Card para Gerenciar Formulários de Avaliação -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('form-avaliacao.index') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm h-100 d-flex flex-column align-items-center justify-content-center p-4">
                    <i class="fas fa-clipboard-list card-icon"></i>
                    <h5 class="card-title">Gerenciar Formulários de Avaliação</h5>
                    <p class="card-text">Gerencie formulários usados para avaliações.</p>
                </div>
            </a>
        </div>
    </div>
@endsection
