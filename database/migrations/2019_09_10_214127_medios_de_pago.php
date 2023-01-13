<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MediosDePago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('medios_de_pagos', function (Blueprint $table) {
             $table->increments('id');
             $table->string("medio_de_pago");
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
         Schema::dropIfExists('medios_de_pagos');
         DB::statement('SET FOREIGN_KEY_CHECKS=1');
     }
}
