@extends('layouts.app')

@section('title', 'Lista de Alunos')

@section('content')
    <div class="text-center mb-5">
        <h1>Lista de Alunos</h1>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
            <a href="{{ route('alunos.create') }}" class="btn btn-purple">
                <i class="fas fa-plus me-2"></i>Criar Novo Aluno
            </a>
        </div>
    </div>

    <div class="row g-4 justify-content-center" id="alunos-container">
        @forelse ($alunos as $aluno)
            <div class="col-md-6 col-lg-4" id="aluno-{{ $aluno->id }}"
                 data-created="{{ session('created') == $aluno->id ? 'true' : 'false' }}"
                 data-edited="{{ session('edited') == $aluno->id ? 'true' : 'false' }}">
                <div class="card shadow-sm h-100 d-flex flex-column justify-content-between p-3">
                    <div>
                        <h5 class="card-title">{{ $aluno->name }}</h5>
                        <p class="card-text text-muted small">
                            <i class="fas fa-user me-2"></i>{{ $aluno->idade }} anos
                        </p>
                        <p class="card-text text-muted small">
                            <i class="fas fa-phone me-2"></i>{{ $aluno->telefone }}
                        </p>
                        <p class="card-text text-muted small">
                            <i class="fas fa-calendar-alt me-2"></i>Ano Letivo: {{ $aluno->ano_letivo }}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <a href="{{ route('alunos.edit', $aluno->id) }}" class="btn btn-outline-purple btn-sm">
                            <i class="fas fa-edit me-2"></i>Editar
                        </a>
                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-id="{{ $aluno->id }}"
                                data-nome="{{ $aluno->name }}">
                            <i class="fas fa-trash-alt me-2"></i>Excluir
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state text-center py-5">
                <i class="fas fa-users fa-5x text-muted empty-icon"></i>
                <h4 class="mt-3 text-muted">Nenhum aluno por aqui...</h4>
                <p class="text-muted">Que tal adicionar um novo aluno agora?</p>
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
                    Tem certeza que deseja excluir o aluno "<strong id="aluno-nome"></strong>"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete">Confirmar Exclusão</button>
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

    <!-- Script para animações e exclusão assíncrona -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Animação para alunos recém-criados
            document.querySelectorAll('[data-created="true"]').forEach(card => {
                card.querySelector('.card').classList.add('card-created');
            });

            // Animação para alunos editados
            document.querySelectorAll('[data-edited="true"]').forEach(card => {
                card.querySelector('.card').classList.add('card-edited');
            });

            // Configuração do modal de exclusão
            let alunoIdToDelete = null;
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                alunoIdToDelete = button.getAttribute('data-id');
                const alunoNome = button.getAttribute('data-nome');
                document.getElementById('aluno-nome').textContent = alunoNome;
            });

            // Exclusão assíncrona
            document.getElementById('confirm-delete').addEventListener('click', function () {
                const card = document.getElementById('aluno-' + alunoIdToDelete);
                if (!card) {
                    console.error('Card não encontrado para ID: ' + alunoIdToDelete);
                    return;
                }
                const cardElement = card.querySelector('.card');

                // Aplica a animação de exclusão
                cardElement.classList.add('card-deleted');

                // Aguarda a animação terminar
                cardElement.addEventListener('animationend', function () {
                    // Requisição AJAX para excluir o aluno
                    fetch("{{ route('alunos.destroy', '') }}/" + alunoIdToDelete, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Erro ao excluir o aluno');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Remove o card da DOM
                            card.remove();
                            // Fecha o modal
                            const modal = bootstrap.Modal.getInstance(deleteModal);
                            modal.hide();
                        })
                        .catch(error => {
                            console.error('Erro:', error);
                            // Reverte a animação em caso de erro
                            cardElement.classList.remove('card-deleted');
                            alert('Erro ao excluir o aluno. Tente novamente.');
                        });
                }, { once: true });
            });
        });
    </script>
@endsection
