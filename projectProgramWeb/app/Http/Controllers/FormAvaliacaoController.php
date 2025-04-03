<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\FormAvaliaco;
use App\Models\Professore;
use App\Rules\CpfRule;
use App\Rules\PhoneRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FormAvaliacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $form_avaliacao = FormAvaliaco::with([
            'turma:id,nome_turma',
            'pergunta:id,nome_pergunta',
        ])
            ->select('id', 'id_turma', 'id_pergunta', 'aval_coordenador', 'reenviado')
            ->get();


        return response()->json(ApiResponse::success(['form_avaliacao' =>  $form_avaliacao]), 200);
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
            'id_turma' => ['required','integer', 'exists:turmas,id'],
            'id_pergunta' => ['required', 'integer','exists:perguntas,id'],
            'aval_coordenador' =>  ['required', 'bool'],
            'reenviado' => ['required', 'bool'],
        ]);

        if ($validator->fails()) {
            return response()->json(ApiResponse::fail($validator->errors()->messages()), 400);
        }

        DB::beginTransaction();
        try {
            $form_avaliacao = FormAvaliaco::create([
                'id_turma' => $request->id_turma,
                'id_pergunta' => $request->id_pergunta,
                'aval_coordenador' => $request->aval_coordenador,
                'reenviado' => $request->reenviado,
            ]);

            DB::commit();
            return response()->json(ApiResponse::success(['form_avaliacao' =>  $form_avaliacao]), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao criar formulario avaliação', '0003'), 400);
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
            'id' => ['required', 'string', 'exists:professores,id'],
            'id_turma' => ['nullable','integer', 'exists:turmas,id'],
            'id_pergunta' => ['nullable', 'integer','exists:perguntas,id'],
            'aval_coordenador' =>  ['nullable', 'bool'],
            'reenviado' => ['nullable', 'bool'],
        ]);

        if ($validator->fails()) {
            return response()->json(ApiResponse::fail($validator->errors()->messages()), 400);
        }
        DB::beginTransaction();
        try {

            $form_avaliacao = FormAvaliaco::find($request->id);

            $form_avaliacao->update([
                'id_turma' => $request->id_turma ?? $form_avaliacao->id_turma,
                'id_pergunta' => $request->id_pergunta ?? $form_avaliacao->id_pergunta,
                'aval_coordenador' => $request->aval_coordenador ?? $form_avaliacao->aval_coordenador,
                'reenviado' => $request->reenviado ?? $form_avaliacao->reenviado,
            ]);

            DB::commit();
            return response()->json(ApiResponse::success(['form_avaliacao' =>  $form_avaliacao]), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao atualizar formulario valiacao', '0003'), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {

            $formAvaliacao = FormAvaliaco::find($id);

            $formAvaliacao->delete();

            DB::commit();
            return response()->json(ApiResponse::success(), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao deletar professor', '0003'), 400);
        }
    }
}
