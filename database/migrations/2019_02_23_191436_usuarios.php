<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->string('apellido',50);
            $table->string('correo')->unique();
            $table->string('usuario')->unique();
            $table->string('password');

            $table->integer("id_pais")->unsigned()->nullable();
            $table->foreign("id_pais")->references("id")->on("paises")->onDelete("set null");

            $table->integer("id_provincia")->unsigned()->nullable();
            $table->foreign("id_provincia")->references("id")->on("provincias")->onDelete("set null");

            $table->integer("id_localidad")->unsigned()->nullable();
            $table->foreign("id_localidad")->references("id")->on("localidades")->onDelete("set null");

            $table->string("codigo_postal")->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();

            $table->integer("id_rol")->nullable()->unsigned();
            $table->foreign("id_rol")->references("id")->on("roles")->onDelete("set null");
            $table->string("foto_perfil",255)->default("default.jpg");
            $table->integer("id_estado_usuario")->unsigned();
            $table->foreign("id_estado_usuario")->references("id")->on("estados_usuarios");
            $table->boolean("correo_confirmado")->default(false);
            $table->boolean("eliminado")->default(false);
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
        Schema::dropIfExists('usuarios');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
