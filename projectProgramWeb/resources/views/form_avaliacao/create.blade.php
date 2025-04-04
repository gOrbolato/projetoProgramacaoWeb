@extends('layouts.app')

@section('title', 'Criar Novo Formulário de Avaliação')

@section('content')
    <div class="text-center mb-5">
        <h1>Criar Novo Formulário de Avaliação</h1>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
            <p class="lead">Preencha os campos abaixo para adicionar um novo formulário de avaliação ao sistema.</p>
        </div>

        <!-- Feedback de Sucesso ou Erro -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm p-4">
                <form action="{{ route('form_avaliacao.store') }}" method="POST" id="create-form-avaliacao-form">
                    @csrf

                    <!-- Campo Turma -->
                    <div class="mb-3">
                        <label for="id_turma" class="form-label">Turma</label>
                        <select name="id_turma" id="id_turma" class="form-select" required>
                            <option value="">Selecione uma turma</option>
                            @foreach ($turmas as $turma)
                                <option value="{{ $turma->id }}">{{ $turma->nome_turma }}</option>
                            @endforeach
                        </select>
                        @error('id_turma')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo Pergunta -->
                    <div class="mb-3">
                        <label for="id_pergunta" class="form-label">Pergunta</label>
                        <select name="id_pergunta" id="id_pergunta" class="form-select" required>
                            <option value="">Selecione uma pergunta</option>
                            @foreach ($perguntas as $pergunta)
                                <option value="{{ $pergunta->id }}">{{ $pergunta->nome_pergunta }}</option>
                            @endforeach
                        </select>
                        @error('id_pergunta')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo Avaliação do Coordenador -->
                    <div class="mb-3">
                        <label for="aval_coordenador" class="form-label">Avaliação do Coordenador</label>
                        <select name="aval_coordenador" id="aval_coordenador" class="form-select" required>
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                        @error('aval_coordenador')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo Reenviado -->
                    <div class="mb-3">
                        <label for="reenviado" class="form-label">Reenviado</label>
                        <select name="reenviado" id="reenviado" class="form-select" required>
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                        @error('reenviado')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Botão Salvar -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-purple" id="save-button">
                            <i class="fas fa-save me-2"></i>Salvar Formulário de Avaliação
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script para Animações -->
    <script>
        document.getElementById('create-form-avaliacao-form').addEventListener('submit', function (event) {
            const button = document.getElementById('save-button');
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Salvando...';
            button.disabled = true;

            // Após 1 segundo (simulando delay), reativa o botão (isso pode ser ajustado conforme necessário)
            setTimeout(() => {
                button.innerHTML = '<i class="fas fa-save me-2"></i>Salvar Formulário de Avaliação';
                button.disabled = false;
            }, 1000);
        });
    </script>
@endsection