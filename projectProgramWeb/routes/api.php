<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\PerguntaController;
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
