<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\Coordenadore;
use App\Models\Professore;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TurmaController extends Controller
{
    public function index()
    {
        $turmas = Turma::with([
            'coordenadore:id,nome',
            'professore:id,nome',
            'aluno:id,name'
        ])
            ->select('id', 'nome_turma', 'id_aluno', 'id_professor', 'id_coordenador')
            ->get();

        return view('turmas.index', compact('turmas'));
    }

    public function create()
    {
        $coordenadores = Coordenadore::select('id', 'nome')->get();
        $professores = Professore::select('id', 'nome')->get();
        $alunos = Aluno::select('id', 'name')->get();

        return view('turmas.create', compact('coordenadores', 'professores', 'alunos'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'nome_turma' => ['required', 'string'],
            'id_aluno' => ['required', 'integer', 'exists:alunos,id'],
            'id_professor' => ['required', 'integer', 'exists:professores,id'],
            'id_coordenador' => ['required', 'integer', 'exists:coordenadores,id'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            Turma::create([
                'nome_turma' => strtoupper($request->nome_turma),
                'id_aluno' => $request->id_aluno,
                'id_professor' => $request->id_professor,
                'id_coordenador' => $request->id_coordenador,
            ]);

            DB::commit();
            return redirect()->route('turmas.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Falha ao criar turma')
                ->withInput();
        }
    }

    public function edit(string $id)
    {
        $turma = Turma::findOrFail($id);
        return view('turmas.edit', compact('turma'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->post(), [
            'nome_turma' => ['nullable', 'string'],
            'id_aluno' => ['nullable', 'integer', 'exists:alunos,id'],
            'id_professor' => ['nullable', 'integer', 'exists:professores,id'],
            'id_coordenador' => ['nullable', 'integer', 'exists:coordenadores,id'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $turma = Turma::findOrFail($id);

            $turma->update([
                'nome_turma' => strtoupper($request->nome_turma ?? $turma->nome_turma),
                'id_aluno' => $request->id_aluno ?? $turma->id_aluno,
                'id_professor' => $request->id_professor ?? $turma->id_professor,
                'id_coordenador' => $request->id_coordenador ?? $turma->id_coordenador,
            ]);

            DB::commit();
            return redirect()->route('turmas.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Falha ao atualizar turma')
                ->withInput();
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $turma = Turma::findOrFail($id);
            $turma->delete();

            DB::commit();
            return redirect()->route('turmas.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Falha ao deletar turma');
        }
    }
}
