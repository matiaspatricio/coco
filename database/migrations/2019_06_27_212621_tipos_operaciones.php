<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TiposOperaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('tipos_operaciones', function (Blueprint $table) {
             $table->increments('id')->unsigned();
             $table->string("tipo_operacion",100)->unique();
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
         Schema::dropIfExists('tipos_operaciones');
         DB::statement('SET FOREIGN_KEY_CHECKS=1');
     }
}
