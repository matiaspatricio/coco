<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Configuraciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('configuraciones', function (Blueprint $table) {
           $table->increments('id');
           $table->string("clave",50)->unique();
           $table->text("valor");
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
         Schema::dropIfExists('configuraciones');
         DB::statement('SET FOREIGN_KEY_CHECKS=1');
     }
}
