<?php
namespace App\Http\Controllers\Backend\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\ABM_Core;

use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Configuracion;

class ConfiguracionController extends ABM_Core
{
    public function __construct()
    {
        $this->link_controlador = url('/backend/configuraciones').'/';
        $this->carpeta_views = "backend.configuraciones.";

        $this->entity ="Configuracion";
        $this->title_page = "Configuraciones";

        $this->edit_active = true;
        $this->add_active = false;
        $this->delete_active = false;

        $this->columns = [
          ["name"=>"Clave","reference"=>"configuraciones.clave"],
          ["name"=>"Valor","reference"=>"configuraciones.valor"],
          ["name"=>"Acciones","reference"=>null]
        ];

        $this->is_ajax = false;
    }

    public function index(Request $request)
    {
        $this->share_parameters();
        return View($this->carpeta_views."browse");
    }

    public function get_listado_dt(Request $request)
    {
        $consulta_orm_principal = DB::table("configuraciones")
        ->select(
            "configuraciones.*"
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
               $query->where("configuraciones.clave","like","%".$search['value']."%")
               ->orWhere("configuraciones.valor","like","%".$search['value']."%");
           });
        }

        $consulta_orm_principal = $consulta_orm_principal->take($length)->skip($start);
        $totalFiltered=$consulta_orm_principal->count();

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

            $row_of_data[]=strip_tags($result_row->clave);
            $row_of_data[]=strip_tags(ucwords($result_row->valor));

            $buttons_actions = "<div class='form-button-action'>";

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
                "<button onclick='abrir_modal_eliminar(".$result_row->id.")' type='button' data-toggle='tooltip' title='' class='btn-sm ".$this->config_buttons["delete"]["class"]."' data-original-title='".$this->config_buttons["delete"]["title"]."'>
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

    public function editar(Request $request,$id)
    {
        $this->title_page = $this->config_buttons["edit"]["title"]." ".$this->entity;
        $this->share_parameters();

        $row_obj = Configuracion::find($id);

        if($row_obj)
        {
          return View($this->carpeta_views."edit")
          ->with("row_obj",$row_obj);
        }
    }

    public function update(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");

        $row_obj = Configuracion::find($id);

        if($row_obj)
        {
            $valor = trim($request->input("valor"));

            $row_obj->valor = $valor;
            $row_obj->save();

            $response_estructure->set_response(true);

        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error($this->text_no_search);
        }

        return response()->json($response_estructure->get_response_array());
    }
}
