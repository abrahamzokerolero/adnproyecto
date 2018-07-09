<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilesGeneticosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfiles_geneticos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identificador');
            $table->integer('id_importacion')->unsigned()->nullable();
            $table->integer('id_usuario')->unsigned()->nullable();
            $table->string('id_externo')->nullable();
            $table->integer('id_fuente')->unsigned()->nullable();
            $table->integer('numero_de_marcadores')->default(0);
            $table->integer('numero_de_homocigotos')->default(0);
            $table->boolean('requiere_revision')->default(false);
            $table->integer('id_usuario_reviso')->unsigned()->nullable();
            $table->boolean('es_perfil_repetido')->default(false);
            $table->integer('id_perfil_original')->unsigned()->nullable();
            $table->integer('id_estado_perfil_original')->unsigned()->nullable();
            $table->integer('id_estado')->unsigned()->nullable();
            $table->boolean('desestimado')->default(false);;
            $table->timestamps();

            $table->foreign('id_importacion')->references('id')->on('importaciones_perfiles')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_fuente')->references('id')->on('fuentes')->onDelete('set null');
            $table->foreign('id_estado')->references('id')->on('estados')->onDelete('set null');
            $table->foreign('id_perfil_original')->references('id')->on('perfiles_geneticos')->onDelete('set null');
            $table->foreign('id_usuario_reviso')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_estado_perfil_original')->references('id')->on('estados')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfiles_geneticos');
    }
}