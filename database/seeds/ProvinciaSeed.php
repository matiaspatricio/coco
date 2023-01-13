<?php

use Illuminate\Database\Seeder;
use App\Provincia;

class ProvinciaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hay_provincias = Provincia::first();

        if(!$hay_provincias)
        {
          Provincia::truncate();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Buenos Aires';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Buenos Aires-GBA';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Capital Federal';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Catamarca';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Chaco';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Chubut';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Córdoba';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Corrientes';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Entre Ríos';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Formosa';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Jujuy';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'La Pampa';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'La Rioja';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Mendoza';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Misiones';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Neuquén';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Río Negro';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Salta';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'San Juan';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'San Luis';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Santa Cruz';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Santa Fe';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Santiago del Estero';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Tierra del Fuego';
          $provincia_obj->save();

          $provincia_obj = new Provincia();
          $provincia_obj->id_pais = 1;
          $provincia_obj->provincia = 'Tucumán';
          $provincia_obj->save();
        }
    }
}
