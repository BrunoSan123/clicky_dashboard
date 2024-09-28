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
            $table->string('codigo');
            $table->uuid('Usuario_id');
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
