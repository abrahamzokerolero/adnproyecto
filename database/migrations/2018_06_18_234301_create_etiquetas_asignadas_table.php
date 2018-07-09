<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtiquetasAsignadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etiquetas_asignadas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_etiqueta')->unsigned();
            $table->integer('id_perfil_genetico')->unsigned();

            $table->timestamps();
            $table->foreign('id_etiqueta')->references('id')->on('etiquetas')->onDelete('cascade');
            $table->foreign('id_perfil_genetico')->references('id')->on('perfiles_geneticos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etiquetas_asignadas');
    }
}
