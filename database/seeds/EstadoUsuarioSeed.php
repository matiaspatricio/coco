<?php

use Illuminate\Database\Seeder;
use App\EstadoUsuario;

class EstadoUsuarioSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoUsuario::truncate();

        $estado_usuario = new EstadoUsuario();
        $estado_usuario->estado = "activo";
        $estado_usuario->color ="#28a745";
        $estado_usuario->save();

        $estado_usuario = new EstadoUsuario();
        $estado_usuario->estado = "no activo";
        $estado_usuario->color ="#dc3545";
        $estado_usuario->save();
    }
}
