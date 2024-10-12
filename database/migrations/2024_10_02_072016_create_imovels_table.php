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
        Schema::create('imovels', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome_do_imovel');
            $table->string('cep');
            $table->string('endereço');
            $table->string('rua')->nullable();
            $table->string('uf');
            $table->string('cidade');
            $table->uuid('Unidade_id');
            $table->timestamps();
            $table->foreign('Unidade_id')->references('id')->on('unidades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imovels');
    }
};
