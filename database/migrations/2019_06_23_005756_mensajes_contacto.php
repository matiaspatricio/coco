<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MensajesContacto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("mensajes_contacto",function(Blueprint $table){
            $table->increments("id");
            $table->string("nombre");
            $table->string("apellido");
            $table->string("correo");
            $table->string("asunto");
            $table->text("mensaje");
            $table->boolean("enviado")->default(false);
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
        Schema::dropIfExists('mensajes_contacto');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
