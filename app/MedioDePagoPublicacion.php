<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedioDePagoPublicacion extends Model
{
    public $table = "medios_de_pagos_publicaciones";

    public function get_medio_de_pago()
    {
        return $this->hasOne("App\MedioDePago","id","id_medio_de_pago");
    }
}
