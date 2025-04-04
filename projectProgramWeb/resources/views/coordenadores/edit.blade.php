@extends('layouts.app')

@section('title', 'Editar Coordenador')

@section('content')
    <div class="text-center mb-5">
        <h1>Editar Coordenador</h1>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('coordenadores.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
            <p class="lead">Edite os campos abaixo para atualizar o coordenador no sistema.</p>
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
                <form action="{{ route('coordenadores.update', $coordenador->id) }}" method="POST" id="edit-coordenador-form">
                    @csrf
                    @method('PUT')

                    <!-- Campo Nome do Coordenador -->
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Coordenador</label>
                        <input type="text" name="nome" id="nome" class="form-control" placeholder="Ex: Maria Silva" value="{{ old('nome', $coordenador->nome) }}" required>
                        @error('nome')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo Idade do Coordenador -->
                    <div class="mb-3">
                        <label for="idade" class="form-label">Idade</label>
                        <input type="number" name="idade" id="idade" class="form-control" placeholder="Ex: 35" value="{{ old('idade', $coordenador->idade) }}" required>
                        @error('idade')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo CPF do Coordenador -->
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" placeholder="Ex: 123.456.789-00" value="{{ old('cpf', $coordenador->cpf) }}" required>
                        @error('cpf')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo Telefone do Coordenador -->
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-control" placeholder="Ex: (11) 99999-9999" value="{{ old('telefone', $coordenador->telefone) }}" required>
                        @error('telefone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Botão Atualizar -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-purple" id="save-button">
                            <i class="fas fa-save me-2"></i>Atualizar Coordenador
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script para Animações -->
    <script>
        document.getElementById('edit-coordenador-form').addEventListener('submit', function (event) {
            const button = document.getElementById('save-button');
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Atualizando...';
            button.disabled = true;

            // Após 1 segundo (simulando delay), reativa o botão (isso pode ser ajustado conforme necessário)
            setTimeout(() => {
                button.innerHTML = '<i class="fas fa-save me-2"></i>Atualizar Coordenador';
                button.disabled = false;
            }, 1000);
        });
    </script>
@endsection