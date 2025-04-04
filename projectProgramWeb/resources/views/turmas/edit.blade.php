@extends('layouts.app')

@section('title', 'Editar Turma')

@section('content')
    <div class="text-center mb-5">
        <h1>Editar Turma</h1>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('turmas.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
            <p class="lead">Edite os campos abaixo para atualizar a turma no sistema.</p>
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
                <form action="{{ route('turmas.update', $turma->id) }}" method="POST" id="edit-turma-form">
                    @csrf
                    @method('PUT')

                    <!-- Campo Nome da Turma -->
                    <div class="mb-3">
                        <label for="nome_turma" class="form-label">Nome da Turma</label>
                        <input type="text" name="nome_turma" id="nome_turma" class="form-control" placeholder="Ex: Turma A - 2023" value="{{ old('nome_turma', $turma->nome_turma) }}" required>
                        @error('nome_turma')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo Coordenador -->
                    <div class="mb-3">
                        <label for="id_coordenador" class="form-label">Coordenador Responsável</label>
                        <select name="id_coordenador" id="id_coordenador" class="form-select" required>
                            <option value="">Selecione um coordenador</option>
                            @foreach ($coordenadores as $coordenador)
                                <option value="{{ $coordenador->id }}" {{ old('id_coordenador', $turma->id_coordenador) == $coordenador->id ? 'selected' : '' }}>
                                    {{ $coordenador->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_coordenador')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo Professor -->
                    <div class="mb-3">
                        <label for="id_professor" class="form-label">Professor Responsável</label>
                        <select name="id_professor" id="id_professor" class="form-select" required>
                            <option value="">Selecione um professor</option>
                            @foreach ($professores as $professor)
                                <option value="{{ $professor->id }}" {{ old('id_professor', $turma->id_professor) == $professor->id ? 'selected' : '' }}>
                                    {{ $professor->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_professor')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo Aluno -->
                    <div class="mb-3">
                        <label for="id_aluno" class="form-label">Aluno</label>
                        <select name="id_aluno" id="id_aluno" class="form-select" required>
                            <option value="">Selecione um aluno</option>
                            @foreach ($alunos as $aluno)
                                <option value="{{ $aluno->id }}" {{ old('id_aluno', $turma->id_aluno) == $aluno->id ? 'selected' : '' }}>
                                    {{ $aluno->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_aluno')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Botão Atualizar -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-purple" id="save-button">
                            <i class="fas fa-save me-2"></i>Atualizar Turma
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script para Animações -->
    <script>
        document.getElementById('edit-turma-form').addEventListener('submit', function (event) {
            const button = document.getElementById('save-button');
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Atualizando...';
            button.disabled = true;

            // Após 1 segundo (simulando delay), reativa o botão (isso pode ser ajustado conforme necessário)
            setTimeout(() => {
                button.innerHTML = '<i class="fas fa-save me-2"></i>Atualizar Turma';
                button.disabled = false;
            }, 1000);
        });
    </script>
@endsection