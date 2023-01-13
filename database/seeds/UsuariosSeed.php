<?php

use Illuminate\Database\Seeder;
use App\Usuario;

class UsuariosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::truncate();

        $usuario_obj = new Usuario();
        $usuario_obj->correo = "administrador@gmail.com";
        $usuario_obj->password = bcrypt("123456");
        $usuario_obj->nombre = "Mario";
        $usuario_obj->apellido = "Olivera";
        $usuario_obj->usuario= "administrador";
        $usuario_obj->id_rol = 1; // ADMINISTRADOR
        $usuario_obj->id_estado_usuario = 1;
        $usuario_obj->correo_confirmado = true;
        $usuario_obj->save();

        $usuario_obj = new Usuario();
        $usuario_obj->correo = "mario.olivera966565@gmail.com";
        $usuario_obj->password = bcrypt("123456");
        $usuario_obj->nombre = "Mario";
        $usuario_obj->apellido = "Olivera";
        $usuario_obj->usuario= "usuario2";
        $usuario_obj->id_rol = 2; // USUARIO FRONTEND
        $usuario_obj->id_estado_usuario = 1;
        $usuario_obj->correo_confirmado = true;
        $usuario_obj->save();

        $usuario_obj = new Usuario();
        $usuario_obj->correo = "mario.olivera966@gmail.com";
        $usuario_obj->password = bcrypt("123456");
        $usuario_obj->nombre = "Mario";
        $usuario_obj->apellido = "Olivera";
        $usuario_obj->usuario= "usuario3";
        $usuario_obj->id_rol = 2; // USUARIO FRONTEND
        $usuario_obj->id_estado_usuario = 1;
        $usuario_obj->correo_confirmado = true;
        $usuario_obj->save();

    }
}
