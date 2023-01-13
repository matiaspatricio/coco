<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportePublicacion extends Model
{
    public $table = "reportes_publicaciones";

    public function get_usuario()
    {
        return $this->hasOne("App\Usuario","id","id_usuario");
    }

    public function get_publicacion()
    {
        return $this->hasOne("App\Publicacion","id","id_publicacion");
    }
}
