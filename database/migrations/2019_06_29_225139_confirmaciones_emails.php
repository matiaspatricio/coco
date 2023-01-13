<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfirmacionesEmails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmaciones_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->integer("id_usuario")->unsigned();
            $table->foreign("id_usuario")->references("id")->on("usuarios");
            $table->boolean("usado")->default(false);
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
        Schema::dropIfExists('confirmaciones_emails');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
