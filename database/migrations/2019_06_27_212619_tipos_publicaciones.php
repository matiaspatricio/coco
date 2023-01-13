<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TiposPublicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_de_publicaciones', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('tipo',100);
            $table->string('color',100);
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
        Schema::dropIfExists('tipos_de_publicaciones');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
