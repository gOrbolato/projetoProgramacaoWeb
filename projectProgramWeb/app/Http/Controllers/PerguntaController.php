<?php

namespace App\Http\Controllers;


use App\Helpers\ApiResponse;
use App\Models\Pergunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PerguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
         $perguntas = Pergunta::all();
         return view('perguntas.index', compact('perguntas'));
     }
 
     /**
      * Show the form for creating a new resource.
      */
     public function create()
     {
         return view('perguntas.create');
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'nome_pergunta' => ['required','string'],
            'tipo_pergunta' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json(ApiResponse::fail($validator->errors()->messages()), 400);
        }
        DB::beginTransaction();
        try {
            $pergunta = Pergunta::create([
                'nome_pergunta' => $validator->validated()['nome_pergunta'],
                'tipo_pergunta' => $validator->validate()['tipo_pergunta'] ?? 'texto'
            ]);

            DB::commit();
            return response()->json(ApiResponse::success(['pergunta' =>  $pergunta]), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao criar pergunta', '0003'), 400);
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
            'id' => ['required', 'string', 'exists:perguntas,id'],
            'nome_pergunta' => ['nullable','string'],
            'tipo_pergunta' => ['nullable', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json(ApiResponse::fail($validator->errors()->messages()), 400);
        }
        DB::beginTransaction();
        try {

            $pergunta = Pergunta::find($request->id);

            $pergunta->update([
               'nome_pergunta' => $request->nome_pergunta ?? $pergunta->nome_pergunta,
               'tipo_pergunta' => $request->tipo_pergunta ?? $pergunta->tipo_pergunta
            ]);

            DB::commit();
            return response()->json(ApiResponse::success(['pergunta' =>  $pergunta]), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao atualizar pergunta', '0003'), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {

            $pergunta = Pergunta::find($id);

            $pergunta->delete();

            DB::commit();
            return response()->json(ApiResponse::success(), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(ApiResponse::error('Falha ao atualizar pergunta', '0003'), 400);
        }
    }
}
