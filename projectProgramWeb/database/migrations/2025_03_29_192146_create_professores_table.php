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

            $table->string('nome');
            $table->string('cpf');
            $table->integer('idade');
            $table->string('telefone');

            $table->unsignedBigInteger('coordenador_id');
            $table->foreign('coordenador_id')->references('id')->on('coordenadores');


            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('professores', function (Blueprint $table) {
            $table->dropForeign(['coordenador_id']);
        });
        Schema::dropIfExists('professores');
    }
};
