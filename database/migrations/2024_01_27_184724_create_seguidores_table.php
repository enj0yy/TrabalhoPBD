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
        Schema::create('seguidores', function (Blueprint $table) {
            $table->unsignedBigInteger('id_usuario_seguidor');
            $table->foreign('id_usuario_seguidor')->references('id')->on('usuarios')->onDelete('cascade');

            $table->unsignedBigInteger('id_usuario_seguido');
            $table->foreign('id_usuario_seguido')->references('id')->on('usuarios')->onDelete('cascade');

            $table->timestamp('data', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguidores');
    }
};
