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
        Schema::create('mensagem', function (Blueprint $table) {
            $table->id('id_mensagem');
            $table->string("texto_mensagem")->nullable(false);

            $table->unsignedBigInteger('id_grupo');
            $table->unsignedBigInteger('id_usuario');
            
            $table->foreign('id_grupo')->references('id_grupo')->on('grupo')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensagem');
    }
};
