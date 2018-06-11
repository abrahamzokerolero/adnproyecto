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
            $table->string('id_externo');
            $table->string('id_interno');
            $table->string('contacto_fuente');
            $table->string('correo_fuente');
            $table->string('telefono1_fuente');
            $table->string('telefono2_fuente');
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
