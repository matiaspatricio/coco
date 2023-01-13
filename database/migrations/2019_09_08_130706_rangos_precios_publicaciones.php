<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RangosPreciosPublicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rangos_precios_publicaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("cantidad_desde");
            $table->integer("cantidad_hasta");
            $table->double("precio");
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
        Schema::dropIfExists('rangos_precios_publicaciones');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
