<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $config_buttons = [
        "add"=>[
            "icon"=>"fa fa-plus",
            "class"=>"btn btn-primary",
            "title"=>"Agregar",
        ], 
        "edit"=>[
            "icon"=>"fa fa-edit",
            "class"=>"btn btn-sm btn-info",
            "title"=>"Editar"
        ], 
        "delete"=>[
            "icon"=>"fa fa-trash-o",
            "class"=>"btn btn-sm btn-danger",
            "title"=>"Eliminar"
        ],
        "go_back"=>[
            "icon"=>"fa fa-mail-reply",
            "class"=>"btn btn-secondary",
            "title"=>"Volver"
        ],
        "save"=>[
            "icon"=>"fa fa-save",
            "class"=>"btn btn-primary",
            "title"=>"Guardar"
        ], 
    ];

    protected $abm_messages = [
        
        "delete"=> [
            "title"=>"Eliminar Registro",
            "text"=>"¿Desea eliminar el registro seleccionado?",
            "description"=>"Se ha eliminado correctamente el registro",
            "confirmButtonText"=>"Si, eliminar",
            "cancelButtonText"=>"No, cancelar!",
            "success_text"=>"Eliminado!",
            "success_description"=>"Se ha eliminado correctamente el registro",
        ],
        
        "success_edit"=>[
            "title"=>"Editado!",
            "description"=>"Se ha editado correctamente el registro",
        ],

        "success_add"=>[
            "title"=>"Agregado!",
            "description"=>"Se ha agregado correctamente el registro",
        ],
    ];

    public function __construct()
    {
        View::share("config_buttons",$this->config_buttons);
        View::share("abm_messages",$this->abm_messages);
    }
}
