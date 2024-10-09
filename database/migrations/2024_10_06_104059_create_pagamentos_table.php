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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('descrição');
            $table->float('valor');
            $table->boolean('pago')->default(0);
            $table->uuid('Contrato_id');
            $table->uuid('Usuario_id')->nullable();
            $table->string('data_de_vencimento');
            $table->timestamps();
            $table->foreign('Contrato_id')->references('id')->on('contratos')->onDelete('cascade');
            $table->foreign('Usuario_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordems');
    }
};
