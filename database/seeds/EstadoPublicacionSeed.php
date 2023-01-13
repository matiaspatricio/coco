<?php

use Illuminate\Database\Seeder;
use App\EstadoPublicacion;

class EstadoPublicacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoPublicacion::truncate();

        $estado_publicacion_obj = new EstadoPublicacion();
        $estado_publicacion_obj->estado = "pendiente";
        $estado_publicacion_obj->color ="#ffc107";
        $estado_publicacion_obj->save();

        $estado_publicacion_obj = new EstadoPublicacion();
        $estado_publicacion_obj->estado = "activa";
        $estado_publicacion_obj->color ="#28a745";
        $estado_publicacion_obj->save();

        $estado_publicacion_obj = new EstadoPublicacion();
        $estado_publicacion_obj->estado = "cancelada";
        $estado_publicacion_obj->color ="#dc3545";
        $estado_publicacion_obj->save();

        $estado_publicacion_obj = new EstadoPublicacion();
        $estado_publicacion_obj->estado = "cumplida";
        $estado_publicacion_obj->color ="#007bff";
        $estado_publicacion_obj->save();
    }
}
