<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FavoritosPublicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('favoritos_publicaciones', function (Blueprint $table) {
             $table->increments('id');
             $table->integer("id_publicacion")->unsigned();
             $table->foreign("id_publicacion")->references("id")->on("publicaciones");
             $table->integer("id_usuario")->unsigned();
             $table->foreign("id_usuario")->references("id")->on("usuarios");
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
         Schema::dropIfExists('favoritos_publicaciones');
         DB::statement('SET FOREIGN_KEY_CHECKS=1');
     }
}
