<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Professore;
use App\Models\Turma;
use App\Rules\CpfRule;
use App\Rules\PhoneRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $turmas = Turma::with([
            'coordenadore:id,nome',
            'professore:id,nome',
            'aluno:id,name'
        ])
            ->select('id', 'nome_turma', 'id_aluno', 'id_professor', 'id_coordenador')
            ->get();


        return response()->json(ApiResponse::success(['turmas' =>  $turmas]), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'nome_turma' => ['required','string'],
            'id_aluno' => ['required', 'integer', 'exists:alunos,id'],
            'id_professor' =>  ['required', 'integer', 'exists:professores,id'],
            'id_coordenador' => ['required', 'integer', 'exists:coordenadores,id'],
        ]);

        if ($validator->fails()) {
            return response()->json(ApiResponse::fail($validator->errors()->messages()), 400);
        }

        DB::beginTransaction();
        try {
            $turma = Turma::create([
                'nome_turma' => strtoupper($request->nome_turma),
                'id_aluno' => $request->id_aluno,
                'id_professor' => $request->id_professor,
                'id_coordenador' => $request->id_coordenador,
            ]);

            DB::commit();
            return response()->json(ApiResponse::success(['turma' =>  $turma]), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao criar turma', '0003'), 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge(['id' => $id]);
        $validator = Validator::make($request->post(), [
            'id' => ['required', 'string', 'exists:turmas,id'],
            'nome_turma' => ['nullable','string'],
            'id_aluno' => ['nullable', 'integer', 'exists:alunos,id'],
            'id_professor' => ['nullable', 'integer', 'exists:professores,id'],
            'id_coordenador' => ['nullable', 'integer', 'exists:coordenadores,id'],
        ]);

        if ($validator->fails()) {
            return response()->json(ApiResponse::fail($validator->errors()->messages()), 400);
        }
        DB::beginTransaction();
        try {

            $turma = Turma::find($request->id);

            $turma->update([
                'nome_turma' => strtoupper($request->nome_turma) ?? $turma->nome_turma,
                'id_aluno' => $request->id_aluno ?? $turma->id_aluno,
                'id_professor' => $request->id_professor ?? $turma->id_professor,
                'id_coordenador' => $request->id_coordenador ?? $turma->id_coordenador,
            ]);

            DB::commit();
            return response()->json(ApiResponse::success(['turma' =>  $turma]), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao atualizar Turma', '0003'), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {

            $turma = Turma::find($id);

            $turma->delete();

            DB::commit();
            return response()->json(ApiResponse::success(), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao deletar turma', '0003'), 400);
        }
    }
}
