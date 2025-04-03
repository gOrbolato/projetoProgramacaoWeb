@extends('layouts.app')

@section('title, 'Lista de Turmas')

@section('content')
    <h1>Lista de Turmas</h1>
    <a href="{{ route('turmas.create') }}">Criar Nova Turma</a>

    <table>
        <thead>
            <tr>
                <th>Nome da Turma</th>
                <th>Coordenador</th>
                <th>Professor</th>
                <th>Aluno</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($turmas as $turma)
                <tr>
                    <td>{{ $turma->nome_turma }}</td>
                    <td>{{ $turma->coordenadore?->nome ?? 'Sem Coordenador' }}</td>
                    <td>{{ $turma->professore?->nome ?? 'Sem Professor' }}</td>
                    <td>{{ $turma->aluno?->nome ?? 'Sem Aluno' }}</td>
                    <td>
                        <a href="{{ route('turmas.edit', $turma->id) }}">Editar</a>
                        <form action="{{ route('turmas.destroy', $turma->id) }}" method="POST" style="display:inline;">
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