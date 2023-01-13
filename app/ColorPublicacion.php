<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorPublicacion extends Model
{
    public $table = "colores_publicaciones";

    public function get_color()
    {
        return $this->hasOne("App\Color","id","id_color");
    }

    public function get_publicacion()
    {
        return $this->hasOne("App\Publicacion","id","id_publicacion");
    }
}
