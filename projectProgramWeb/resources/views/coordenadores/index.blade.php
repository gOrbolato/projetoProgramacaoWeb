@extends('layouts.app')

@section('title', 'Lista de Coordenadores')

@section('content')
<div class="container">
    <h1>Lista de Coordenadores</h1>
    <a href="{{ route('coordenadores.create') }}">Cadastrar Novo Coordenador</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Idade</th>
                <th>Telefone</th>
                <th>Departamento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($coordenadores as $coordenador)
            <tr>
                <td>{{ $coordenador->id }}</td>
                <td>{{ $coordenador->nome }}</td>
                <td>{{ $coordenador->idade }}</td>
                <td>{{ $coordenador->telefone }}</td>
                <td>{{ $coordenador->departamento }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection