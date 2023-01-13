<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $table = "categorias";

    public function get_subcategorias()
    {
        return $this->hasMany("App\Subcategoria","id_categoria","id");
    }

    public function get_subcategorias_activas()
    {
        return $this->hasMany("App\Subcategoria","id_categoria","id")->where("activa",1);
    }

    public function get_subcategorias_activas_en_menu()
    {
        return $this->hasMany("App\Subcategoria","id_categoria","id")->where("activa",1)->where("mostrar_en_menu",1);
    }
}
