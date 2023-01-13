<?php

use Illuminate\Database\Seeder;
use App\TipoOperacion;

class TipoOperacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoOperacion::truncate();

        $tipo_operacion_obj = new TipoOperacion();
        $tipo_operacion_obj->tipo_operacion = "Compra directa";
        $tipo_operacion_obj->save();

        $tipo_operacion_obj = new TipoOperacion();
        $tipo_operacion_obj->tipo_operacion = "Compra en lote";
        $tipo_operacion_obj->save();
    }
}
