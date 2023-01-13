<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SliderHome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_home', function (Blueprint $table) {
            $table->increments('id');
            $table->string("small_title");
            $table->string("title");
            $table->string("imagen")->default("default.jpg");
            $table->string("link_button")->nullable();
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
        Schema::dropIfExists('slider_home');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
