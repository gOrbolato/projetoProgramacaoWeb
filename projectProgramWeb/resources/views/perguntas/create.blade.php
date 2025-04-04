@extends('layouts.app')

@section('title', 'Criar Nova Pergunta')

@section('content')
    <div class="text-center mb-5">
        <h1>Criar Nova Pergunta</h1>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
            <p class="lead">Preencha os campos abaixo para adicionar uma nova pergunta ao sistema.</p>
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
                <form action="{{ route('perguntas.store') }}" method="POST" id="create-pergunta-form">
                    @csrf

                    <!-- Campo Nome da Pergunta -->
                    <div class="mb-3">
                        <label for="nome_pergunta" class="form-label">Nome da Pergunta</label>
                        <input type="text" name="nome_pergunta" id="nome_pergunta" class="form-control" placeholder="Ex: Qual é a capital do Brasil?" value="{{ old('nome_pergunta') }}" required>
                        @error('nome_pergunta')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo Tipo da Pergunta -->
                    <div class="mb-3">
                        <label for="tipo_pergunta" class="form-label">Tipo da Pergunta</label>
                        <select name="tipo_pergunta" id="tipo_pergunta" class="form-select" required>
                            <option value="texto" {{ old('tipo_pergunta') == 'texto' ? 'selected' : '' }}>Texto</option>
                            <option value="multipla-escolha" {{ old('tipo_pergunta') == 'multipla-escolha' ? 'selected' : '' }}>Múltipla Escolha</option>
                            <option value="verdadeiro-falso" {{ old('tipo_pergunta') == 'verdadeiro-falso' ? 'selected' : '' }}>Verdadeiro/Falso</option>
                        </select>
                        @error('tipo_pergunta')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Botão Salvar -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-purple" id="save-button">
                            <i class="fas fa-save me-2"></i>Salvar Pergunta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script para Animações -->
    <script>
        document.getElementById('create-pergunta-form').addEventListener('submit', function (event) {
            const button = document.getElementById('save-button');
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Salvando...';
            button.disabled = true;

            // Após 1 segundo (simulando delay), reativa o botão (isso pode ser ajustado conforme necessário)
            setTimeout(() => {
                button.innerHTML = '<i class="fas fa-save me-2"></i>Salvar Pergunta';
                button.disabled = false;
            }, 1000);
        });
    </script>
@endsection
