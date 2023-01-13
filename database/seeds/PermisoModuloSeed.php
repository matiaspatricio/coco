<?php

use Illuminate\Database\Seeder;
use App\PermisoModulo;
use App\Modulo;

class PermisoModuloSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermisoModulo::truncate();

        $permiso_modulo_obj = new PermisoModulo();
        $permiso_modulo_obj->id_modulo= 1; // usuarios
        $permiso_modulo_obj->id_rol = 1; // administrador
        $permiso_modulo_obj->save();
    }
}
