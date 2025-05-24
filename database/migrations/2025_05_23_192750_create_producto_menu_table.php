<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('producto_menu', function (Blueprint $table) {
            $table->id('id_producto_menu'); // Cambiado a id_nombre_tabla

            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_menu');

            $table->foreign('id_producto')->references('id_producto')->on('producto');
            $table->foreign('id_menu')->references('id_menu')->on('menu');

            $table->timestamps();

            // Para evitar relaciones duplicadas
            $table->unique(['id_producto', 'id_menu']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('producto_menu');
    }
};
