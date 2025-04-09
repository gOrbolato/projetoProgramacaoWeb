@extends('layouts.app')

@section('title', 'Lista de Coordenadores')

@section('content')
    <div class="text-center mb-5">
        <h1>Lista de Coordenadores</h1>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
            <a href="{{ route('coordenadores.create') }}" class="btn btn-purple">
                <i class="fas fa-plus me-2"></i>Criar Novo Coordenador
            </a>
        </div>
    </div>

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4 justify-content-center" id="coordenadores-container">
        @if ($coordenadores->isEmpty())
            <div class="col-md-8 text-center">
                <div class="alert alert-info" role="alert">
                    Nenhum coordenador encontrado. Crie seu primeiro coordenador!
                </div>
            </div>
        @else
            @foreach ($coordenadores as $coordenador)
                <div class="col-md-6 col-lg-4" id="coordenador-{{ $coordenador->id }}">
                    <div class="card shadow-sm h-100 d-flex flex-column justify-content-between p-3">
                        <div>
                            <h5 class="card-title">{{ $coordenador->nome }}</h5>
                            <p class="card-text text-muted small">
                                <i class="fas fa-user me-2"></i>{{ $coordenador->idade }} anos
                            </p>
                            <p class="card-text text-muted small">
                                <i class="fas fa-phone me-2"></i>{{ $coordenador->telefone }}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="{{ route('coordenadores.edit', $coordenador->id) }}" class="btn btn-outline-purple btn-sm">
                                <i class="fas fa-edit me-2"></i>Editar
                            </a>
                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    data-id="{{ $coordenador->id }}" data-nome="{{ $coordenador->nome }}">
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
                    Tem certeza que deseja excluir o coordenador "<strong id="coordenador-nome"></strong>"?
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
                const coordenadorId = this.dataset.id;
                const coordenadorNome = this.dataset.nome;
                document.getElementById('coordenador-nome').textContent = coordenadorNome;
                document.getElementById('delete-form').action = `/coordenadores/${coordenadorId}`;
                document.getElementById('delete-form').dataset.id = coordenadorId; // Armazena o ID no formulário
            });
        });

        function handleDelete(event, coordenadorId) {
            event.preventDefault();
            const card = document.getElementById(`coordenador-${coordenadorId}`);
            if (!card) {
                console.error(`Card com ID coordenador-${coordenadorId} não encontrado.`);
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
