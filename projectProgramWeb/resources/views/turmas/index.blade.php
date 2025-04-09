@extends('layouts.app')

@section('title', 'Lista de Turmas')

@section('content')
    <div class="text-center mb-5">
        <h1>Lista de Turmas</h1>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
            <a href="{{ route('turmas.create') }}" class="btn btn-purple">
                <i class="fas fa-plus me-2"></i>Criar Nova Turma
            </a>
        </div>
    </div>

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4 justify-content-center" id="turmas-container">
        @if ($turmas->isEmpty())
            <div class="col-md-8 text-center">
                <div class="alert alert-info" role="alert">
                    Nenhuma turma encontrada. Crie sua primeira turma!
                </div>
            </div>
        @else
            @foreach ($turmas as $turma)
                <div class="col-md-6 col-lg-4" id="turma-{{ $turma->id }}">
                    <div class="card shadow-sm h-100 d-flex flex-column justify-content-between p-3">
                        <div>
                            <h5 class="card-title">{{ $turma->nome_turma }}</h5>
                            <p class="card-text text-muted small">
                                <i class="fas fa-user-tie me-2"></i>Coordenador: {{ $turma->coordenadore?->nome ?? 'Sem Coordenador' }}
                            </p>
                            <p class="card-text text-muted small">
                                <i class="fas fa-chalkboard-teacher me-2"></i>Professor: {{ $turma->professore?->nome ?? 'Sem Professor' }}
                            </p>
                            <p class="card-text text-muted small">
                                <i class="fas fa-user-graduate me-2"></i>Aluno: {{ $turma->aluno?->nome ?? 'Sem Aluno' }}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="{{ route('turmas.edit', $turma->id) }}" class="btn btn-outline-purple btn-sm">
                                <i class="fas fa-edit me-2"></i>Editar
                            </a>
                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    data-id="{{ $turma->id }}" data-nome="{{ $turma->nome_turma }}">
                                <i class="fas fa-trash-alt me-2"></i>Excluir
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir a turma "<strong id="turma-nome"></strong>"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="delete-form" method="POST" onsubmit="return handleDelete(event, this.dataset.id)">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const turmaId = this.dataset.id;
                const turmaNome = this.dataset.nome;
                document.getElementById('turma-nome').textContent = turmaNome;
                document.getElementById('delete-form').action = `/turmas/${turmaId}`;
                document.getElementById('delete-form').dataset.id = turmaId; // Armazena o ID no formulário
            });
        });

        function handleDelete(event, turmaId) {
            event.preventDefault();
            const card = document.getElementById(`turma-${turmaId}`);
            if (!card) {
                console.error(`Card com ID turma-${turmaId} não encontrado.`);
                return false;
            }
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.9)';
            setTimeout(() => {
                event.target.submit();
            }, 500);
            return false;
        }
    </script>
@endsection
