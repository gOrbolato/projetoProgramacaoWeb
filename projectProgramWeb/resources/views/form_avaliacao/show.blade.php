@extends('layouts.app')

@section('title', 'Detalhes do Formulário de Avaliação')

@section('content')
    <h1>Detalhes do Formulário de Avaliação</h1>

    <p><strong>Turma:</strong> {{ $form_avaliacao->turma?->nome_turma ?? 'Sem Turma' }}</p>
    <p><strong>Pergunta:</strong> {{ $form_avaliacao->pergunta?->nome_pergunta ?? 'Sem Pergunta' }}</p>
    <p><strong>Avaliação do Coordenador:</strong> {{ $form_avaliacao->aval_coordenador ? 'Sim' : 'Não' }}</p>
    <p><strong>Reenviado:</strong> {{ $form_avaliacao->reenviado ? 'Sim' : 'Não' }}</p>

    <a href="{{ route('form_avaliacao.index') }}" class="btn btn-secondary">Voltar</a>
@endsection