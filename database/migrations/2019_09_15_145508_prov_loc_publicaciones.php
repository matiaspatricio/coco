<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProvLocPublicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prov_loc_publicaciones', function (Blueprint $table) {
            $table->increments('id');

            $table->integer("id_provincia")->unsigned()->nullable();
            $table->foreign("id_provincia")->references("id")->on("provincias")->onDelete("Cascade");
            
            $table->integer("id_localidad")->unsigned()->nullable();
            $table->foreign("id_localidad")->references("id")->on("localidades")->onDelete("Cascade");

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
        Schema::dropIfExists('prov_loc_publicaciones');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
