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
        Schema::create('formularios_avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_turma');
            $table->unsignedBigInteger('id_pergunta');
            $table->boolean('aprovado_reprovado')->comment('aprovado recebera true e reprovado recebera false');
            $table->boolean('reenviado');
            $table->timestamps();

            $table->foreign('id_turma', 'fk_turmas_formularios_avaliacoes')->references('id')->on('turmas');
            $table->foreign('id_pergunta', 'fk_perguntas_formularios_avaliacoes')->references('id')->on('perguntas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formularios_avaliacoes', function (Blueprint $table){
            $table->dropForeign('fk_turmas_formularios_avaliacoes');
            $table->dropColumn('id_turma');
            $table->dropForeign('fk_perguntas_formularios_avaliacoes');
            $table->dropColumn('id_pergunta');
        });
        Schema::dropIfExists('formularios_avaliacoes');
    }
};
