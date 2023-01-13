<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPublicacion extends Model
{
    public $table = "tipos_de_publicaciones";

    const OFERTA= 1;
    const DEMANDA = 2;
}
