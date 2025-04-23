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
            $table->uuid('id');
            $table->uuid('coordenador_id')->index();
            $table->uuid('user_id')->index();
            $table->string('nome');


            $table->foreign('coordenador_id', 'fk_coordenadores_professores')->references('id')->on('coordenadores');
            $table->foreign('user_id', 'fk_users_coordenadores')->references('id')->on('users');
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
            $table->dropColumn('coordenador_id');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('professores');
    }
};
