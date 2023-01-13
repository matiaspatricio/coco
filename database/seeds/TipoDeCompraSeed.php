<?php

use Illuminate\Database\Seeder;
use App\TipoDeCompra;

class TipoDeCompraSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDeCompra::truncate();

        $tipo_compra_obj = new TipoDeCompra();
        $tipo_compra_obj->tipo = "Compra directa";
        $tipo_compra_obj->save();

        $tipo_compra_obj = new TipoDeCompra();
        $tipo_compra_obj->tipo = "Compra en espera de reunir cantidades";
        $tipo_compra_obj->save();
    }
}
