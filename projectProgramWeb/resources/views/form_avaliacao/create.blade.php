@extends('layouts.app')

@section('title', 'Criar Novo Formulário de Avaliação')

@section('content')
    <h1>Criar Novo Formulário de Avaliação</h1>

    <form action="{{ route('form_avaliacao.store') }}" method="POST">
        @csrf
        <label for="id_turma">Turma:</label>
        <select name="id_turma" id="id_turma" required class="form-control">
            <option value="">Selecione uma turma</option>
            @foreach ($turmas as $turma)
                <option value="{{ $turma->id }}">{{ $turma->nome_turma }}</option>
            @endforeach
        </select>
        <br>
        <label for="id_pergunta">Pergunta:</label>
        <select name="id_pergunta" id="id_pergunta" required class="form-control">
            <option value="">Selecione uma pergunta</option>
            @foreach ($perguntas as $pergunta)
                <option value="{{ $pergunta->id }}">{{ $pergunta->nome_pergunta }}</option>
            @endforeach
        </select>
        <br>
        <label for="aval_coordenador">Avaliação do Coordenador:</label>
        <select name="aval_coordenador" id="aval_coordenador" required class="form-control">
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select>
        <br>
        <label for="reenviado">Reenviado:</label>
        <select name="reenviado" id="reenviado" required class="form-control">
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select>
        <br>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@endsection