<?php

namespace App\Http\Controllers\Backend\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\ABM_Core;

use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use App\MenuFrontend;

class MenuFrontendController extends ABM_Core
{
	public function __construct()
    {
        $this->link_controlador = url('/backend/menu_frontend').'/';
        $this->carpeta_views = "backend.menu_frontend.";

        $this->entity ="Menú Frontend";
        $this->title_page = "Menú Frontend";

        $this->columns = [
          ["name"=>"Nombre","reference"=>"menu_frontend.nombre"],
          ["name"=>"Enlace","reference"=>"menu_frontend.enlace"],
          ["name"=>"Misma pestaña","reference"=>"menu_frontend.misma_pestania"],
          ["name"=>"Orden","reference"=>"menu_frontend.orden"],
          ["name"=>"activo","reference"=>"menu_frontend.activo"],
          ["name"=>"Acciones","reference"=>null]
        ];

        $this->is_ajax = true;
    }
    
    public function index(Request $request)
    {
        $this->share_parameters();
        return View($this->carpeta_views."browse");
    }

    public function get_listado_dt(Request $request)
    {
        $consulta_orm_principal = DB::table("menu_frontend")
        ->select(
            "menu_frontend.*"
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
               $query->where("menu_frontend.nombre","like","%".$search['value']."%")
               ->orWhere("menu_frontend.id","like","%".$search['value']."%");
           });
        }

        $totalFiltered=$consulta_orm_principal->count();
        $consulta_orm_principal = $consulta_orm_principal->take($length)->skip($start);

        /*
        $columna_a_ordenar = (int)$order[0]["column"];

        if(isset($this->columns[$columna_a_ordenar]) && $this->columns[$columna_a_ordenar]["reference"] != null){
          $resultado = $consulta_orm_principal->orderBy($this->columns[$columna_a_ordenar]["reference"],$order[0]["dir"])->get();
        }
        else{*/
          $resultado = $consulta_orm_principal->orderBy("orden","asc")->get();
        //}

        $data= array();

        foreach($resultado as $result_row)
        {
            $row_of_data = array();

            $row_of_data[]=strip_tags($result_row->nombre);
            $row_of_data[]=strip_tags($result_row->enlace);

            if($result_row->misma_pestania == true){
            	$row_of_data[]='<span class="badge text-white" style="background-color: #28a745">Si</span>';
            }else{
            	$row_of_data[]='<span class="badge text-white" style="background-color: #dc3545">No</span>';
            }

            $row_of_data[]=
            '<button class="btn btn-sm btn-round btn-primary" onclick="mover_arriba('.$result_row->id.')"><i class="fa fa-arrow-up"></i></button>
            <button class="btn btn-sm btn-round btn-danger" onclick="mover_abajo('.$result_row->id.')"><i class="fa fa-arrow-down"></i></button>';

            if($result_row->activo == true){
            	$row_of_data[]='<span class="badge text-white" style="background-color: #28a745">Si</span>';
            }else{
            	$row_of_data[]='<span class="badge text-white" style="background-color: #dc3545">No</span>';
            }

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

        $row_obj = MenuFrontend::find($id);
        
        if($row_obj)
        {
            $response_estructure->set_response(true);
            $response_estructure->set_data($row_obj);
        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error($this->text_no_search);
        }
        

        return response()->json($response_estructure->get_response_array());
    }

    public function store(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $nombre = trim($request->input("nombre"));
        $enlace = trim($request->input("enlace"));
        $misma_pestania = $request->input("misma_pestania");
        $activo = $request->input("activo");

        $input= [
            "nombre"=>$nombre,
            "enlace"=>$enlace, 
            "misma_pestania"=>$misma_pestania,
            "activo"=>$activo
        ];

        $rules = [
            "nombre"=>"required|min:3",
            "enlace"=>"required",
            "misma_pestania"=>"required",
            "activo"=>"required", 
        ];

       	$validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            $response_estructure->set_response(false);

            $errors = $validator->errors();

            foreach ($errors->all() as $error) {
                $response_estructure->add_message_error($error);
            }
        }
        else
        {
            if($enlace == "" || !filter_var($enlace, FILTER_VALIDATE_URL)) 
            {
                $response_estructure->set_response(false);
                $response_estructure->add_message_error("Ingrese un enlace válido");
            }
            else
            {
                $orden_mayor = 0;

                $ultimo_row = MenuFrontend::orderBy("orden","desc")->first();

                if($ultimo_row)
                {
                    $orden_mayor = $ultimo_row->orden;
                }

                $row_obj = new MenuFrontend();
                $row_obj->nombre = $nombre;
                $row_obj->enlace = $enlace;
                $row_obj->misma_pestania = $misma_pestania;
                $row_obj->activo = $activo;
                $row_obj->orden = $orden_mayor;
                $row_obj->save();

                $response_estructure->set_response(true);
            }
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function update(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");
        $nombre = trim($request->input("nombre"));
        $enlace = trim($request->input("enlace"));
        $misma_pestania = $request->input("misma_pestania");
        $activo = $request->input("activo");

        $row_obj = MenuFrontend::find($id);
        
        if($row_obj)
        {
            $input= [
                "nombre"=>$nombre,
                "enlace"=>$enlace, 
                "misma_pestania"=>$misma_pestania,
                "activo"=>$activo
            ];

            $rules = [
                "nombre"=>"required|min:3",
                "enlace"=>"required",
                "misma_pestania"=>"required",
                "activo"=>"required", 
            ];

            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                $response_estructure->set_response(false);

                $errors = $validator->errors();

                foreach ($errors->all() as $error) {
                    $response_estructure->add_message_error($error);
                }
            }
            else
            {
                $row_obj->nombre = $nombre;
                $row_obj->enlace = $enlace;
                $row_obj->misma_pestania = $misma_pestania;
                $row_obj->activo = $activo;
                $row_obj->save();

                $response_estructure->set_response(true);
            }
        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error($this->text_no_search);
        }
        

        return response()->json($response_estructure->get_response_array());
    }

    public function delete(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");

        $row_obj = MenuFrontend::find($id);
        
        if($row_obj)
        {
            $row_obj->delete();
            $response_estructure->set_response(true);
        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error($this->text_no_search);
        }


        return response()->json($response_estructure->get_response_array());
    }

    public function mover_arriba(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");

        $row_obj = MenuFrontend::find($id);
        
        if($row_obj)
        {
            $orden_a_mover = $row_obj->orden;

            $row_arriba = MenuFrontend::where("orden","<",$orden_a_mover)->orderBy("orden","desc")->first();

            if($row_arriba)
            {
                $row_obj->orden = $row_arriba->orden;
                $row_obj->save();

                $row_arriba->orden = $orden_a_mover;
                $row_arriba->save();
            }

            $response_estructure->set_response(true);
        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error($this->text_no_search);
        }


        return response()->json($response_estructure->get_response_array());
    }

    public function mover_abajo(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");

        $row_obj = MenuFrontend::find($id);
        
        if($row_obj)
        {
            $orden_a_mover = $row_obj->orden;

            $row_abajo = MenuFrontend::where("orden",">",$orden_a_mover)->orderBy("orden","asc")->first();

            if($row_abajo)
            {
                $row_obj->orden = $row_abajo->orden;
                $row_obj->save();

                $row_abajo->orden = $orden_a_mover;
                $row_abajo->save();
            }

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
