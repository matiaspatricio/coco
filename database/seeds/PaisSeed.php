<?php

use Illuminate\Database\Seeder;
use App\Pais;

class PaisSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $hay_paises = Pais::first();

      if(!$hay_paises)
      {
        Pais::truncate();

        $pais_obj = new Pais();
        $pais_obj->pais ='Argentina';
        $pais_obj->prefijo = "+54";
        $pais_obj->save();
      }
    }
}