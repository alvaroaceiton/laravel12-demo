<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // database/migrations/xxxx_add_images_to_productos.php
    public function up()
    {
        Schema::table('producto', function (Blueprint $table) {
            $table->string('imagen_principal')->nullable()->after('estado_venta');
        });

        // Crear tabla para imágenes adicionales
        Schema::create('producto_imagenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_producto')->constrained('producto', 'id_producto');
            $table->string('url');
            $table->integer('orden')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('producto_imagenes');
        Schema::table('producto', function (Blueprint $table) {
            $table->dropColumn('imagen_principal');
        });
    }
};
