<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenuFrontend extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_frontend', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nombre");
            $table->string("enlace");
            $table->boolean("misma_pestania");
            $table->integer("orden");
            $table->boolean("activo");
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
        Schema::dropIfExists('menu_frontend');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
