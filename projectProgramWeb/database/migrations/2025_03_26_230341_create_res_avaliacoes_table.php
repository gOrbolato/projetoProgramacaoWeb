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
        Schema::create('res_avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pergunta');
            $table->unsignedBigInteger('id_formulario_avaliacao');
            $table->unsignedBigInteger('id_aluno');
            $table->text('resposta')->nullable();
            $table->timestamps();

            $table->foreign('id_pergunta', 'fk_perguntas_resp_avaliacoes')->references('id')->on('perguntas');
            $table->foreign('id_formulario_avaliacao', 'fk_formularios_avaliacoes_resp_avaliacoes')->references('id')->on('formularios_avaliacoes');
            $table->foreign('id_aluno', 'fk_alunos_resp_avaliacoes')->references('id')->on('alunos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alunos', function (Blueprint $table){
            $table->dropForeign('fk_perguntas_resp_avaliacoes');
            $table->dropColumn('id_pergunta');
            $table->dropForeign('fk_formularios_avaliacoes_resp_avaliacoes');
            $table->dropColumn('id_formulario_avaliacao');
            $table->dropForeign('fk_alunos_resp_avaliacoes');
            $table->dropColumn('id_aluno');
        });
        Schema::dropIfExists('res_avaliacoes');
    }
};
