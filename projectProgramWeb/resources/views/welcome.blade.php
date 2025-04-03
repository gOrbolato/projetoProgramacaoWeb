<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')
    <h1>Bem-vindo ao Sistema Escolar</h1>
    <p>Selecione uma das opções abaixo para gerenciar os recursos:</p>

    <div class="menu">
        <ul>
            <li><a href="{{ route('alunos.index') }}">Gerenciar Alunos</a></li>
            <li><a href="{{ route('professores.index') }}">Gerenciar Professores</a></li>
            <li><a href="{{ route('coordenadores.index') }}">Gerenciar Coordenadores</a></li>
            <li><a href="{{ route('turmas.index') }}">Gerenciar Turmas</a></li>
            <li><a href="{{ route('perguntas.index') }}">Gerenciar Perguntas</a></li>
            <li><a href="{{ route('form-avaliacao.index') }}">Gerenciar Formulários de Avaliação</a></li>
        </ul>
    </div>
@endsection