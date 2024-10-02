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
        Schema::create('empreendimentos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome_do_empreendimento');
            $table->string('tipo');
            $table->string('público');
            $table->string('status');
            $table->string('codigo');
            $table->string('imagem');
            $table->uuid('Usuario_id');
            $table->uuid('Empresa_id')->nullable();
            $table->timestamps();
            $table->foreign('Usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empreendimentos');
    }
};
