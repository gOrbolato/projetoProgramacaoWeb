<?php

namespace App\Http\Controllers;

use App\Models\Coordenadore;
use App\Rules\CpfRule;
use App\Rules\PhoneRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CoordenadorController extends Controller
{
    public function index()
    {
        $coordenadores = Coordenadore::all();
        return view('coordenadores.index', compact('coordenadores'));
    }

    public function create()
    {
        return view('coordenadores.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'nome' => ['required', 'string', 'max:255'],
            'idade' => ['required', 'integer', 'max:200'],
            'cpf' => ['required', 'string', new CpfRule(), 'unique:coordenadores,cpf,NULL,id,deleted_at,NULL'],
            'telefone' => ['required', 'string', new PhoneRule(), 'unique:coordenadores,telefone,NULL,id,deleted_at,NULL'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            Coordenadore::create([
                'nome' => strtoupper($request->nome),
                'idade' => $request->idade,
                'cpf' => str_replace(['.', '/', '-'], '', $request->cpf),
                'telefone' => str_replace(['(', ')', '-', '.', ' '], '', $request->telefone),
            ]);

            DB::commit();
            return redirect()->route('coordenadores.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Falha ao criar coordenador')
                ->withInput();
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $coordenador = Coordenadore::findOrFail($id);
        return view('coordenadores.edit', compact('coordenador'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->post(), [
            'nome' => ['nullable', 'string', 'max:255'],
            'idade' => ['nullable', 'integer', 'max:200'],
            'cpf' => ['nullable', 'string', new CpfRule(), 'unique:coordenadores,cpf,' . $id . ',id,deleted_at,NULL'],
            'telefone' => ['nullable', 'string', new PhoneRule(), 'unique:coordenadores,telefone,' . $id . ',id,deleted_at,NULL'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $coordenador = Coordenadore::findOrFail($id);

            $coordenador->update([
                'nome' => strtoupper($request->nome ?? $coordenador->nome),
                'idade' => $request->idade ?? $coordenador->idade,
                'cpf' => $request->cpf ? str_replace(['.', '/', '-'], '', $request->cpf) : $coordenador->cpf,
                'telefone' => $request->telefone ? str_replace(['(', ')', '-', '.', ' '], '', $request->telefone) : $coordenador->telefone,
            ]);

            DB::commit();
            return redirect()->route('coordenadores.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Falha ao atualizar coordenador')
                ->withInput();
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $coordenador = Coordenadore::findOrFail($id);
            $coordenador->delete();

            DB::commit();
            return redirect()->route('coordenadores.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Falha ao deletar coordenador');
        }
    }
}
