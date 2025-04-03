@extends('layouts.app')

@section('title, 'Lista de Perguntas')

@section('content')
    <h1>Lista de Perguntas</h1>
    <a href="{{ route('perguntas.create') }}">Criar Nova Pergunta</a>

    <table>
        <thead>
            <tr>
                <th>Nome da Pergunta</th>
                <th>Tipo da Pergunta</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($perguntas as $pergunta)
                <tr>
                    <td>{{ $pergunta->nome_pergunta }}</td>
                    <td>{{ $pergunta->tipo_pergunta }}</td>
                    <td>
                        <a href="{{ route('perguntas.edit', $pergunta->id) }}">Editar</a>
                        <form action="{{ route('perguntas.destroy', $pergunta->id) }}" method="POST" style="display:inline;">
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