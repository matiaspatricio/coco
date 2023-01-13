<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Generos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generos', function (Blueprint $table) {
            $table->increments('id');
            $table->string("genero");
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
        Schema::dropIfExists('generos');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
