<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Publicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("publicaciones",function(Blueprint $table){
            $table->increments("id")->unsigned();
            $table->string("titulo");
            $table->longText('descripcion');
            $table->double("cantidad");
            $table->integer("id_estado_publicacion")->unsigned();
            $table->foreign("id_estado_publicacion")->references("id")->on("estados_publicaciones");
            $table->double("precio_desde");
            $table->double("precio_hasta");
            $table->date("fecha_vencimiento")->nullable();
            $table->string("imagen_principal")->default("default.jpg");
            $table->integer("id_categoria")->unsigned();
            $table->foreign("id_categoria")->references("id")->on("categorias");
            $table->integer("id_subcategoria")->unsigned();
            $table->foreign("id_subcategoria")->references("id")->on("subcategorias");
            $table->string("marca")->nullable();
            $table->string("modelo")->nullable();
            $table->string("version")->nullable();
            $table->string("link_video_youtube")->nullable();

            $table->integer("id_genero")->unsigned()->nullable();
            $table->foreign("id_genero")->references("id")->on("generos")->onDelete("set null");

            $table->integer("id_talle")->unsigned()->nullable();
            $table->foreign("id_talle")->references("id")->on("talles")->onDelete("set null");

            $table->double("cantidad_minima")->nullable();

            $table->integer("visitas")->default(0);

            $table->integer("id_tipo_operacion")->unsigned();
            $table->foreign("id_tipo_operacion")->references("id")->on("tipos_operaciones")->onDelete("Cascade");

            $table->integer("id_tipo_exposicion")->unsigned();
            $table->foreign("id_tipo_exposicion")->references("id")->on("tipos_exposiciones")->onDelete("Cascade");

            $table->integer("id_tipo_exposicion_a_poner")->unsigned()->nullable();
            $table->foreign("id_tipo_exposicion_a_poner")->references("id")->on("tipos_exposiciones")->onDelete("set null");

            $table->string("id_mercado_pago")->nullable();

            $table->integer("precio_tipo_exposicion")->nullable();

            $table->enum("estado_pago_exposicion",["pendiente","pagado","rechazado"])->nullable();

            $table->integer("id_garantia")->unsigned();
            $table->foreign("id_garantia")->references("id")->on("garantias")->onDelete("Cascade");

            $table->enum("condicion",["Nuevo","Usado"]);
            $table->enum("tipo",["Bienes","Servicios"]);

            $table->integer("id_tipo_publicacion")->unsigned()->nullable();
            $table->foreign("id_tipo_publicacion")->references("id")->on("tipos_de_publicaciones")->onDelete("set null");

            $table->integer("id_usuario")->unsigned();
            $table->foreign("id_usuario")->references("id")->on("usuarios");
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
        Schema::dropIfExists('publicaciones');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
