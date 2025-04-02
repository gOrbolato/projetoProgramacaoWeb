<?php
//
//use App\Http\Controllers\AlunoController;
//use App\Models\Aluno;
//use Illuminate\Support\Facades\Route;
//
///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider and all of them will
//| be assigned to the "web" middleware group. Make something great!
//|
//*/
//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//// acesso a um ID especifico
//Route::get('/alunos/create', [AlunoController::class, 'create'])->name('alunos.create');
//Route::post('/alunos', [AlunoController::class, 'store'])->name('alunos.store');
//
//// routes/web.php
//Route::get('/alunos/{id}', [AlunoController::class, 'show'])->name('alunos.show');
//
//// AlunoController.php
//public function show($id)
//{
//    $aluno = Aluno::find($id);
//    return response()->json($aluno);
//}
