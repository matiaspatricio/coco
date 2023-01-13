<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::truncate();

        $rol_obj = new Rol();
        $rol_obj->rol ="Administrador";
        $rol_obj->save();

        $rol_obj = new Rol();
        $rol_obj->rol ="Usuario Frontend";
        $rol_obj->save();
    }
}
