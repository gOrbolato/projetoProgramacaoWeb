@extends('layouts.app')

@section('title, 'Lista de Alunos')

@section('content')
    <h1>Lista de Alunos</h1>
    <a href="{{ route('alunos.create') }}">Criar Novo Aluno</a>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Ano Letivo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alunos as $aluno)
                <tr>
                    <td>{{ $aluno->name }}</td>
                    <td>{{ $aluno->idade }}</td>
                    <td>{{ $aluno->cpf }}</td>
                    <td>{{ $aluno->telefone }}</td>
                    <td>{{ $aluno->ano_letivo }}</td>
                    <td>
                        <a href="{{ route('alunos.edit', $aluno->id) }}">Editar</a>
                        <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script src="{{ asset('js/scripts.js') }}"></script>
@endsection