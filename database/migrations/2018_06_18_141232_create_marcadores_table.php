<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarcadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcadores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('id_usuario_registro')->unsigned()->nullable();
            $table->integer('id_usuario_edito')->unsigned()->nullable();
            $table->integer('id_tipo_de_marcador')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('id_usuario_registro')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_usuario_edito')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_tipo_de_marcador')->references('id')->on('tipos_de_marcadores')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marcadores');
    }
}
