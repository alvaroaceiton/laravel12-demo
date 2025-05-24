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
        Schema::create('segmento', function (Blueprint $table) {
            $table->id('id_segmento');
            $table->foreignId('id_producto')->constrained('producto', 'id_producto');
            $table->boolean('estado')->default(true);
            $table->string('nombre');
            $table->integer('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('segmento');
    }
};
