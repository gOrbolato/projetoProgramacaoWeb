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
        // Validação dos dados do formulário
        $validator = Validator::make($request->all(), [
            'nome_pergunta' => ['required', 'string'],
            'tipo_pergunta' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator) // Passa os erros de validação
                ->withInput(); // Mantém os dados preenchidos no formulário
        }

        DB::beginTransaction();
        try {
            // Cria a nova pergunta
            Pergunta::create([
                'nome_pergunta' => $request->nome_pergunta,
                'tipo_pergunta' => $request->tipo_pergunta ?? 'texto'
            ]);

            DB::commit();

            // Redireciona para a lista de perguntas com mensagem de sucesso
            return redirect()->route('perguntas.index')->with('success', 'Pergunta criada com sucesso!');
        } catch (\Throwable $th) {
            DB::rollBack();

            // Redireciona com mensagem de erro
            return redirect()->back()->with('error', 'Falha ao criar a pergunta. Por favor, tente novamente.');
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
        $pergunta = Pergunta::find($id);

        if (!$pergunta) {
            return redirect()->route('perguntas.index')->with('error', 'Pergunta não encontrada.');
        }

        return view('perguntas.edit', compact('pergunta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validação dos dados do formulário
        $validator = Validator::make($request->all(), [
            'nome_pergunta' => ['nullable', 'string'],
            'tipo_pergunta' => ['nullable', 'string']
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $pergunta = Pergunta::find($id);

            // Atualiza a pergunta
            $pergunta->update([
                'nome_pergunta' => $request->nome_pergunta ?? $pergunta->nome_pergunta,
                'tipo_pergunta' => $request->tipo_pergunta ?? $pergunta->tipo_pergunta
            ]);

            DB::commit();

            // Redireciona para a lista de perguntas com mensagem de sucesso
            return redirect()->route('perguntas.index')->with('success', 'Pergunta atualizada com sucesso!');
        } catch (\Throwable $th) {
            DB::rollBack();

            // Redireciona com mensagem de erro
            return redirect()->back()->with('error', 'Falha ao atualizar a pergunta. Por favor, tente novamente.');
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
            return redirect()->route('perguntas.index')->with('success', 'Pergunta excluída com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('perguntas.index')->with('error', 'Falha ao excluir a pergunta.');
        }
    }
}
