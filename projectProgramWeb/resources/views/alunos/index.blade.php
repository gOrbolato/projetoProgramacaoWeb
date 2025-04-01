@extends('layouts.app')

@section('title', 'Lista de Alunos')

@section('content')
<div class="container">
    <h1>Lista de Alunos</h1>
    <a href="{{ route('alunos.create') }}" class="btn-add">Cadastrar Novo Aluno</a>

    <table class="responsive-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Idade</th>
                <th>Telefone</th>
                <th>Turma (ID)</th>
                <th>Ano Letivo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alunos as $aluno)
            <tr>
                <td>{{ $aluno->id }}</td>
                <td>{{ $aluno->nome }}</td>
                <td>{{ $aluno->idade }}</td>
                <td>{{ $aluno->telefone }}</td>
                <td>{{ $aluno->turma_id }}</td>
                <td>{{ $aluno->ano_letivo }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection