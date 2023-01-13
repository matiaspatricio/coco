<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Provincias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       if(!Schema::hasTable('provincias'))
       {
         Schema::create("provincias",function(Blueprint $table){
             $table->increments("id")->unsigned();
             $table->string("provincia",50)->unique();
             $table->integer("id_pais")->unsigned()->nullable();
             $table->foreign("id_pais")->references("id")->on("paises")->onDelete("Cascade");
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
         //Schema::dropIfExists('provincias');
         DB::statement('SET FOREIGN_KEY_CHECKS=1');
     }
}
