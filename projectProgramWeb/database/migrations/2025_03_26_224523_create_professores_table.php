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
        Schema::create('professores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_coordenador')->nullable();
            $table->string('nome');
            $table->string('telefone');
            $table->string('idade');
            $table->timestamps();

            $table->foreign('id_coordenador', 'fk_coordenadores_professores')->references('id')->on('coordenadores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alunos', function (Blueprint $table){
            $table->dropForeign('fk_coordenadores_professores');
            $table->dropColumn('id_coordenador');
        });
        Schema::dropIfExists('professores');
    }
};
