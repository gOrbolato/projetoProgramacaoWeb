<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_turma');
            $table->unsignedBigInteger('id_aluno');
            $table->unsignedBigInteger('id_professor');
            $table->unsignedBigInteger('id_coordenador');

            $table->foreign('id_aluno')->references('id')->on('alunos');
            $table->foreign('id_professor')->references('id')->on('professores');
            $table->foreign('id_coordenador')->references('id')->on('coordenadores');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('turmas', function (Blueprint $table) {
            $table->dropForeign(['id_aluno']);
            $table->dropForeign(['id_professor']);
            $table->dropForeign(['id_coordenador']);
        });
        Schema::dropIfExists('turmas');
    }
};
