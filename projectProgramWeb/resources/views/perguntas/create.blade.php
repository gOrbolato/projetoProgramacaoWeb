@extends('layouts.app')

@section('title', 'Criar Questionário')

@section('content')
<div class="container">
    <h1>Criar Questionário</h1>
    <form action="{{ route('perguntas.store') }}" method="POST">
        @csrf

        <!-- Campo ID (gerado automaticamente pelo sistema) -->
        <div>
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" value="{{ old('id') ?? 'Gerado Automaticamente' }}" readonly>
        </div>
        <div>
            <label for="turma">Turma:</label>
            <input type="text" name="turma" id="turma" value="{{ old('turma') }}" required>
        </div>

        <!-- Perguntas de Avaliação -->
        <div>
            <h2>Perguntas de Avaliação</h2>
            <p>Avalie as seguintes questões em uma escala de 1 a 5:</p>

            <!-- Pergunta 1 -->
            <div>
                <label for="pergunta1">1. O conteúdo foi bem explicado?</label>
                <select name="pergunta1" id="pergunta1" required>
                    <option value="">Selecione</option>
                    <option value="1">1 - Péssimo</option>
                    <option value="2">2 - Ruim</option>
                    <option value="3">3 - Regular</option>
                    <option value="4">4 - Bom</option>
                    <option value="5">5 - Excelente</option>
                </select>
            </div>

            <!-- Pergunta 2 -->
            <div>
                <label for="pergunta2">2. O professor foi claro e objetivo?</label>
                <select name="pergunta2" id="pergunta2" required>
                    <option value="">Selecione</option>
                    <option value="1">1 - Péssimo</option>
                    <option value="2">2 - Ruim</option>
                    <option value="3">3 - Regular</option>
                    <option value="4">4 - Bom</option>
                    <option value="5">5 - Excelente</option>
                </select>
            </div>

            <!-- Pergunta 3 -->
            <div>
                <label for="pergunta3">3. O conteúdo foi relevante para o aprendizado?</label>
                <select name="pergunta3" id="pergunta3" required>
                    <option value="">Selecione</option>
                    <option value="1">1 - Péssimo</option>
                    <option value="2">2 - Ruim</option>
                    <option value="3">3 - Regular</option>
                    <option value="4">4 - Bom</option>
                    <option value="5">5 - Excelente</option>
                </select>
            </div>

            <!-- Pergunta 4 -->
            <div>
                <label for="pergunta4">4. Como você avalia a qualidade da instituição?</label>
                <select name="pergunta4" id="pergunta4" required>
                    <option value="">Selecione</option>
                    <option value="1">1 - Péssimo</option>
                    <option value="2">2 - Ruim</option>
                    <option value="3">3 - Regular</option>
                    <option value="4">4 - Bom</option>
                    <option value="5">5 - Excelente</option>
                </select>
            </div>

            <!-- Pergunta 5 -->
            <div>
                <label for="pergunta5">5. O ambiente de aprendizado foi suficiente?</label>
                <select name="pergunta5" id="pergunta5" required>
                    <option value="">Selecione</option>
                    <option value="1">1 - Péssimo</option>
                    <option value="2">2 - Ruim</option>
                    <option value="3">3 - Regular</option>
                    <option value="4">4 - Bom</option>
                    <option value="5">5 - Excelente</option>
                </select>
            </div>

            <!-- Pergunta 6 -->
            <div>
                <label for="pergunta5">6. Você teve todo o suporte necessário dos professores e coordenação?</label>
                <select name="pergunta6" id="pergunta6" required>
                    <option value="">Selecione</option>
                    <option value="1">1 - Péssimo</option>
                    <option value="2">2 - Ruim</option>
                    <option value="3">3 - Regular</option>
                    <option value="4">4 - Bom</option>
                    <option value="5">5 - Excelente</option>
                </select>
            </div>
        </div>

        <!-- Aprovação/Reprovação do Coordenador -->
        <div>
            <h2>Decisão do Coordenador</h2>
            <label for="aprovacao">Aprovar ou Reprovar:</label>
            <select name="aprovacao" id="aprovacao" required>
                <option value="">Selecione</option>
                <option value="aprovado">Aprovado</option>
                <option value="reprovado">Reprovado</option>
            </select>
        </div>

        <!-- Botão de Envio -->
        <button type="submit">Salvar Questionário</button>
    </form>
</div>
@endsection