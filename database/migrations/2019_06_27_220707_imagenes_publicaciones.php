<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImagenesPublicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenes_publicaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_name',50);
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
        Schema::dropIfExists('imagenes_publicaciones');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
