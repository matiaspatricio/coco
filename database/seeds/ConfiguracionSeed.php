<?php

use Illuminate\Database\Seeder;
use App\Configuracion;

class ConfiguracionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuracion::truncate();

        $configuracion_obj = new Configuracion();
        $configuracion_obj->clave = "correo_recibe_contacto";
        $configuracion_obj->valor = "mario.olivera96@gmail.com";
        $configuracion_obj->save();

        $configuracion_obj = new Configuracion();
        $configuracion_obj->clave = "correo_recibe_reporte";
        $configuracion_obj->valor = "mario.olivera96@gmail.com";
        $configuracion_obj->save();

        $configuracion_obj = new Configuracion();
        $configuracion_obj->clave = "correo_prueba_newsletter";
        $configuracion_obj->valor = "mario.olivera96@gmail.com";
        $configuracion_obj->save();
    }
}
