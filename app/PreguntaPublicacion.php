<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreguntaPublicacion extends Model
{
    public $table = "preguntas_publicaciones";

    public function get_publicacion()
    {
        return $this->hasOne("App\Publicacion","id","id_publicacion");
    }

    public function get_usuario_pregunta()
    {
        return $this->hasOne("App\Usuario","id","id_usuario");
    }
}
