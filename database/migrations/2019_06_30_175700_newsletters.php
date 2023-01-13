<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Newsletters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('newsletters', function (Blueprint $table) {
        $table->increments('id');
        $table->string("correo",150)->unique();
        $table->enum("activo",["si","no"])->default("si");
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
        Schema::dropIfExists('newsletters');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}