@extends('layouts.app')

@section('title', 'Editar Formulário de Avaliação')

@section('content')
    <h1>Editar Formulário de Avaliação</h1>

    <form action="{{ route('form_avaliacao.update', $form_avaliacao->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="id_turma">Turma:</label>
        <select name="id_turma" id="id_turma" required class="form-control">
            <option value="">Selecione uma turma</option>
            @foreach ($turmas as $turma)
                <option value="{{ $turma->id }}" {{ $form_avaliacao->id_turma == $turma->id ? 'selected' : '' }}>
                    {{ $turma->nome_turma }}
                </option>
            @endforeach
        </select>
        <br>
        <label for="id_pergunta">Pergunta:</label>
        <select name="id_pergunta" id="id_pergunta" required class="form-control">
            <option value="">Selecione uma pergunta</option>
            @foreach ($perguntas as $pergunta)
                <option value="{{ $pergunta->id }}" {{ $form_avaliacao->id_pergunta == $pergunta->id ? 'selected' : '' }}>
                    {{ $pergunta->nome_pergunta }}
                </option>
            @endforeach
        </select>
        <br>
        <label for="aval_coordenador">Avaliação do Coordenador:</label>
        <select name="aval_coordenador" id="aval_coordenador" required class="form-control">
            <option value="1" {{ $form_avaliacao->aval_coordenador ? 'selected' : '' }}>Sim</option>
            <option value="0" {{ !$form_avaliacao->aval_coordenador ? 'selected' : '' }}>Não</option>
        </select>
        <br>
        <label for="reenviado">Reenviado:</label>
        <select name="reenviado" id="reenviado" required class="form-control">
            <option value="1" {{ $form_avaliacao->reenviado ? 'selected' : '' }}>Sim</option>
            <option value="0" {{ !$form_avaliacao->reenviado ? 'selected' : '' }}>Não</option>
        </select>
        <br>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
@endsection