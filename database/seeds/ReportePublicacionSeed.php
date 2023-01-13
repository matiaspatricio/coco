<?php

use Illuminate\Database\Seeder;
use App\ReportePublicacion;

class ReportePublicacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReportePublicacion::truncate();

        $reporte_publicacion_obj = new ReportePublicacion();
        $reporte_publicacion_obj->titulo = "Prueba";
        $reporte_publicacion_obj->descripcion = "Esto es una prueba";
        $reporte_publicacion_obj->id_usuario = 1;
        $reporte_publicacion_obj->id_publicacion = 2;	
        $reporte_publicacion_obj->controlado = false;
        $reporte_publicacion_obj->enviado = false;
        $reporte_publicacion_obj->save();

    }
}
