<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Localidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         if(!Schema::hasTable('localidades'))
         {
           Schema::create("localidades",function(Blueprint $table){
               $table->increments("id")->unsigned();
               $table->string("localidad",50);
               $table->integer("id_provincia")->unsigned()->nullable();
               $table->foreign("id_provincia")->references("id")->on("provincias")->onDelete("Cascade");
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
         //Schema::dropIfExists('localidades');
         DB::statement('SET FOREIGN_KEY_CHECKS=1');
     }
}
