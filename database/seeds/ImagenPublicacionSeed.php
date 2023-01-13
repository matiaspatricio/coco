<?php

use Illuminate\Database\Seeder;
use App\ImagenPublicacion;

class ImagenPublicacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImagenPublicacion::truncate();

        for($i=1; $i<=10;$i++)
        {
          $imagen_publicacion = new ImagenPublicacion();
          $imagen_publicacion->file_name = "publicacion_2.png";
          $imagen_publicacion->id_publicacion = $i;
          $imagen_publicacion->save();

          $imagen_publicacion = new ImagenPublicacion();
          $imagen_publicacion->file_name = "publicacion_3.png";
          $imagen_publicacion->id_publicacion = $i;
          $imagen_publicacion->save();

          $imagen_publicacion = new ImagenPublicacion();
          $imagen_publicacion->file_name = "publicacion_4.png";
          $imagen_publicacion->id_publicacion = $i;
          $imagen_publicacion->save();
        }
    }
}
