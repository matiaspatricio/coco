<?php
namespace App\Http\Controllers\Backend\UsuariosFrontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\ABM_Core;

use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use App\Usuario;
use App\EstadoUsuario;
use App\Rol;
use App\Provincia;
use App\Localidad;

class UsuariosFrontendController extends ABM_Core
{
    public function __construct()
    {
        $this->link_controlador = url('/backend/usuarios_frontend').'/';
        $this->carpeta_views = "backend.usuarios_frontend.";

        $this->entity ="Usuario Frontend";
        $this->title_page = "Usuarios Frontend";

        $this->columns = [
            ["name"=>"Usuario","reference"=>"usuarios.usuario"],
            ["name"=>"Nombre","reference"=>"usuarios.nombre"],
            ["name"=>"Apellido","reference"=>"usuarios.apellido"],
            ["name"=>"Correo","reference"=>"usuarios.correo"],
            ["name"=>"Foto","reference"=>"usuarios.foto_perfil"],
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
        $consulta_orm_principal = DB::table("usuarios")
        ->join("roles","roles.id","=","usuarios.id_rol")
        ->select(
            "usuarios.*",
            "roles.rol as roles_rol"
        )
        ->where("eliminado",0)
        ->where("id_rol",2);

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
                $query->where("usuarios.nombre","like","%".$search['value']."%");
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

            $row_of_data[]=strip_tags($result_row->usuario);
            $row_of_data[]=strip_tags($result_row->nombre);
            $row_of_data[]=strip_tags($result_row->apellido);
            $row_of_data[]=strip_tags($result_row->correo);
            $row_of_data[]="<img src='".asset('storage/imagenes/usuarios/'.$result_row->foto_perfil)."' class='rounded-circle' width='50'>";

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

    public function nuevo(Request $request)
    {
        $this->title_page = $this->config_buttons["add"]["title"]." ".$this->entity;
        $this->share_parameters();

        $estados_usuarios = EstadoUsuario::all();
        $provincias = Provincia::orderBy("provincia")->get();

        return View($this->carpeta_views."add")
        ->with("estados_usuarios",$estados_usuarios)
        ->with("provincias",$provincias);
    }

    public function store(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $usuario = trim($request->input("usuario"));
        $correo = trim(strtolower($request->input("correo")));
        $nombre = trim(ucwords($request->input("nombre")));
        $apellido = trim(ucwords($request->input("apellido")));
        $password = trim($request->input("password"));
        $password2 = trim($request->input("password2"));
        $id_pais = 1; // ARGENTINA
        $id_provincia = $request->input("id_provincia");
        $id_localidad = $request->input("id_localidad");
        $codigo_postal = $request->input("codigo_postal");
        $direccion = $request->input("direccion");
        $telefono = $request->input("telefono");
        $id_estado_usuario = $request->input("id_estado_usuario");
        $id_rol = 2; //trim($request->input("id_rol"));
        $foto_perfil = $request->input("foto_perfil");

        $input= [
            "usuario"=>$usuario,
            "correo"=>$correo,
            "nombre"=>$nombre,
            "apellido"=>$apellido,
            "contraseña"=>$password,
            "repetir_contraseña"=>$password2,
            "id_estado_usuario"=>$id_estado_usuario,

            "provincia"=>$id_provincia,
            "localidad"=>$id_localidad,
            "codigo_postal"=>$codigo_postal,
            "direccion"=>$direccion,
            "telefono"=>$telefono,

            "rol"=>$id_rol,
        ];

        $rules = [
            "usuario"=>"required|unique:usuarios|min:6",
            "correo"=>"required|email|unique:usuarios",
            "nombre"=>"required|min:3",
            "apellido"=>"required|min:3",
            "contraseña"=>"required|min:8",
            "repetir_contraseña"=>"required|min:8",

            "provincia"=>"required|numeric",
            "localidad"=>"required|numeric",
            "codigo_postal"=>"required",
            "direccion"=>"required",
            "telefono"=>"required|min:8|max:14",

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

            if($password != $password2)
            {
                $response_estructure->set_response(false);
                $response_estructure->add_message_error("Las contraseñas ingresadas no coinciden");
            }

            if($response_estructure->get_response() === TRUE)
            {
                $usuario_obj = new Usuario();

                $usuario_obj->usuario = $usuario;
                $usuario_obj->correo = $correo;
                $usuario_obj->nombre = $nombre;
                $usuario_obj->apellido = $apellido;
                $usuario_obj->foto_perfil = $foto_perfil;
                $usuario_obj->password = bcrypt($password);
                $usuario_obj->id_pais = $id_pais;
                $usuario_obj->id_provincia = $id_provincia;
                $usuario_obj->id_localidad = $id_localidad;
                $usuario_obj->codigo_postal = $codigo_postal;
                $usuario_obj->direccion = $direccion;
                $usuario_obj->telefono = $telefono;
                $usuario_obj->id_estado_usuario = $id_estado_usuario;
                $usuario_obj->id_rol = $id_rol;
                $usuario_obj->save();
            }
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function editar(Request $request,$id)
    {
        $row_obj = Usuario::find($id);

        if($row_obj && $row_obj->eliminado == false)
        {
            $this->title_page = $this->config_buttons["edit"]["title"]." ".$this->entity;
            $this->share_parameters();
            
            $estados_usuarios = EstadoUsuario::all();
            $provincias = Provincia::orderBy("provincia")->get();
            $localidades = Localidad::where("id_provincia",$row_obj->id_provincia)->get();

            return View($this->carpeta_views."edit")
            ->with("row_obj",$row_obj)
            ->with("estados_usuarios",$estados_usuarios)
            ->with("provincias",$provincias)
            ->with("localidades",$localidades);
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
            $id_rol = 2; //$request->input("id_rol");
            $foto_perfil = $request->input("foto_perfil");
            
            $id_pais = 1; // ARGENTINA
            $id_provincia = $request->input("id_provincia");
            $id_localidad = $request->input("id_localidad");
            $codigo_postal = $request->input("codigo_postal");
            $direccion = $request->input("direccion");
            $telefono = $request->input("telefono");

            $password = trim($request->input("password"));
            $password2 = trim($request->input("password2"));

            $input= [
                "usuario"=>$usuario,
                "correo"=>$correo,
                "nombre"=>$nombre,
                "apellido"=>$apellido,

                "provincia"=>$id_provincia,
                "localidad"=>$id_localidad,
                "codigo_postal"=>$codigo_postal,
                "direccion"=>$direccion,
                "telefono"=>$telefono,

                "id_estado_usuario"=>$id_estado_usuario,
                "rol"=>$id_rol,
            ];

            $rules = [
                "usuario"=>"required|min:6|unique:usuarios,usuario,".$id,
                "correo"=>"required|email|unique:usuarios,correo,".$id,
                "nombre"=>"required|min:3",
                "apellido"=>"required|min:3",

                "provincia"=>"required|numeric",
                "localidad"=>"required|numeric",
                "codigo_postal"=>"required",
                "direccion"=>"required",
                "telefono"=>"required|min:8|max:14",

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

                    $usuario_obj->id_pais = $id_pais;
                    $usuario_obj->id_provincia = $id_provincia;
                    $usuario_obj->id_localidad = $id_localidad;
                    $usuario_obj->codigo_postal = $codigo_postal;
                    $usuario_obj->direccion = $direccion;
                    $usuario_obj->telefono = $telefono;
                    
                    $usuario_obj->id_estado_usuario = $id_estado_usuario;
                    $usuario_obj->correo_confirmado = true;
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

    public function delete(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");

        $usuario_obj = Usuario::where("id_rol",2)->where("id",$id)->first();
        
        if($usuario_obj)
        {
            $usuario_obj->eliminado = true;
            $usuario_obj->save();


            $response_estructure->set_response(true);
        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error("Usuario no encontrado");
        }


        return response()->json($response_estructure->get_response_array());
    }

}
