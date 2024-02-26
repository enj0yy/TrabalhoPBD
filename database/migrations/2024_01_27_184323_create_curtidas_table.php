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
        Schema::create('curtidas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_publicacao');
            $table->foreign('id_publicacao')->references('id')->on('publicacoes')->onDelete('cascade');
            
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');

            $table->primary(['id_publicacao', 'id_usuario']);

            $table->timestamp('data_interacao', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curtidas');
    }
};
