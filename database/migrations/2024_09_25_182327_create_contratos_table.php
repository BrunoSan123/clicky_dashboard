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
        Schema::create('contratos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('numero_do_contrato');
            $table->string('nome_do_contratante');
            $table->string('data_de_inicio');
            $table->string('data_de_termino');
            $table->float('valor_do_contrato');
            $table->string('status');
            $table->float('valor_da_parcela');
            $table->string('data_de_emissão');
            $table->uuid('Empreendimento_id');
            $table->uuid('Unidade_id');
            $table->uuid('Usuario_id')->nullable();
            $table->foreign('Empreendimento_id')->references('id')->on('empreendimentos')->onDelete('cascade');
            $table->foreign('Usuario_id')->references('id')->on('Clientes')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
