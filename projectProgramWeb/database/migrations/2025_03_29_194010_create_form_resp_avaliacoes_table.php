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
        Schema::create('form_resp_avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_form_avaliacao');
            $table->unsignedBigInteger('id_aluno');


            $table->text('resposta');

            $table->foreign('id_form_avaliacao')->references('id')->on('form_avaliacoes');
            $table->foreign('id_aluno')->references('id')->on('alunos');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_resp_avaliacoes', function (Blueprint $table) {
            $table->dropForeign(['id_form_avaliacao']);
            $table->dropForeign(['id_aluno']);
        });
        Schema::dropIfExists('form_resp_avaliacoes');
    }
};
