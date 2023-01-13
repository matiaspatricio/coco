<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Paises extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
        if(!Schema::hasTable('paises'))
        {
           Schema::create("paises",function(Blueprint $table){
               $table->increments("id")->unsigned();
               $table->string("pais",50)->unique();
               $table->string("prefijo",50);
               $table->timestamps();
           });
        }
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         DB::statement('SET FOREIGN_KEY_CHECKS=0');
         //Schema::dropIfExists('paises');
         DB::statement('SET FOREIGN_KEY_CHECKS=1');
     }
}


