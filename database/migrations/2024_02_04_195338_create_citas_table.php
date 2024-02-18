<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_servicio');
            $table->foreign('id_servicio')->references('id')->on('servicios');
            $table->dateTime('fecha_hora');
            $table->decimal('km',6,2);
            $table->string('descripcion')->nullable();
            $table->string('estado', 10);
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
        Schema::dropIfExists('citas');
    }
}
