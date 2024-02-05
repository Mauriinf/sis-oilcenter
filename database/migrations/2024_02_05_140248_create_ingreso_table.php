<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_proveedor');
            $table->foreign('id_proveedor')->references('id')->on('users');// proveedor
            $table->unsignedBigInteger('id_almacenero');
            $table->foreign('id_almacenero')->references('id')->on('users');// almacenero
            $table->string('nombre_proveedor', 25);
            $table->unsignedInteger('monto_total');
            $table->datetime('fecha_hora');
            $table->string('estado', 10);
            $table->float('monto_cancelado', 6, 2);
            $table->float('monto_deuda', 6, 2);
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
        Schema::dropIfExists('ingreso');
    }
}
