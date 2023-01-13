<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MediosDePagoPublicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medios_de_pagos_publicaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("id_medio_de_pago")->unsigned();
            $table->foreign("id_medio_de_pago")->references("id")->on("medios_de_pagos");
            $table->integer("id_publicacion")->unsigned();
            $table->foreign("id_publicacion")->references("id")->on("publicaciones");
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('medios_de_pagos_publicaciones');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
