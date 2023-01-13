<?php

namespace App\Http\Controllers\Backend\Publicaciones;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\ABM_Core;

use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use App\Subcategoria;
use App\Categoria;

class SubcategoriasController extends ABM_Core
{
	public function __construct()
    {
        $this->link_controlador = url('/backend/publicaciones/categorias/subcategorias').'/';
        $this->carpeta_views = "backend.subcategorias.";

        $this->entity ="Subcategoría";
        $this->title_page = "Subcategorías";

        $this->columns = [
          ["name"=>"Categoría","reference"=>"subcategorias.nombre"],
          ["name"=>"Imagen","reference"=>"subcategorias.imagen"],
          ["name"=>"Mostrar en menú","reference"=>"subcategorias.mostrar_en_menu"],
          ["name"=>"Activa","reference"=>"subcategorias.activa"],
          ["name"=>"Acciones","reference"=>null]
        ];

        $this->is_ajax = true;
    }
    
    public function index(Request $request,$id_categoria)
    {
        $categoria_obj = Categoria::find($id_categoria);

        if($categoria_obj)
        {
            $this->title_page = "Subcategorías de: ".$categoria_obj->nombre;

            $this->share_parameters();
            return View($this->carpeta_views."browse")
            ->with("id_categoria",$id_categoria);
        }
    }

    public function get_listado_dt(Request $request)
    {
        $id_categoria = (int)$request->input("id_categoria");

        $consulta_orm_principal = DB::table("subcategorias")
        ->select(
            "subcategorias.*"
        )
        ->where("id_categoria",$id_categoria);

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
               $query->where("subcategorias.nombre","like","%".$search['value']."%")
               ->orWhere("subcategorias.id","like","%".$search['value']."%");
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

            $row_of_data[]="<img src='".asset('storage/imagenes/subcategorias/'.$result_row->imagen)."'  width='50'>";

            if($result_row->mostrar_en_menu == true){
            	$row_of_data[]='<span class="badge text-white" style="background-color: #28a745">Si</span>';
            }else{
            	$row_of_data[]='<span class="badge text-white" style="background-color: #dc3545">No</span>';
            }

            if($result_row->activa == true){
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

        $row_obj = Subcategoria::find($id);
        
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

        $nombre = ucfirst(trim($request->input("nombre")));
        $imagen = ucfirst(trim($request->input("imagen")));
        $id_categoria = ucfirst(trim($request->input("id_categoria")));
		$mostrar_en_menu = trim($request->input("mostrar_en_menu"));
		$activa = trim($request->input("activa"));

        $input= [
            "nombre"=>$nombre,
            "imagen"=>$imagen,
            "id_categoria"=>$id_categoria,
            "mostrar_en_menu"=>$mostrar_en_menu, 
            "activa"=>$activa, 
        ];

        $rules = [
            "nombre"=>"required|min:3|unique:subcategorias",
            "imagen"=>"required",
            "id_categoria"=>"required|numeric",
            "mostrar_en_menu"=>"required", 
            "activa"=>"required", 
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
            $row_obj = new Subcategoria();
            $row_obj->nombre = $nombre;
            $row_obj->imagen = $imagen;
            $row_obj->id_categoria = $id_categoria;
            $row_obj->mostrar_en_menu = $mostrar_en_menu;
            $row_obj->activa = $activa;
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

        $row_obj = Subcategoria::find($id);
        
        if($row_obj)
        {
            $nombre = ucfirst(trim($request->input("nombre")));
            $mostrar_en_menu = $request->input("mostrar_en_menu");
            $activa = $request->input("activa");
            $imagen = $request->input("imagen");

            $input= [
                "nombre"=>$nombre,
                "mostrar_en_menu"=>$mostrar_en_menu,
                "activa"=>$activa,
                "imagen"=>$imagen,
            ];

            $rules = [
                "nombre"=>"required|min:3",
                "mostrar_en_menu"=>"required",
                "activa"=>"required", 
                "imagen"=>"required", 
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
                    if (Storage::exists("public/imagenes/subcategorias/".$row_obj->imagen)) {
                        Storage::delete("public/imagenes/subcategorias/".$row_obj->imagen);
                    }
                }

            	$row_obj->nombre = $nombre;
                $row_obj->imagen = $imagen;
                $row_obj->mostrar_en_menu = $mostrar_en_menu;
                $row_obj->activa = $activa;
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

        $row_obj = Subcategoria::find($id);
        
        if($row_obj)
        {
            $imagen = $row_obj->imagen;

            $row_obj->delete();

            if ($imagen != "default.jpg" && Storage::exists("public/imagenes/subcategorias/".$imagen)) {
                Storage::delete("public/imagenes/subcategorias/".$imagen);
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
