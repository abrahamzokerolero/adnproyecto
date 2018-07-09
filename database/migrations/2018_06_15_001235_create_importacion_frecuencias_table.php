<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportacionFrecuenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importacion_frecuencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identificador');
            $table->string('nombre');
            $table->integer('id_usuario')->unsigned()->nullable();
            $table->integer('id_estado')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_estado')->references('id')->on('estados')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('importacion_frecuencias');
    }
}
