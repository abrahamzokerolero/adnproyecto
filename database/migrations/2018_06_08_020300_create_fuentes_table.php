<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique(); 
            $table->string('id_interno')->unique();
            $table->string('id_externo')->nullable();
            $table->string('contacto_fuente')->nullable();
            $table->string('correo_fuente')->nullable();
            $table->string('telefono1_fuente')->nullable();
            $table->string('telefono2_fuente')->nullable();
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
        Schema::dropIfExists('fuentes');
    }
}
