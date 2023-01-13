<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Subcategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategorias', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nombre',50);
            $table->string("imagen",255)->default("default.jpg");
            $table->integer("id_categoria")->unsigned();
            $table->foreign("id_categoria")->references("id")->on("categorias");
            $table->boolean("mostrar_en_menu")->default(false);
            $table->boolean("activa")->default(true);
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
        Schema::dropIfExists('subcategorias');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
