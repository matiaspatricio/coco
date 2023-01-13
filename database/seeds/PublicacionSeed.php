<?php

use Illuminate\Database\Seeder;
use App\Publicacion;

class PublicacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Publicacion::truncate();

        for($i=1; $i<=10;$i++)
        {
            $publicacion_obj = new Publicacion();
            $publicacion_obj->titulo = "Vendo Remeras lisas 100 unidades";
            $publicacion_obj->descripcion = "Vendo remeras lisas geniales";
            $publicacion_obj->cantidad = 100;
            $publicacion_obj->id_estado_publicacion = 2;
            $publicacion_obj->precio_desde = 500;
            $publicacion_obj->precio_hasta = 500;
            $publicacion_obj->fecha_vencimiento = "2019-10-17";
            $publicacion_obj->imagen_principal = "publicacion_1.png";
            $publicacion_obj->id_categoria = 1;
            $publicacion_obj->id_subcategoria = 1;
            $publicacion_obj->modelo = null;
            $publicacion_obj->version = null;
            $publicacion_obj->cantidad_minima = 1;
            $publicacion_obj->id_tipo_operacion = 1;
            $publicacion_obj->id_tipo_exposicion = 1;
            $publicacion_obj->id_garantia = 1;
            $publicacion_obj->condicion = "Nuevo";
            $publicacion_obj->tipo = "Bienes";
            $publicacion_obj->id_tipo_publicacion = 1;
            $publicacion_obj->id_usuario = 2;
            $publicacion_obj->save();
        }

    }
}
