@extends('layouts.app')

@section('title', 'Lista de Perguntas')

@section('content')
    <div class="text-center mb-5">
        <h1>Lista de Perguntas</h1>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
            <a href="{{ route('perguntas.create') }}" class="btn btn-purple">
                <i class="fas fa-plus me-2"></i>Criar Nova Pergunta
            </a>
        </div>
    </div>

    <div class="row g-4 justify-content-center" id="perguntas-container">
        @forelse ($perguntas as $pergunta)
            <div class="col-md-6 col-lg-4" id="pergunta-{{ $pergunta->id }}"
                 data-created="{{ session('created') == $pergunta->id ? 'true' : 'false' }}"
                 data-edited="{{ session('edited') == $pergunta->id ? 'true' : 'false' }}">
                <div class="card shadow-sm h-100 d-flex flex-column justify-content-between p-3">
                    <div>
                        <h5 class="card-title">{{ $pergunta->nome_pergunta }}</h5>
                        <p class="card-text text-muted small">
                            <i class="fas fa-tag me-2"></i>{{ ucfirst($pergunta->tipo_pergunta) }}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <a href="{{ route('perguntas.edit', $pergunta->id) }}" class="btn btn-outline-purple btn-sm">
                            <i class="fas fa-edit me-2"></i>Editar
                        </a>
                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-id="{{ $pergunta->id }}"
                                data-nome="{{ $pergunta->nome_pergunta }}">
                            <i class="fas fa-trash-alt me-2"></i>Excluir
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state text-center py-5">
                <i class="fas fa-question-circle fa-5x text-muted empty-icon"></i>
                <h4 class="mt-3 text-muted">Nenhuma pergunta por aqui...</h4>
                <p class="text-muted">Que tal criar uma nova pergunta agora?</p>
            </div>
        @endforelse
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
                    Tem certeza que deseja excluir a pergunta "<strong id="pergunta-nome"></strong>"?
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

    <!-- CSS para animações -->
    <style>
        .empty-state {
            animation: fadeIn 1s ease-in-out;
        }

        .empty-icon {
            animation: pulse 2s infinite;
        }

        .card-created {
            animation: fadeInCard 0.5s ease-in-out;
        }

        .card-edited {
            animation: highlightCard 1s ease-in-out;
        }

        .card-deleted {
            animation: fadeOutCard 0.5s ease-in-out forwards;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes fadeInCard {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes highlightCard {
            0% { background-color: #fff; }
            50% { background-color: #e0f7fa; }
            100% { background-color: #fff; }
        }

        @keyframes fadeOutCard {
            0% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(20px); }
        }
    </style>

    <!-- Script para animações e modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Animação para perguntas recém-criadas
            document.querySelectorAll('[data-created="true"]').forEach(card => {
                card.querySelector('.card').classList.add('card-created');
            });

            // Animação para perguntas editadas
            document.querySelectorAll('[data-edited="true"]').forEach(card => {
                card.querySelector('.card').classList.add('card-edited');
            });

            // Configuração do modal de exclusão
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const perguntaId = button.getAttribute('data-id');
                const perguntaNome = button.getAttribute('data-nome');

                const modalTitle = deleteModal.querySelector('#pergunta-nome');
                const deleteForm = deleteModal.querySelector('#delete-form');

                modalTitle.textContent = perguntaNome;
                deleteForm.action = "{{ route('perguntas.destroy', '') }}/" + perguntaId;
            });

            // Animação de exclusão
            const deleteForm = document.getElementById('delete-form');
            deleteForm.addEventListener('submit', function (event) {
                event.preventDefault();
                const perguntaId = deleteForm.action.split('/').pop();
                const card = document.getElementById('pergunta-' + perguntaId);
                const cardElement = card.querySelector('.card');

                cardElement.classList.add('card-deleted');
                cardElement.addEventListener('animationend', function () {
                    deleteForm.submit(); // Submete o formulário após a animação
                });
            });
        });
    </script>
@endsection
