@extends('layouts.app')

@section('title, 'Lista de Professores')

@section('content')
    <h1>Lista de Professores</h1>
    <a href="{{ route('professores.create') }}">Criar Novo Professor</a>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Coordenador</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($professores as $professor)
                <tr>
                    <td>{{ $professor->nome }}</td>
                    <td>{{ $professor->idade }}</td>
                    <td>{{ $professor->cpf }}</td>
                    <td>{{ $professor->telefone }}</td>
                    <td>{{ $professor->coordenadore?->nome ?? 'Sem Coordenador' }}</td>
                    <td>
                        <a href="{{ route('professores.edit', $professor->id) }}">Editar</a>
                        <form action="{{ route('professores.destroy', $professor->id) }}" method="POST" style="display:inline;">
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
