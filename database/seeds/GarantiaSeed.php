<?php

use Illuminate\Database\Seeder;
use App\Garantia;

class GarantiaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Garantia::truncate();

        $garantia_obj = new Garantia();
        $garantia_obj->garantia = "Sin garantía";
        $garantia_obj->save();

        $garantia_obj = new Garantia();
        $garantia_obj->garantia = "Garantía del vendedor";
        $garantia_obj->save();

        $garantia_obj = new Garantia();
        $garantia_obj->garantia = "Garantía del fabricante";
        $garantia_obj->save();
    }
}
