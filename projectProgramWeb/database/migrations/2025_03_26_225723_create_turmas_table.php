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
            $table->id(); // A coluna id será a chave primária com AUTO_INCREMENT
            $table->unsignedBigInteger('id_turma');
            $table->unsignedBigInteger('id_pergunta');
            $table->tinyInteger('aprovado_reprovado')
                  ->comment('aprovado recebera true e reprovado recebera false');
            $table->tinyInteger('reenviado');
            $table->timestamps();

             $table->foreign('id_turma')->references('id')->on('turmas');
             $table->foreign('id_pergunta')->references('id')->on('perguntas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formularios_avaliacoes');
    }
};
