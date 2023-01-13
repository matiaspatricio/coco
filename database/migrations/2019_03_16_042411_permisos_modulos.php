<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PermisosModulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("permisos_modulos",function(Blueprint $table){
            $table->increments("id");
            $table->integer("id_modulo")->unsigned();
            $table->foreign("id_modulo")->references("id")->on("modulos");
            $table->integer("id_rol")->unsigned();
            $table->foreign("id_rol")->references("id")->on("roles");
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
        Schema::dropIfExists('permisos_modulos');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
