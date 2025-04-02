<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Turma;
use Illuminate\Http\Request;

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
            'aluno:id,nome'
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
