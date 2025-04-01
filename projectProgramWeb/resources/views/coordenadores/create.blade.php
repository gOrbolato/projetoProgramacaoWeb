@extends('layouts.app')

@section('title', 'Cadastrar Coordenador')

@section('content')
<div class="container">
    <h1>Cadastrar Coordenador</h1>
    <form action="{{ route('coordenadores.store') }}" method="POST">
        @csrf

        <!-- Campo ID (gerado automaticamente pelo sistema) -->
        <div>
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" value="{{ old('id') ?? 'Gerado Automaticamente' }}" readonly>
        </div>

        <!-- Campo Nome -->
        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required>
        </div>

        <!-- Campo Idade -->
        <div>
            <label for="idade">Idade:</label>
            <input type="number" name="idade" id="idade" value="{{ old('idade') }}" min="0" required>
        </div>

        <!-- Campo Telefone -->
        <div>
            <label for="telefone">Telefone:</label>
            <input type="tel" name="telefone" id="telefone" value="{{ old('telefone') }}" placeholder="(99) 99999-9999" required>
        </div>

        <!-- Campo Departamento -->
        <div>
            <label for="departamento">Departamento:</label>
            <input type="text" name="departamento" id="departamento" value="{{ old('departamento') }}" required>
        </div>

        <!-- Botão de Envio -->
        <button type="submit">Salvar</button>
    </form>
</div>
@endsection