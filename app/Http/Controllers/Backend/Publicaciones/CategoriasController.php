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

use App\Categoria;

class CategoriasController extends ABM_Core
{
	public function __construct()
    {
        $this->link_controlador = url('/backend/publicaciones/categorias').'/';
        $this->carpeta_views = "backend.categorias.";

        $this->entity ="Categoría";
        $this->title_page = "Categorías";

        $this->columns = [
          ["name"=>"Categoría","reference"=>"categorias.nombre"],
          ["name"=>"Imagen","reference"=>"categorias.imagen"],
          ["name"=>"En Menú","reference"=>"categorias.mostrar_en_menu"],
          ["name"=>"Activa","reference"=>"categorias.activa"],
          ["name"=>"Subcategorias","reference"=>null],
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
        $consulta_orm_principal = DB::table("categorias")
        ->select(
            "categorias.*"
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

            $row_of_data[]=strip_tags($result_row->nombre);

            $row_of_data[]="<img src='".asset('storage/imagenes/categorias/'.$result_row->imagen)."'  width='50'>";

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

            $row_of_data[]=
            "<a href='".$this->link_controlador."subcategorias/".$result_row->id."' data-toggle='tooltip' title='' class='btn-sm ".$this->config_buttons["watch"]["class"]."' data-original-title='".$this->config_buttons["watch"]["title"]."'>
                <i class='".$this->config_buttons["watch"]["icon"]."'></i>
            </a>";

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

        $categoria_blog_obj = Categoria::find($id);
        
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

    public function store(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $nombre = ucfirst(trim($request->input("nombre")));
        $imagen = trim($request->input("imagen"));
        $mostrar_en_menu = trim($request->input("mostrar_en_menu"));
		$activa = trim($request->input("activa"));

        $input= [
            "nombre"=>$nombre,
            "imagen"=>$imagen,
            "activa"=>$activa, 
            "mostrar_en_menu"=>$mostrar_en_menu
        ];

        $rules = [
            "nombre"=>"required|min:3|unique:categorias",
            "imagen"=>"required",
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
            $categoria_blog_obj = new Categoria();
            $categoria_blog_obj->nombre = $nombre;
            $categoria_blog_obj->imagen = $imagen;
            $categoria_blog_obj->mostrar_en_menu = $mostrar_en_menu;
            $categoria_blog_obj->activa = $activa;
            $categoria_blog_obj->save();

            $response_estructure->set_response(true);
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function update(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");

        $categoria_blog_obj = Categoria::find($id);
        
        if($categoria_blog_obj)
        {
            $nombre = ucfirst(trim($request->input("nombre")));
            $mostrar_en_menu = $request->input("mostrar_en_menu");
            $activa = $request->input("activa");
            $imagen = $request->input("imagen");

            $input= [
                "nombre"=>$nombre,
                "activa"=>$activa,
                "imagen"=>$imagen,
                "mostrar_en_menu"=>$mostrar_en_menu,
            ];

            $rules = [
                "nombre"=>"required|min:3|unique:categorias,nombre,".$id,
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

                if($categoria_blog_obj->imagen != $imagen && $categoria_blog_obj->imagen != "default.jpg")
                {
                    if (Storage::exists("public/imagenes/categorias/".$categoria_blog_obj->imagen)) {
                        Storage::delete("public/imagenes/categorias/".$categoria_blog_obj->imagen);
                    }
                }

            	$categoria_blog_obj->nombre = $nombre;
                $categoria_blog_obj->imagen = $imagen;
                $categoria_blog_obj->mostrar_en_menu = $mostrar_en_menu;
                $categoria_blog_obj->activa = $activa;
                $categoria_blog_obj->save();
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

        $row_obj = Categoria::find($id);
        
        if($row_obj)
        {
            $imagen = $row_obj->imagen;

            $row_obj->delete();

            if ($imagen != "default.jpg" && Storage::exists("public/imagenes/categorias/".$imagen)) {
                Storage::delete("public/imagenes/categorias/".$imagen);
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
