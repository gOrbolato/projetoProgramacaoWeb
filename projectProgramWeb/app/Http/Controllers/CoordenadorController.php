<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Aluno;
use App\Models\Coordenadore;
use App\Rules\CpfRule;
use App\Rules\PhoneRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CoordenadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coordenadores  = Coordenadore::all()->select('nome', 'idade', 'cpf', 'telefone');

        return response()->json(ApiResponse::success(['coordenadores' =>  $coordenadores]), 200);
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
            'nome' => ['required','string', 'max:255'],
            'idade' => ['required', 'integer', 'max:200'],
            'cpf' =>  ['required', 'string', new CpfRule(), 'unique:coordenadores,cpf,NULL,id,deleted_at,NULL'],
            'telefone' => ['required', 'string', new PhoneRule(), 'unique:coordenadores,telefone,NULL,id,deleted_at,NULL'],
        ]);

        if ($validator->fails()) {
            return response()->json(ApiResponse::fail($validator->errors()->messages()), 400);
        }

        DB::beginTransaction();
        try {
            $coordenador = Coordenadore::create([
                'nome' => strtoupper($request->nome),
                'idade' => $request->idade,
                'cpf' => str_replace(['.', '/', '-'], '', $request->cpf),
                'telefone' => str_replace(['(', ')', '-', '.', ' '], '', $request->telefone),
            ]);

            DB::commit();
            return response()->json(ApiResponse::success(['coordenador' =>  $coordenador]), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao criar Coordenador', '0003'), 400);
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
            'id' => ['required', 'string', 'exists:coordenadores,id'],
            'nome' => ['nullable','string', 'max:255'],
            'idade' => ['nullable', 'integer', 'max:200'],
            'cpf' => ['nullable', 'string', new CpfRule(), 'unique:coordenadores,cpf,' . $id . ',id,deleted_at,NULL'],
            'telefone' => ['nullable', 'string', new PhoneRule(), 'unique:coordenadores,telefone,' . $id .  ',id,deleted_at,NULL'],
        ]);

        if ($validator->fails()) {
            return response()->json(ApiResponse::fail($validator->errors()->messages()), 400);
        }
        DB::beginTransaction();
        try {

            $coordenador = Coordenadore::find($request->id);

            $coordenador->update([
                'nome' => strtoupper($request->nome ?? $coordenador->nome),
                'idade' => $request->idade ?? $coordenador->idade,
                'cpf' => str_replace(['.', '/', '-'], '', $request->cpf),
                'telefone' => str_replace(['(', ')', '-', '.', ' '], '', $request->telefone),
            ]);

            DB::commit();
            return response()->json(ApiResponse::success(['coordenador' =>  $coordenador]), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao atualizar coordenador', '0003'), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {

            $coordenador = Coordenadore::find($id);

            $coordenador->delete();

            DB::commit();
            return response()->json(ApiResponse::success(), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao deletar coordenador', '0003'), 400);
        }
    }
}
