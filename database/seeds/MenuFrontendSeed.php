<?php

use Illuminate\Database\Seeder;
use App\MenuFrontend;

class MenuFrontendSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuFrontend::truncate();

        $menu_frontend = new MenuFrontend();
        $menu_frontend->nombre = "¡Nuevos emprendedores!";
        $menu_frontend->enlace = "#";
        $menu_frontend->misma_pestania = true;
        $menu_frontend->orden = 1;
        $menu_frontend->activo = true;
        $menu_frontend->save();

        $menu_frontend = new MenuFrontend();
        $menu_frontend->nombre = "Alimentos";
        $menu_frontend->enlace = "#";
        $menu_frontend->misma_pestania = true;
        $menu_frontend->orden = 2;
        $menu_frontend->activo = true;
        $menu_frontend->save();

        $menu_frontend = new MenuFrontend();
        $menu_frontend->nombre = "Servicios";
        $menu_frontend->enlace = "#";
        $menu_frontend->misma_pestania = true;
        $menu_frontend->orden = 3;
        $menu_frontend->activo = true;
        $menu_frontend->save();

        $menu_frontend = new MenuFrontend();
        $menu_frontend->nombre = "Tecnología";
        $menu_frontend->enlace = "#";
        $menu_frontend->misma_pestania = true;
        $menu_frontend->orden = 4;
        $menu_frontend->activo = true;
        $menu_frontend->save();

        $menu_frontend = new MenuFrontend();
        $menu_frontend->nombre = "Hogar";
        $menu_frontend->enlace = "#";
        $menu_frontend->misma_pestania = true;
        $menu_frontend->orden = 5;
        $menu_frontend->activo = true;
        $menu_frontend->save();

        $menu_frontend = new MenuFrontend();
        $menu_frontend->nombre = "Indumentaria";
        $menu_frontend->enlace = "#";
        $menu_frontend->misma_pestania = true;
        $menu_frontend->orden = 6;
        $menu_frontend->activo = true;
        $menu_frontend->save();
    }
}
