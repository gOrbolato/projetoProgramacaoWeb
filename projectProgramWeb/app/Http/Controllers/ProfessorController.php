<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Coordenadore;
use App\Models\Professore;
use App\Rules\CpfRule;
use App\Rules\PhoneRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professores = Professore::with('coordenadore:id,nome')
            ->select('id', 'nome', 'idade', 'cpf', 'telefone', 'coordenador_id')
            ->get();


        return response()->json(ApiResponse::success(['professores' =>  $professores]), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coordenadores = Coordenadore::all(['id', 'nome']);
        return view('professores.create', compact('coordenadores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'nome' => ['required','string', 'max:255'],
            'idade' => ['required', 'integer', 'max:200'],
            'cpf' =>  ['required', 'string', new CpfRule(), 'unique:professores,cpf,NULL,id,deleted_at,NULL'],
            'telefone' => ['required', 'string', new PhoneRule(), 'unique:professores,telefone,NULL,id,deleted_at,NULL'],
            'coordenador_id' => ['required', 'string', 'exists:coordenadores,id']
        ]);

        if ($validator->fails()) {
            return response()->json(ApiResponse::fail($validator->errors()->messages()), 400);
        }

        DB::beginTransaction();
        try {
            $professsor = Professore::create([
                'nome' => strtoupper($request->nome),
                'idade' => $request->idade,
                'cpf' => str_replace(['.', '/', '-'], '', $request->cpf),
                'telefone' => str_replace(['(', ')', '-', '.', ' '], '', $request->telefone),
                'coordenador_id' => $request->coordenador_id
            ]);

            DB::commit();
            return response()->json(ApiResponse::success(['professsor' =>  $professsor]), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao criar professsor', '0003'), 400);
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
        $professor = Professore::findOrFail($id);
        $coordenadores = Coordenadore::all(['id', 'nome']);
        return view('professores.edit', compact('professor', 'coordenadores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge(['id' => $id]);
        $validator = Validator::make($request->post(), [
            'id' => ['required', 'string', 'exists:professores,id'],
            'nome' => ['nullable','string', 'max:255'],
            'idade' => ['nullable', 'integer', 'max:200'],
            'cpf' => ['nullable', 'string', new CpfRule(), 'unique:professores,cpf,' . $id . ',id,deleted_at,NULL'],
            'telefone' => ['nullable', 'string', new PhoneRule(), 'unique:professores,telefone,' . $id .  ',id,deleted_at,NULL'],
            'coordenador_id' => ['nullable', 'string', 'exists:coordenadores,id']
        ]);

        if ($validator->fails()) {
            return response()->json(ApiResponse::fail($validator->errors()->messages()), 400);
        }
        DB::beginTransaction();
        try {

            $professor = Professore::find($request->id);

            $professor->update([
                'nome' => strtoupper($request->nome ?? $professor->nome),
                'idade' => $request->idade ?? $professor->idade,
                'cpf' => str_replace(['.', '/', '-'], '', $request->cpf),
                'telefone' => str_replace(['(', ')', '-', '.', ' '], '', $request->telefone),
                'coordenador_id' => $request->coordenador_id ?? $professor->coordenador_id
            ]);

            DB::commit();
            return response()->json(ApiResponse::success(['professor' =>  $professor]), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao atualizar professor', '0003'), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {

            $professor = Professore::find($id);

            $professor->delete();

            DB::commit();
            return response()->json(ApiResponse::success(), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao deletar professor', '0003'), 400);
        }
    }
}
