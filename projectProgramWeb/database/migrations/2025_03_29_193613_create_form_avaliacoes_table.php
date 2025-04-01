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
        Schema::create('form_avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_turma');
            $table->unsignedBigInteger('id_pergunta');


            $table->boolean('aval_coordenador')->comment('Caso o coordenador aprove essa coluna será marcada como true, por padrão ela é marcada como false quando')->default(false);
            $table->boolean('reenviado')->default(false);

            $table->foreign('id_turma')->references('id')->on('turmas');
            $table->foreign('id_pergunta')->references('id')->on('perguntas');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_avaliacoes', function (Blueprint $table) {
            $table->dropForeign(['id_turma']);
            $table->dropForeign(['id_pergunta']);
        });
        Schema::dropIfExists('form_avaliacoes');
    }
};
