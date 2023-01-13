<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstadosUsuarios extends Migration
{
    public function up()
    {
        Schema::create("estados_usuarios",function(Blueprint $table){
            $table->increments("id")->unsigned();
            $table->string("estado",100);
            $table->string("color",100);
            $table->timestamps();
        });
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists("estados_usuarios");
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
