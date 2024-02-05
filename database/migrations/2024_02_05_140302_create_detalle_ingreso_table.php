<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ingreso', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_articulo');
            $table->foreign('id_articulo')->references('id')->on('articulo');// articulo
            $table->unsignedBigInteger('id_ingreso');
            $table->foreign('id_ingreso')->references('id')->on('ingreso');// ingreso
            $table->unsignedInteger('cantidad');
            $table->float('precio_compra',6,2);
            $table->float('precio_venta_normal',6,2);
            $table->float('precio_venta_factura',6,2);
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
        Schema::dropIfExists('detalle_ingreso');
    }
}
