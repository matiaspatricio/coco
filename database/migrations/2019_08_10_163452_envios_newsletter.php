<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EnviosNewsletter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envios_newsletter', function (Blueprint $table) {
            $table->increments('id');
            $table->string("asunto");
            $table->longText("mensaje");
            $table->integer("cantidad_veces_enviado")->default(0);
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
        Schema::dropIfExists('envios_newsletter');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
