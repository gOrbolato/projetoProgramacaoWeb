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
        @if ($perguntas->isEmpty())
            <div class="col-md-8 text-center">
                <div class="alert alert-info" role="alert">
                    Nenhuma pergunta encontrada. Crie sua primeira pergunta!
                </div>
            </div>
        @else
            @foreach ($perguntas as $pergunta)
                <div class="col-md-6 col-lg-4" id="pergunta-{{ $pergunta->id }}">
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
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $pergunta->id }}">
                                <i class="fas fa-trash-alt me-2"></i>Excluir
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal de Confirmação -->
                <div class="modal fade" id="deleteModal-{{ $pergunta->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Tem certeza que deseja excluir a pergunta "<strong>{{ $pergunta->nome_pergunta }}</strong>"?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="{{ route('perguntas.destroy', $pergunta->id) }}" method="POST" onsubmit="handleDelete(event, {{ $pergunta->id }})">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Script para Animação de Exclusão -->
    <script>
        function handleDelete(event, perguntaId) {
            event.preventDefault(); // Impede o envio do formulário imediatamente

            const card = document.getElementById(`pergunta-${perguntaId}`);
            // Adiciona animação de fade-out
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.9)';

            // Aguarda a animação terminar antes de enviar o formulário
            setTimeout(() => {
                event.target.submit(); // Envia o formulário após a animação
            }, 500); // 500ms corresponde à duração da animação
        }
    </script>
@endsection
