<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso_articulos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fecha_de_pedido_id')->nullable()->constrained();
            $table->foreignId('articulo_id')->constrained();
            $table->decimal('cantidad',8,2);
            $table->decimal('precio',8,2);
            $table->unsignedBigInteger('planificador');
            $table->foreign('planificador')->references('id')->on('users');
            $table->foreignId('centro_de_costo_id')->constrained();
            $table->foreignId('sede_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingreso_articulos');
    }
};
