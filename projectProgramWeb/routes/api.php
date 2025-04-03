<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CoordenadorController;
use App\Http\Controllers\FormAvaliacaoController;
use App\Http\Controllers\PerguntaController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\TurmaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::prefix('/perguntas')->group(function () {
    Route::get('listar', [PerguntaController::class, 'index']);
    Route::post('criar', [PerguntaController::class, 'store']);
    Route::put('atualizar/{id}', [PerguntaController::class, 'update']);
    Route::delete('deletar/{id}', [PerguntaController::class, 'destroy']);
});

Route::prefix('/alunos')->group(function () {
    Route::get('listar', [AlunoController::class, 'index']);
    Route::post('criar', [AlunoController::class, 'store']);
    Route::put('atualizar/{id}', [AlunoController::class, 'update']);
    Route::delete('deletar/{id}', [AlunoController::class, 'destroy']);
});

Route::prefix('/coordenadores')->group(function () {
    Route::get('listar', [CoordenadorController::class, 'index']);
    Route::post('criar', [CoordenadorController::class, 'store']);
    Route::put('atualizar/{id}', [CoordenadorController::class, 'update']);
    Route::delete('deletar/{id}', [CoordenadorController::class, 'destroy']);
});

Route::prefix('/professores')->group(function () {
    Route::get('listar', [ProfessorController::class, 'index']);
    Route::post('criar', [ProfessorController::class, 'store']);
    Route::put('atualizar/{id}', [ProfessorController::class, 'update']);
    Route::delete('deletar/{id}', [ProfessorController::class, 'destroy']);
});

Route::prefix('/turmas')->group(function () {
    Route::get('listar', [TurmaController::class, 'index']);
    Route::post('criar', [TurmaController::class, 'store']);
    Route::put('atualizar/{id}', [TurmaController::class, 'update']);
    Route::delete('deletar/{id}', [TurmaController::class, 'destroy']);
});

Route::prefix('/form_avaliaco')->group(function () {
    Route::get('listar', [FormAvaliacaoController::class, 'index']);
    Route::post('criar', [FormAvaliacaoController::class, 'store']);
    Route::put('atualizar/{id}', [FormAvaliacaoController::class, 'update']);
    Route::delete('deletar/{id}', [FormAvaliacaoController::class, 'destroy']);
});
