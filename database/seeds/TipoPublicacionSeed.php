<?php

use Illuminate\Database\Seeder;
use App\TipoPublicacion;

class TipoPublicacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoPublicacion::truncate();

        $tipo_publicacion_obj = new TipoPublicacion();
        $tipo_publicacion_obj->tipo = "Oferta";
        $tipo_publicacion_obj->color = "#28a745";
        $tipo_publicacion_obj->save();

        $tipo_publicacion_obj = new TipoPublicacion();
        $tipo_publicacion_obj->tipo = "Demanda";
        $tipo_publicacion_obj->color = "#ffc107";
        $tipo_publicacion_obj->save();
    }
}
