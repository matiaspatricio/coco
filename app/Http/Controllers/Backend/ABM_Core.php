<?php
namespace App\Http\Controllers\Backend;

/*
CLASE CORE PARA LOS ABMS :)
*/

use App\Http\Controllers\Backend\Controller;
use Illuminate\Support\Facades\View;

class ABM_Core extends Controller
{
    protected $link_controlador;
    protected $carpeta_views;
    protected $text_no_search ="Registro no encontrado";
    protected $entity ="Entidad";
    protected $title_page = "Titulo de la página";
    protected $columns = [];

    protected $add_active = true;
    protected $edit_active = true;
    protected $delete_active = true;
    protected $watch_active = false;

    protected $is_ajax = true;

    protected $config_buttons = [
        "add"=>[
            "icon"=>"fa fa-plus",
            "class"=>"btn btn-primary btn-round",
            "title"=>"Agregar",
        ],
        "edit"=>[
            "icon"=>"fa fa-edit",
            "class"=>"btn btn-info btn-round",
            "title"=>"Editar"
        ],
        "delete"=>[
            "icon"=>"fa fa-times",
            "class"=>"btn btn-danger btn-round",
            "title"=>"Eliminar"
        ],
        "cancel"=>[
            "icon"=>"fa fa-close",
            "class"=>"btn btn-secondary btn-round",
            "title"=>"Cancelar"
        ],
        "go_back"=>[
            "icon"=>"fa fa-reply",
            "class"=>"btn btn-secondary btn-round",
            "title"=>"Volver"
        ],
        "save"=>[
            "icon"=>"fa fa-save",
            "class"=>"btn btn-primary btn-round",
            "title"=>"Guardar"
        ],
        "watch"=>[
            "icon"=>"fa fa-eye",
            "class"=>"btn btn-info btn-round",
            "title"=>"Ver",
        ]
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

    protected function share_parameters()
    {
        View::share("config_buttons",$this->config_buttons);
        View::share("abm_messages",$this->abm_messages);
        View::share("link_controlador",$this->link_controlador);
        View::share("entity",$this->entity);
        View::share("title_page",$this->title_page);
        View::share("columns",$this->columns);
        View::share("add_active",$this->add_active);
        View::share("edit_active",$this->edit_active);
        View::share("delete_active",$this->delete_active);
        View::share("is_ajax",$this->is_ajax);
    }
}