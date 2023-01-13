<?php

use Illuminate\Database\Seeder;
use App\Modulo;

class ModuloSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modulo::truncate();

        $modulo_obj = new Modulo();
        $modulo_obj->modulo = "Usuarios";
        $modulo_obj->activo = true;
        $modulo_obj->save();
    }
}
