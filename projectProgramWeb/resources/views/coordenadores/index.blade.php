@extends('layouts.app')

@section('title, 'Lista de Coordenadores')

@section('content')
    <h1>Lista de Coordenadores</h1>
    <a href="{{ route('coordenadores.create') }}">Criar Novo Coordenador</a>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($coordenadores as $coordenador)
                <tr>
                    <td>{{ $coordenador->nome }}</td>
                    <td>{{ $coordenador->idade }}</td>
                    <td>{{ $coordenador->cpf }}</td>
                    <td>{{ $coordenador->telefone }}</td>
                    <td>
                        <a href="{{ route('coordenadores.edit', $coordenador->id) }}">Editar</a>
                        <form action="{{ route('coordenadores.destroy', $coordenador->id) }}" method="POST" style="display:inline;">
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