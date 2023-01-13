<?php

use Illuminate\Database\Seeder;
use App\Genero;

class GeneroSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genero::truncate();

        $genero_obj = new Genero();
        $genero_obj->genero ="Hombre";
        $genero_obj->save();


        $genero_obj = new Genero();
        $genero_obj->genero ="Mujer";
        $genero_obj->save();

        $genero_obj = new Genero();
        $genero_obj->genero ="Niños";
        $genero_obj->save();

        $genero_obj = new Genero();
        $genero_obj->genero ="Niñas";
        $genero_obj->save();

        $genero_obj = new Genero();
        $genero_obj->genero ="Unisex";
        $genero_obj->save();
    }
}
