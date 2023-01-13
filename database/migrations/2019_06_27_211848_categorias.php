<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Categorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nombre',50);
            $table->string("imagen",255)->default("default.jpg");
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
        Schema::dropIfExists('categorias');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
