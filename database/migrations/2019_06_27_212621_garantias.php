<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Garantias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('garantias', function (Blueprint $table) {
             $table->increments('id')->unsigned();
             $table->string("garantia",100)->unique();
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
         Schema::dropIfExists('garantias');
         DB::statement('SET FOREIGN_KEY_CHECKS=1');
     }
}
