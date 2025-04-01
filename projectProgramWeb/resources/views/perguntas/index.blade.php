@extends('layouts.app')

@section('title', 'Lista de Questionários')

@section('content')
<div class="container">
    <h1>Lista de Questionários</h1>
    <a href="{{ route('perguntas.create') }}">Criar Novo Questionário</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Turma</th>
                <th>Pergunta 1</th>
                <th>Pergunta 2</th>
                <th>Pergunta 3</th>
                <th>Decisão do Coordenador</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($perguntas as $pergunta)
            <tr>
                <td>{{ $pergunta->id }}</td>
                <td>{{ $pergunta->turma }}</td>
                <td>{{ $pergunta->pergunta1 }}</td>
                <td>{{ $pergunta->pergunta2 }}</td>
                <td>{{ $pergunta->pergunta3 }}</td>
                <td>{{ $pergunta->pergunta4 }}</td>
                <td>{{ $pergunta->pergunta5 }}</td>
                <td>{{ $pergunta->pergunta6 }}</td>
                <td>{{ ucfirst($pergunta->aprovacao) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection