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

use App\SliderHome;

class SliderHomeController extends ABM_Core
{
	public function __construct()
    {
        $this->link_controlador = url('/backend/slider_home').'/';
        $this->carpeta_views = "backend.slider_home.";

        $this->entity ="Slider Home";
        $this->title_page = "Slider Home";

        $this->columns = [
          ["name"=>"Titulo Corto","reference"=>"slider_home.small_title"],
          ["name"=>"Titulo","reference"=>"slider_home.title"],
          ["name"=>"Link","reference"=>"slider_home.link_button"],
          ["name"=>"Imagen","reference"=>"slider_home.imagen"],
          ["name"=>"activo","reference"=>"slider_home.activo"],
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
        $consulta_orm_principal = DB::table("slider_home")
        ->select(
            "slider_home.*"
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
               $query->where("categorias.nombre","like","%".$search['value']."%")
               ->orWhere("categorias.id","like","%".$search['value']."%");
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

            $row_of_data[]=strip_tags($result_row->small_title);
            $row_of_data[]=strip_tags($result_row->title);
            $row_of_data[]=strip_tags($result_row->link_button);

            $row_of_data[]="<img src='".asset('storage/imagenes/slider_home/'.$result_row->imagen)."'  width='50'>";
            

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

        $row_obj = SliderHome::find($id);
        
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

        $small_title = ucfirst(trim($request->input("small_title")));
        $title = ucfirst(trim($request->input("title")));
        $imagen = ucfirst(trim($request->input("imagen")));
        $link_button = ucfirst(trim($request->input("link_button")));
        $activo = ucfirst(trim($request->input("activo")));

        $input= [
            "small_title"=>$small_title,
            "title"=>$title, 
            "imagen"=>$imagen,
            "activo"=>$activo
        ];

        $rules = [
            "small_title"=>"required|min:3",
            "title"=>"required|min:3",
            "imagen"=>"required",
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
            if($link_button == "" || !filter_var($link_button, FILTER_VALIDATE_URL)) {
                $link_button = null;
            }

            $row_obj = new SliderHome();
            $row_obj->small_title = $small_title;
            $row_obj->title = $title;
            $row_obj->imagen = $imagen;
            $row_obj->link_button = $link_button;
            $row_obj->activo = $activo;
            $row_obj->save();

            $response_estructure->set_response(true);
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function update(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");
        $small_title = ucfirst(trim($request->input("small_title")));
        $title = ucfirst(trim($request->input("title")));
        $imagen = ucfirst(trim($request->input("imagen")));
        $link_button = ucfirst(trim($request->input("link_button")));
        $activo = ucfirst(trim($request->input("activo")));

        $row_obj = SliderHome::find($id);
        
        if($row_obj)
        {
            $input= [
                "small_title"=>$small_title,
                "title"=>$title, 
                "imagen"=>$imagen,
                "activo"=>$activo
            ];
    
            $rules = [
                "small_title"=>"required|min:3",
                "title"=>"required|min:3",
                "imagen"=>"required",
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
                $response_estructure->set_response(true);

                if($row_obj->imagen != $imagen && $row_obj->imagen != "default.jpg")
                {
                    if (Storage::exists("public/imagenes/slider_home/".$row_obj->imagen)) {
                        Storage::delete("public/imagenes/slider_home/".$row_obj->imagen);
                    }
                }

                if($link_button == "" || !filter_var($link_button, FILTER_VALIDATE_URL)) {
                    $link_button = null;
                }

            	$row_obj->small_title = $small_title;
                $row_obj->title = $title;
                $row_obj->imagen = $imagen;
                $row_obj->link_button = $link_button;
                $row_obj->activo = $activo;
                $row_obj->save();
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

        $row_obj = SliderHome::find($id);
        
        if($row_obj)
        {
            $imagen = $row_obj->imagen;

            $row_obj->delete();

            if ($imagen != "default.jpg" && Storage::exists("public/imagenes/slider_home/".$imagen)) {
                Storage::delete("public/imagenes/slider_home/".$imagen);
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
