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
        Schema::create('empresas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome_da_empresa');
            $table->string('cnpj');
            $table->string('cep');
            $table->string('bairro');
            $table->string('uf');
            $table->string('cidade');
            $table->string('endereço');
            $table->uuid('Usuario_id');
            $table->timestamps();
            $table->foreign('Usuario_id')->references('id')->on('clientes')->onDelete('cascade');
        });

        Schema::table('empreendimentos',function(Blueprint $table){
            $table->foreign('Empresa_id')->references('id')->on('empresas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
