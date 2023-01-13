<?php

namespace App\Http\Controllers\Backend\MensajesContacto;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\ABM_Core;

use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\MensajeContacto;

class MensajesContactoController extends ABM_Core
{
    public function __construct()
    {
        $this->link_controlador = url('/backend/mensajes_contacto').'/';
        $this->carpeta_views = "backend.mensajes_contacto.";

        $this->entity ="Mensaje de Contacto";
        $this->title_page = "Mensajes de Contacto";

        $this->columns = [
          ["name"=>"Nombre","reference"=>"mensajes_contacto.nombre"],
          ["name"=>"Apellido","reference"=>"mensajes_contacto.apellido"],
          ["name"=>"Correo","reference"=>"mensajes_contacto.correo"],
          ["name"=>"Asunto","reference"=>"mensajes_contacto.asunto"],
          ["name"=>"Enviado","reference"=>"mensajes_contacto.enviado"],
          ["name"=>"Fecha Hora","reference"=>DB::raw("DATE_FORMAT(mensajes_contacto.created_at,'%d/%m/%Y %H:%i')")],
          ["name"=>"Acciones","reference"=>null]
        ];

        $this->is_ajax = true;
        $this->add_active = false;
        $this->edit_active = false;
        $this->delete_active = false;
        $this->watch_active = true;
    }

    public function index(Request $request)
    {
        $this->share_parameters();
        return View($this->carpeta_views."browse");
    }

    public function get_listado_dt(Request $request)
    {
        $consulta_orm_principal = DB::table("mensajes_contacto")
        ->select(
            "mensajes_contacto.*"
        );

    	$totalData = $consulta_orm_principal->count();

        $totalFiltered = $totalData;

        $search = $request->input("search");
        $start = $request->input('start');
        $length = $request->input('length');
        $order = $request->input('order');

        $resultado = array();

        if(!empty($search['value']))
        {

          $consulta_orm_principal = $consulta_orm_principal
           ->where(function($query) use($search){
               $query->where("mensajes_contacto.nombre","like","%".$search['value']."%")
               ->orWhere("mensajes_contacto.apellido","like","%".$search['value']."%")
               ->orWhere("mensajes_contacto.correo","like","%".$search['value']."%")
               ->orWhere("mensajes_contacto.asunto","like","%".$search['value']."%")
               ->orWhere("mensajes_contacto.enviado","like","%".$search['value']."%")
               ->orWhere(DB::raw("DATE_FORMAT(mensajes_contacto.created_at,'%d/%m/%Y %H:%i')"),"like","%".$search['value']."%");
           });
        }

        $totalFiltered=$consulta_orm_principal->count();
        $consulta_orm_principal = $consulta_orm_principal->take($length)->skip($start);

        $columna_a_ordenar = (int)$order[0]["column"];

        if(isset($this->columns[$columna_a_ordenar]) && $this->columns[$columna_a_ordenar]["reference"] != null){
          $resultado = $consulta_orm_principal->orderBy($this->columns[$columna_a_ordenar]["reference"],$order[0]["dir"])->get();
        }
        else{
          $resultado = $consulta_orm_principal->orderBy("id","desc")->get();
        }

        $data= array();

        foreach($resultado as $result_row)
        {
            $row_of_data = array();

            $row_of_data[]=strip_tags($result_row->nombre);
            $row_of_data[]=strip_tags($result_row->apellido);
            $row_of_data[]=strip_tags($result_row->correo);
            $row_of_data[]=strip_tags($result_row->asunto);

            if($result_row->enviado == true){
            	$row_of_data[]='<span class="badge text-white" style="background-color: #28a745">Si</span>';
            }else{
            	$row_of_data[]='<span class="badge text-white" style="background-color: #dc3545">No</span>';
            }

            $fecha_hora = \DateTime::createFromFormat("Y-m-d H:i:s",$result_row->created_at);
            $fecha_hora = $fecha_hora->format("d/m/Y H:i");
            
            $row_of_data[]=strip_tags($fecha_hora);

            $buttons_actions = "<div class='form-button-action'>";

            if($this->watch_active)
            {
                if($this->is_ajax)
                {
                    $buttons_actions .=
                    "<button onclick='abrir_modal_ver(".$result_row->id.")' type='button' data-toggle='tooltip' title='' class='btn-sm ".$this->config_buttons["edit"]["class"]."' data-original-title='".$this->config_buttons["edit"]["title"]."'>
                        <i class='".$this->config_buttons["watch"]["icon"]."'></i>
                    </button>";
                }
                else{
                    $buttons_actions .=
                    "<a href='".$this->link_controlador."ver/".$result_row->id."' data-toggle='tooltip' title='' class='btn-sm ".$this->config_buttons["watch"]["class"]."' data-original-title='".$this->config_buttons["watch"]["title"]."'>
                        <i class='".$this->config_buttons["watch"]["icon"]."'></i>
                    </a>";
                }
            }
            
            if($this->edit_active)
            {
                if($this->is_ajax)
                {
                    $buttons_actions .=
                    "<button onclick='abrir_modal_editar(".$result_row->id.")' type='button' data-toggle='tooltip' title='' class='btn-sm ".$this->config_buttons["edit"]["class"]."' data-original-title='".$this->config_buttons["edit"]["title"]."'>
                        <i class='".$this->config_buttons["edit"]["icon"]."'></i>
                    </button>";
                }
                else{
                    $buttons_actions .=
                    "<a href='".$this->link_controlador."editar/".$result_row->id."' data-toggle='tooltip' title='' class='btn-sm ".$this->config_buttons["edit"]["class"]."' data-original-title='".$this->config_buttons["edit"]["title"]."'>
                        <i class='".$this->config_buttons["edit"]["icon"]."'></i>
                    </a>";
                }
            }

            if($this->delete_active)
            {
                $buttons_actions.=
                "<button onclick='eliminar(".$result_row->id.")' type='button' data-toggle='tooltip' title='' class='btn-sm ".$this->config_buttons["delete"]["class"]."' data-original-title='".$this->config_buttons["delete"]["title"]."'>
                    <i class='".$this->config_buttons["delete"]["icon"]."'></i>
                </button>";
            }

            $buttons_actions.="</div>";


            $row_of_data[]=$buttons_actions;

            $data[]=$row_of_data;
        }

	      $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return response()->json($json_data);
    }

    public function get(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");

        $categoria_blog_obj = MensajeContacto::find($id);
        
        if($categoria_blog_obj)
        {
            $response_estructure->set_response(true);
            $response_estructure->set_data($categoria_blog_obj);
        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error($this->text_no_search);
        }
        

        return response()->json($response_estructure->get_response_array());
    }

    public function ver(Request $request,$id)
    {
        $this->title_page = $this->entity;
        $this->share_parameters();

        $row_obj = MensajeContacto::find($id);

        if($row_obj)
        {
            return View($this->carpeta_views."view")
            ->with("row_obj",$row_obj);
        }
    }
}
