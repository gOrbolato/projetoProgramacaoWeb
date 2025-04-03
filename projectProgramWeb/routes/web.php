<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CoordenadorController;
use App\Http\Controllers\FormAvaliacaoController;
use App\Http\Controllers\PerguntaController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\TurmaController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('/perguntas')->group(function () {
    Route::get('/', [PerguntaController::class, 'index'])->name('perguntas.index');
    Route::get('/criar', [PerguntaController::class, 'create'])->name('perguntas.create');
    Route::post('/criar', [PerguntaController::class, 'store'])->name('perguntas.store');
    Route::get('/editar/{id}', [PerguntaController::class, 'edit'])->name('perguntas.edit');
    Route::put('/atualizar/{id}', [PerguntaController::class, 'update'])->name('perguntas.update');
    Route::delete('/deletar/{id}', [PerguntaController::class, 'destroy'])->name('perguntas.destroy');
});

Route::prefix('/alunos')->group(function () {
    Route::get('/', [AlunoController::class, 'index'])->name('alunos.index');
    Route::get('/criar', [AlunoController::class, 'create'])->name('alunos.create');
    Route::post('/criar', [AlunoController::class, 'store'])->name('alunos.store');
    Route::get('/editar/{id}', [AlunoController::class, 'edit'])->name('alunos.edit');
    Route::put('/atualizar/{id}', [AlunoController::class, 'update'])->name('alunos.update');
    Route::delete('/deletar/{id}', [AlunoController::class, 'destroy'])->name('alunos.destroy');
});

Route::prefix('/coordenadores')->group(function () {
    Route::get('/', [CoordenadorController::class, 'index'])->name('coordenadores.index');
    Route::get('/criar', [CoordenadorController::class, 'create'])->name('coordenadores.create');
    Route::post('/criar', [CoordenadorController::class, 'store'])->name('coordenadores.store');
    Route::get('/editar/{id}', [CoordenadorController::class, 'edit'])->name('coordenadores.edit');
    Route::put('/atualizar/{id}', [CoordenadorController::class, 'update'])->name('coordenadores.update');
    Route::delete('/deletar/{id}', [CoordenadorController::class, 'destroy'])->name('coordenadores.destroy');
});

Route::prefix('/professores')->group(function () {
    Route::get('/', [ProfessorController::class, 'index'])->name('professores.index');
    Route::get('/criar', [ProfessorController::class, 'create'])->name('professores.create');
    Route::post('/criar', [ProfessorController::class, 'store'])->name('professores.store');
    Route::get('/editar/{id}', [ProfessorController::class, 'edit'])->name('professores.edit');
    Route::put('/atualizar/{id}', [ProfessorController::class, 'update'])->name('professores.update');
    Route::delete('/deletar/{id}', [ProfessorController::class, 'destroy'])->name('professores.destroy');
});

Route::prefix('/turmas')->group(function () {
    Route::get('/', [TurmaController::class, 'index'])->name('turmas.index');
    Route::get('/criar', [TurmaController::class, 'create'])->name('turmas.create');
    Route::post('/criar', [TurmaController::class, 'store'])->name('turmas.store');
    Route::get('/editar/{id}', [TurmaController::class, 'edit'])->name('turmas.edit');
    Route::put('/atualizar/{id}', [TurmaController::class, 'update'])->name('turmas.update');
    Route::delete('/deletar/{id}', [TurmaController::class, 'destroy'])->name('turmas.destroy');
});

Route::prefix('/form-avaliacao')->group(function () {
    Route::get('/', [FormAvaliacaoController::class, 'index'])->name('form-avaliacao.index');
    Route::get('/criar', [FormAvaliacaoController::class, 'create'])->name('form-avaliacao.create');
    Route::post('/criar', [FormAvaliacaoController::class, 'store'])->name('form-avaliacao.store');
    Route::get('/editar/{id}', [FormAvaliacaoController::class, 'edit'])->name('form-avaliacao.edit');
    Route::put('/atualizar/{id}', [FormAvaliacaoController::class, 'update'])->name('form-avaliacao.update');
    Route::delete('/deletar/{id}', [FormAvaliacaoController::class, 'destroy'])->name('form-avaliacao.destroy');
});