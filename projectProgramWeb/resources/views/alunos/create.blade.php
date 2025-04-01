@extends('layouts.app')

@section('title', 'Cadastrar Aluno')

@section('content')
<div class="container">
    <h1>{{ $aluno ? 'Editar Aluno' : 'Cadastrar Aluno' }}</h1>
    <form action="{{ route('alunos.store') }}" method="POST">
        @csrf

        <!-- Campo ID -->
        <div>
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" value="{{ $aluno?->id ?? '' }}" placeholder="Não é necessário preencher esse campo. Obrigado.">
        </div>

        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $aluno?->nome) }}" required>
        </div>

        <div>
            <label for="idade">Idade:</label>
            <input type="number" name="idade" id="idade" value="{{ old('idade', $aluno?->idade) }}" min="0" required>
        </div>

        <div>
            <label for="telefone">Telefone:</label>
            <input type="tel" name="telefone" id="telefone" value="{{ old('telefone', $aluno?->telefone) }}" placeholder="(99) 99999-9999" required>
        </div>

        <div>
            <label for="turma_id">Turma (ID):</label>
            <input type="text" name="turma_id" id="turma_id" value="{{ old('turma_id', $aluno?->turma_id) }}" readonly>
        </div>

        <div>
            <label for="ano_letivo">Ano Letivo:</label>
            <select name="ano_letivo" id="ano_letivo" required>
                <option value="">Selecione o Ano Letivo</option>
                <option value="2019" {{ old('ano_letivo', $aluno?->ano_letivo) == '2019' ? 'selected' : '' }}>2019</option>
                <option value="2020" {{ old('ano_letivo', $aluno?->ano_letivo) == '2020' ? 'selected' : '' }}>2020</option>
                <option value="2021" {{ old('ano_letivo', $aluno?->ano_letivo) == '2021' ? 'selected' : '' }}>2021</option>
                <option value="2022" {{ old('ano_letivo', $aluno?->ano_letivo) == '2022' ? 'selected' : '' }}>2022</option>
                <option value="2023" {{ old('ano_letivo', $aluno?->ano_letivo) == '2023' ? 'selected' : '' }}>2023</option>
                <option value="2024" {{ old('ano_letivo', $aluno?->ano_letivo) == '2024' ? 'selected' : '' }}>2024</option>
                <option value="2025" {{ old('ano_letivo', $aluno?->ano_letivo) == '2025' ? 'selected' : '' }}>2025</option>
            </select>
        </div>

        <button type="submit">{{ $aluno ? 'Atualizar' : 'Salvar' }}</button>
    </form>
</div>
@endsection