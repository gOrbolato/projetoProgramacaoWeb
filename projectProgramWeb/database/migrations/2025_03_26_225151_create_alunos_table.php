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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_turma')->nullable();
            $table->string('nome');
            $table->string('telefone');
            $table->string('idade');
            $table->date('ano_letivo');
            $table->timestamps();


            $table->foreign('id_turma', 'fk_turmas_alunos')->references('id')->on('turmas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alunos', function (Blueprint $table){
            $table->dropForeign('fk_turmas_alunos');
            $table->dropColumn('id_turma');
        }); 
        Schema::dropIfExists('alunos');
    }
};
