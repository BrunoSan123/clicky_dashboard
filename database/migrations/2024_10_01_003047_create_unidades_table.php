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
        Schema::create('unidades', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome_da_unidade');
            $table->integer('quantidade');
            $table->string('cnpj')->nullable();
            $table->string('região')->nullable();
            $table->uuid('Empreendimento_id');
            $table->uuid('Usuario_id')->nullable();
            $table->timestamps();
            $table->foreign('Empreendimento_id')->references('id')->on('empreendimentos')->onDelete('cascade');
            $table->foreign('Usuario_id')->references('id')->on('clientes')->onDelete('cascade');
        });

        Schema::table('empreendimentos',function(Blueprint $table){
            $table->foreign('Unidade_id')->references('id')->on('unidades')->onDelete('cascade');
        });

        Schema::table('contratos',function(Blueprint $table){
            $table->foreign('Unidade_id')->references('id')->on('unidades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};
