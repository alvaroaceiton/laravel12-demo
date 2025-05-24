<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id('id_menu'); // Equivalente a AUTO_INCREMENT
            $table->unsignedBigInteger('id_menu_padre')->nullable();
            $table->string('nombre', 100)->nullable()->charset('utf8mb3')->collation('utf8mb3_spanish_ci');
            $table->string('label', 50)->nullable()->charset('utf8mb3')->collation('utf8mb3_spanish_ci');
            $table->string('slug', 100)->nullable()->charset('utf8mb3')->collation('utf8mb3_spanish_ci');
            $table->dateTime('fecha_inicio')->nullable();
            $table->dateTime('fecha_fin')->nullable();
            $table->tinyInteger('activo')->default(1);

            // Claves foráneas e índices
            $table->foreign('id_menu_padre')->references('id_menu')->on('menu');

            $table->index('activo', 'idx_activo');
            $table->index(['fecha_inicio', 'fecha_fin'], 'idx_fechas');
            $table->index('fecha_inicio', 'idx_fecha_inicio');
            $table->index('fecha_fin', 'idx_fecha_fin');
            $table->index('slug', 'idx_slug');
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu');
    }
};
