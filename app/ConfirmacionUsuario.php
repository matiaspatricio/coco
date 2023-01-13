<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfirmacionUsuario extends Model
{
    public $table = "confirmaciones_emails"; 

    public function get_usuario()
    {
        return $this->hasOne("App\Usuario","id","id_usuario");
    }
}
