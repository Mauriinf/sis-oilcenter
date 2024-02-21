<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('email');
            $table->string('ci');
            $table->string('nombres');
            $table->string('paterno')->nullable();
            $table->string('materno')->nullable();
            $table->string('telefono')->nullable();;
            $table->string('direccion')->nullable();
            $table->date('fec_nac')->nullable();
            $table->boolean('estado');
            $table->char('sexo',1);
            // Campos adicionales para el rol de cliente
            $table->string('placa_auto')->nullable();
            $table->string('modelo_auto')->nullable();
            // Campos adicionales para el rol de proveedor
            $table->string('nombre_proveedor')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
