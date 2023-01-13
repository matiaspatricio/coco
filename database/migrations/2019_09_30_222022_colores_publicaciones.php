<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColoresPublicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colores_publicaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("id_color")->unsigned();
            $table->foreign("id_color")->references("id")->on("colores")->onDelete("cascade");
            $table->integer("id_publicacion")->unsigned();
            $table->foreign("id_publicacion")->references("id")->on("publicaciones")->onDelete("cascade");
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
        Schema::dropIfExists('colores_publicaciones');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
