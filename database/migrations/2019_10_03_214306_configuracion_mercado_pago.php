<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfiguracionMercadoPago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("configuracion_mercado_pago",function(Blueprint $table){
            $table->increments("id");
            $table->string("CLIENT_ID",255);
            $table->string("CLIENT_SECRET",255);
            $table->string("SHORT_NAME",255);
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
        Schema::dropIfExists("configuracion_mercado_pago");
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
