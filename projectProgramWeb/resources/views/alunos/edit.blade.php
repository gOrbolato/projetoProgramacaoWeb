@extends('layouts.app')

@section('title', 'Editar Aluno')

@section('content')
    <div class="text-center mb-5">
        <h1>Editar Aluno</h1>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('alunos.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
            <p class="lead">Edite os campos abaixo para atualizar o aluno no sistema.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm p-4" id="edit-aluno-card">
                <form action="{{ route('alunos.update', $aluno->id) }}" method="POST" id="edit-aluno-form">
                    @csrf
                    @method('PUT')

                    <!-- Campo Nome do Aluno -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Aluno</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Ex: João Silva" value="{{ old('name', $aluno->name) }}" required>
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo CPF do Aluno -->
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" placeholder="Ex: 123.456.789-00" value="{{ old('cpf', $aluno->cpf) }}" required>
                        @error('cpf')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo Idade do Aluno -->
                    <div class="mb-3">
                        <label for="idade" class="form-label">Idade</label>
                        <input type="number" name="idade" id="idade" class="form-control" placeholder="Ex: 20" value="{{ old('idade', $aluno->idade) }}" required>
                        @error('idade')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo Telefone do Aluno -->
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-control" placeholder="Ex: (11) 99999-9999" value="{{ old('telefone', $aluno->telefone) }}" required>
                        @error('telefone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Campo Ano Letivo -->
                    <div class="mb-3">
                        <label for="ano_letivo" class="form-label">Ano Letivo</label>
                        <input type="number" name="ano_letivo" id="ano_letivo" class="form-control" placeholder="Ex: 2023" value="{{ old('ano_letivo', $aluno->ano_letivo) }}" required>
                        @error('ano_letivo')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Botão Atualizar -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-purple" id="update-button">
                            <i class="fas fa-save me-2"></i>Atualizar Aluno
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CSS para animações -->
    <style>
        .form-success {
            animation: highlightForm 1s ease-in-out;
        }

        @keyframes highlightForm {
            0% { background-color: #fff; }
            50% { background-color: #e0f7fa; }
            100% { background-color: #fff; }
        }
    </style>

    <!-- Incluindo IMask.js para máscaras -->
    <script src="https://unpkg.com/imask"></script>

    <!-- Script para máscaras e atualização assíncrona -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cpfInput = document.getElementById('cpf');
            IMask(cpfInput, { mask: '000.000.000-00' });

            const telefoneInput = document.getElementById('telefone');
            IMask(telefoneInput, { mask: '(00) 00000-0000' });

            const form = document.getElementById('edit-aluno-form');
            const button = document.getElementById('update-button');
            const card = document.getElementById('edit-aluno-card');

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Atualizando...';
                button.disabled = true;

                const formData = new FormData(form);
                const cleanedCpf = cpfInput.value.replace(/[\.\-]/g, '');
                const cleanedTelefone = telefoneInput.value.replace(/[()\-\s]/g, '');
                formData.set('cpf', cleanedCpf);
                formData.set('telefone', cleanedTelefone);

                console.log('Dados enviados:', Object.fromEntries(formData));

                fetch("{{ route('alunos.update', $aluno->id) }}", {
                    method: 'PUT',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => {
                        console.log('Status:', response.status);
                        if (!response.ok) {
                            return response.json().then(error => { throw error; });
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Sucesso:', data);
                        card.classList.add('form-success');
                        setTimeout(() => {
                            window.location.href = "{{ route('alunos.index') }}";
                        }, 1000);
                        button.innerHTML = '<i class="fas fa-save me-2"></i>Atualizar Aluno';
                        button.disabled = false;
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        let errorMessage = 'Erro ao atualizar o aluno';
                        if (error.data) {
                            errorMessage += ': ' + Object.values(error.data).flat().join(', ');
                        } else if (error.message) {
                            errorMessage += ': ' + error.message;
                        }
                        alert(errorMessage);
                        button.innerHTML = '<i class="fas fa-save me-2"></i>Atualizar Aluno';
                        button.disabled = false;
                    });
            });
        });
    </script>
@endsection
