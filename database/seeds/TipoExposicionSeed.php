<?php

use Illuminate\Database\Seeder;
use App\TipoExposicion;

class TipoExposicionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoExposicion::truncate();

        $tipo_exposicion_obj = new TipoExposicion();
        $tipo_exposicion_obj->tipo_exposicion = "Baja";
        $tipo_exposicion_obj->precio = 0;
        $tipo_exposicion_obj->save();

        $tipo_exposicion_obj = new TipoExposicion();
        $tipo_exposicion_obj->tipo_exposicion = "Media";
        $tipo_exposicion_obj->precio = 100;
        $tipo_exposicion_obj->save();

        $tipo_exposicion_obj = new TipoExposicion();
        $tipo_exposicion_obj->tipo_exposicion = "Alta";
        $tipo_exposicion_obj->precio = 200;
        $tipo_exposicion_obj->save();

    }
}
