@extends('layouts.app')

@section('title', 'Criar Novo Aluno')

@section('content')
    <div class="text-center mb-5">
        <h1>Criar Novo Aluno</h1>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
            <p class="lead">Preencha os campos abaixo para adicionar um novo aluno ao sistema.</p>
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
                <form action="{{ route('alunos.store') }}" method="POST" id="create-aluno-form">
                    @csrf

                    <!-- Campo Nome do Aluno -->
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Aluno</label>
                        <input type="text" name="nome" id="nome" class="form-control" placeholder="Ex: João Silva" value="{{ old('nome') }}" required>
                        @error('nome')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo CPF do Aluno -->
                        <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" placeholder="Ex: 123.456.789-00" value="{{ old('cpf') }}" required>
                        @error('cpf')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo Idade do Aluno -->
                    <div class="mb-3">
                        <label for="idade" class="form-label">Idade</label>
                        <input type="number" name="idade" id="idade" class="form-control" placeholder="Ex: 20" value="{{ old('idade') }}" required>
                        @error('idade')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo Telefone do Aluno -->
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-control" placeholder="Ex: (11) 99999-9999" value="{{ old('telefone') }}" required>
                        @error('telefone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo Ano Letivo -->
                    <div class="mb-3">
                        <label for="ano_letivo" class="form-label">Ano Letivo</label>
                        <input type="number" name="ano_letivo" id="ano_letivo" class="form-control" placeholder="Ex: 2023" value="{{ old('ano_letivo') }}" required>
                        @error('ano_letivo')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Botão Salvar -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-purple" id="save-button">
                            <i class="fas fa-save me-2"></i>Salvar Aluno
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script para Animações -->
    <script>
        document.getElementById('create-aluno-form').addEventListener('submit', function (event) {
            const button = document.getElementById('save-button');
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Salvando...';
            button.disabled = true;

            // Após 1 segundo (simulando delay), reativa o botão (isso pode ser ajustado conforme necessário)
            setTimeout(() => {
                button.innerHTML = '<i class="fas fa-save me-2"></i>Salvar Aluno';
                button.disabled = false;
            }, 1000);
        });
    </script>
@endsection