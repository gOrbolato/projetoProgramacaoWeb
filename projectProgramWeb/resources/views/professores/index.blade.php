@extends('layouts.app')

@section('title', 'Lista de Professores')

@section('content')
<div class="container">
    <h1>Lista de Professores</h1>
    <a href="{{ route('professores.create') }}">Cadastrar Novo Professor</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Idade</th>
                <th>Telefone</th>
                <th>Disciplina</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($professores as $professor)
            <tr>
                <td>{{ $professor->id }}</td>
                <td>{{ $professor->nome }}</td>
                <td>{{ $professor->idade }}</td>
                <td>{{ $professor->telefone }}</td>
                <td>{{ $professor->disciplina }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection