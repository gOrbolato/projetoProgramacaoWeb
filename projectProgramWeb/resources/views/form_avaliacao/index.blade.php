@extends('layouts.app')

@section('title', 'Lista de Formulários de Avaliação')

@section('content')
    <h1>Lista de Formulários de Avaliação</h1>
    <a href="{{ route('form_avaliacao.create') }}" class="btn btn-primary">Criar Novo Formulário</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Turma</th>
                <th>Pergunta</th>
                <th>Avaliação do Coordenador</th>
                <th>Reenviado</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($form_avaliacoes as $form)
                <tr>
                    <td>{{ $form->turma?->nome_turma ?? 'Sem Turma' }}</td>
                    <td>{{ $form->pergunta?->nome_pergunta ?? 'Sem Pergunta' }}</td>
                    <td>{{ $form->aval_coordenador ? 'Sim' : 'Não' }}</td>
                    <td>{{ $form->reenviado ? 'Sim' : 'Não' }}</td>
                    <td>
                        <a href="{{ route('form_avaliacao.edit', $form->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('form_avaliacao.destroy', $form->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection