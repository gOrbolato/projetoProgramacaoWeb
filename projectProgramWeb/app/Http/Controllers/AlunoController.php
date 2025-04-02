<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Aluno;
use App\Models\Pergunta;

use App\Rules\CpfRule;
use App\Rules\PhoneRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alunos  = Aluno::all()->select('name', 'idade', 'cpf', 'telefone', 'ano_letivo');

        return response()->json(ApiResponse::success(['alunos' =>  $alunos]), 200);
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
            'name' => ['required','string', 'max:255'],
            'idade' => ['required', 'integer', 'max:200'],
            'cpf' =>  ['required', 'string', new CpfRule(), 'unique:alunos,cpf,NULL,id,deleted_at,NULL'],
            'telefone' => ['required', 'string', new PhoneRule(), 'unique:alunos,telefone,NULL,id,deleted_at,NULL'],
            'ano_letivo' => ['required', 'integer', 'digits:4']
        ]);

        if ($validator->fails()) {
            return response()->json(ApiResponse::fail($validator->errors()->messages()), 400);
        }
        DB::beginTransaction();
        try {
            $aluno = Aluno::create([
                'name' => strtoupper($request->name),
                'idade' => $request->idade,
                'cpf' => str_replace(['.', '/', '-'], '', $request->cpf),
                'telefone' => str_replace(['(', ')', '-', '.', ' '], '', $request->telefone),
                'ano_letivo' => $request->ano_letivo
            ]);

            DB::commit();
            return response()->json(ApiResponse::success(['aluno' =>  $aluno]), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao criar aluno', '0003'), 400);
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
            'id' => ['required', 'string', 'exists:alunos,id'],
            'name' => ['nullable','string', 'max:255'],
            'idade' => ['nullable', 'integer', 'max:200'],
            'cpf' => ['nullable', 'string', new CpfRule(), 'unique:alunos,cpf,' . $id . ',id,deleted_at,NULL'],
            'telefone' => ['nullable', 'string', new PhoneRule(), 'unique:alunos,telefone,' . $id .  ',id,deleted_at,NULL'],
            'ano_letivo' => ['nullable', 'integer', 'digits:4']
        ]);

        if ($validator->fails()) {
            return response()->json(ApiResponse::fail($validator->errors()->messages()), 400);
        }
        DB::beginTransaction();
        try {

            $aluno = aluno::find($request->id);

            $aluno->update([
                'name' => strtoupper($request->name ?? $aluno->telefone),
                'idade' => $request->idade ?? $aluno->idade,
                'cpf' => $request->cpf ?? $aluno->cpf,
                'telefone' => $request->telefone ?? $aluno->telefone,
                'ano_letivo' => $request->ano_letivo ?? $aluno->ano_letivo,
            ]);

            DB::commit();
            return response()->json(ApiResponse::success(['aluno' =>  $aluno]), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao atualizar aluno', '0003'), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {

            $aluno = Aluno::find($id);

            $aluno->delete();

            DB::commit();
            return response()->json(ApiResponse::success(), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao deletar aluno', '0003'), 400);
        }
    }
}
