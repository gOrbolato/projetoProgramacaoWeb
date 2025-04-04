@extends('layouts.app')

@section('title', 'Lista de Professores')

@section('content')
    <div class="text-center mb-5">
        <h1>Lista de Professores</h1>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
            <a href="{{ route('professores.create') }}" class="btn btn-purple">
                <i class="fas fa-plus me-2"></i>Criar Novo Professor
            </a>
        </div>
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

    <div class="row g-4 justify-content-center" id="professores-container">
        @if ($professores->isEmpty())
            <div class="col-md-8 text-center">
                <div class="alert alert-info" role="alert">
                    Nenhum professor encontrado. Crie seu primeiro professor!
                </div>
            </div>
        @else
            @foreach ($professores as $professor)
                <div class="col-md-6 col-lg-4" id="professor-{{ $professor->id }}">
                    <div class="card shadow-sm h-100 d-flex flex-column justify-content-between p-3">
                        <div>
                            <h5 class="card-title">{{ $professor->nome }}</h5>
                            <p class="card-text text-muted small">
                                <i class="fas fa-user me-2"></i>{{ $professor->idade }} anos
                            </p>
                            <p class="card-text text-muted small">
                                <i class="fas fa-phone me-2"></i>{{ $professor->telefone }}
                            </p>
                            <p class="card-text text-muted small">
                                <i class="fas fa-user-tie me-2"></i>Coordenador: {{ $professor->coordenadore?->nome ?? 'Sem Coordenador' }}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="{{ route('professores.edit', $professor->id) }}" class="btn btn-outline-purple btn-sm">
                                <i class="fas fa-edit me-2"></i>Editar
                            </a>
                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                data-id="{{ $professor->id }}" data-nome="{{ $professor->nome }}">
                                <i class="fas fa-trash-alt me-2"></i>Excluir
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Modal de Confirmação -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir o professor "<strong id="professor-nome"></strong>"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para Animação de Exclusão -->
    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const professorId = this.dataset.id;
                const professorNome = this.dataset.nome;

                // Atualiza o modal com as informações do professor
                document.getElementById('professor-nome').textContent = professorNome;
                document.getElementById('delete-form').action = `/professores/${professorId}`;
            });
        });

        function handleDelete(event, professorId) {
            event.preventDefault(); // Impede o envio do formulário imediatamente

            const card = document.getElementById(`professor-${professorId}`);
            if (!card) {
                console.error(`Card com ID professor-${professorId} não encontrado.`);
                return;
            }

            // Adiciona animação de fade-out
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.9)';

            // Aguarda a animação terminar antes de enviar o formulário
            setTimeout(() => {
                event.target.submit(); // Envia o formulário após a animação
            }, 500); // 500ms corresponde à duração da animação
            return false;
        }
    </script>
@endsection