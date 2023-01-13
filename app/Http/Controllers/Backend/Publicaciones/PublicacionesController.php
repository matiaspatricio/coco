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

use App\Publicacion;
use App\TipoPublicacion;
use App\EstadoPublicacion;
use App\Categoria;
use App\Subcategoria;
use App\Provincia;
use App\Localidad;

class PublicacionesController extends ABM_Core
{
    public function __construct()
    {
        $this->link_controlador = url('/backend/publicaciones').'/';
        $this->carpeta_views = "backend.publicaciones.";

        $this->entity ="Publicación";
        $this->title_page = "Publicaciones";
        $this->add_active = false;
        $this->delete_active = false;

        $this->columns = [
            ["name"=>"Titulo","reference"=>"publicaciones.titulo"],
            /*["name"=>"Precio Desde","reference"=>"publicaciones.precio_desde"],
            ["name"=>"Precio Desde","reference"=>"publicaciones.precio_hasta"],*/
            ["name"=>"Publicador","reference"=>"usuarios.usuario"],
            ["name"=>"Tipo","reference"=>"tipos_de_publicaciones.tipo"],
            ["name"=>"Estado","reference"=>"estados_publicaciones.estado"],
            ["name"=>"Imagen","reference"=>"publicaciones.imagen_principal"],
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
        $consulta_orm_principal = DB::table("publicaciones")
        ->join("usuarios","usuarios.id","=","publicaciones.id_usuario")
        ->join("tipos_de_publicaciones","tipos_de_publicaciones.id","=","publicaciones.id_tipo_publicacion")
        ->join("estados_publicaciones","estados_publicaciones.id","=","publicaciones.id_estado_publicacion")
        ->select(
            "publicaciones.*",
            "usuarios.usuario as usuarios_usuario",
            "tipos_de_publicaciones.tipo as tipos_de_publicaciones_tipo",
            "tipos_de_publicaciones.color as tipos_de_publicaciones_color",
            "estados_publicaciones.estado as estados_publicaciones_estado",
            "estados_publicaciones.color as estados_publicaciones_color"
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
                $query->where("publicaciones.titulo","like","%".$search['value']."%")
                ->orWhere("publicaciones.precio_desde","like","%".$search['value']."%")
                ->orWhere("publicaciones.precio_hasta","like","%".$search['value']."%")
                ->orWhere("usuarios.usuario","like","%".$search['value']."%")
                ->orWhere("tipos_de_publicaciones.tipo","like","%".$search['value']."%")
                ->orWhere("estados_publicaciones.estado","like","%".$search['value']."%")
                ->orWhere("publicaciones.id","like","%".$search['value']."%");
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

            $row_of_data[]=strip_tags($result_row->titulo);
            /*$row_of_data[]=strip_tags($result_row->precio_desde);
            $row_of_data[]=strip_tags($result_row->precio_hasta);*/
            $row_of_data[]="<a href='".url('backend/usuarios_frontend/editar/'.$result_row->id_usuario)."'>".strip_tags($result_row->usuarios_usuario)."</a>";
            
            $row_of_data[]="<span class='badge text-white' style='background-color: ".$result_row->tipos_de_publicaciones_color."'>".strip_tags($result_row->tipos_de_publicaciones_tipo)."</span>";
            

            $row_of_data[]="<span class='badge text-white' style='background-color: ".$result_row->estados_publicaciones_color."'>".strip_tags($result_row->estados_publicaciones_estado)."</span>";
            $row_of_data[]="<img src='".asset('storage/imagenes/publicaciones/'.$result_row->imagen_principal)."' width='50'>";

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

    public function editar(Request $request,$id)
    {
        $row_obj = Publicacion::find($id);

        if($row_obj && $row_obj->eliminado == false)
        {
            $this->title_page = $this->config_buttons["edit"]["title"]." ".$this->entity;
            $this->share_parameters();
         
            $estados_publicaciones = EstadoPublicacion::all();
            $categorias = Categoria::all();
            $subcategorias = Subcategoria::where("id_categoria",$row_obj->id_categoria)->get();
            $provincias = Provincia::all();

            $localidades = array();
            
            if($row_obj->id_provincia_alcanze != null)
            {
                $localidades = Localidad::where("id_provincia",$row_obj->id_provincia_alcanze)->get();
            }

            return View($this->carpeta_views."edit")
            ->with("row_obj",$row_obj)
            ->with("estados_publicaciones",$estados_publicaciones)
            ->with("categorias",$categorias)
            ->with("subcategorias",$subcategorias)
            ->with("provincias",$provincias)
            ->with("localidades",$localidades)
            ->with("listado_tipos_publicaciones",$row_obj->get_listado_tipos_publicaciones());
        }
    }

    public function update(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");

        $usuario_obj = Usuario::find($id);
        
        if($usuario_obj && $usuario_obj->eliminado == false)
        {
            $usuario = trim($request->input("usuario"));
            $correo = trim(strtolower($request->input("correo")));
            $nombre = trim(ucwords($request->input("nombre")));
            $apellido = trim(ucwords($request->input("apellido")));
            $id_estado_usuario = $request->input("id_estado_usuario");
            $id_rol = 1; //$request->input("id_rol");
            $foto_perfil = $request->input("foto_perfil");

            $password = trim($request->input("password"));
            $password2 = trim($request->input("password2"));

            $input= [
                "usuario"=>$usuario,
                "correo"=>$correo,
                "nombre"=>$nombre,
                "apellido"=>$apellido,
                "id_estado_usuario"=>$id_estado_usuario,
                "rol"=>$id_rol,
            ];

            $rules = [
                "usuario"=>"required|min:6|unique:usuarios,usuario,".$id,
                "correo"=>"required|email|unique:usuarios,correo,".$id,
                "nombre"=>"required|min:3",
                "apellido"=>"required|min:3",
                "id_estado_usuario"=>"required", 
                "rol"=>"required", 
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

                
                if($password != "" || $password2 != "")
                {
                    if($password != $password2)
                    {
                        $response_estructure->set_response(false);
                        $response_estructure->add_message_error("Las contraseñas ingresadas no coinciden");
                    }
                    else
                    {
                        $validator = Validator::make(
                            ["password"=>$password], 
                            ["password"=>"required|min:8"]
                        );

                        if ($validator->fails()) {

                            $response_estructure->set_response(false);
                            
                            $errors = $validator->errors();

                            foreach ($errors->all() as $error) {
                                $response_estructure->add_message_error($error);
                            }
                        }

                    }
                }

                if($response_estructure->get_response() === TRUE)
                {
                    if($usuario_obj->foto_perfil != $foto_perfil && $usuario_obj->foto_perfil != "default.jpg")
                    {
                        if (Storage::exists("public/imagenes/usuarios/".$usuario_obj->foto_perfil)) {
                            Storage::delete("public/imagenes/usuarios/".$usuario_obj->foto_perfil);
                        }
                    }

                    $usuario_obj->usuario = $usuario;
                    $usuario_obj->correo = $correo;
                    $usuario_obj->nombre = $nombre;
                    $usuario_obj->apellido = $apellido;
                    $usuario_obj->foto_perfil = $foto_perfil;
                    
                    if($password != "")
                    {
                        $usuario_obj->password = bcrypt($password);
                    }
                    
                    $usuario_obj->id_estado_usuario = $id_estado_usuario;
                    $usuario_obj->save();
                }
            }
        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error("Usuario no encontrado");
        }
        

        return response()->json($response_estructure->get_response_array());
    }
}
