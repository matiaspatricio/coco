<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\ABM_Core;

use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use App\Usuario;

class PerfilController extends ABM_Core
{
    public function __construct()
    {
        $this->link_controlador = url('/backend/perfil').'/';
        $this->carpeta_views = "backend.perfil.";

        $this->entity ="Perfil";
        $this->title_page = "Perfiles";

        $this->columns = [];

        $this->is_ajax = false;
    }

    public function index(Request $request)
    {
        $this->title_page = "Mi Perfil";
        $this->share_parameters();

        $id = $request->session()->get("id");

        $row_obj = Usuario::find($id);

        return View($this->carpeta_views."mi_perfil")
        ->with("row_obj",$row_obj);
    }

    public function guardar_perfil(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->session()->get("id");

        $usuario_obj = Usuario::find($id);
        
        if($usuario_obj && $usuario_obj->eliminado == false)
        {
            $usuario = trim($request->input("usuario"));
            $correo = trim(strtolower($request->input("correo")));
            $nombre = trim(ucwords($request->input("nombre")));
            $apellido = trim(ucwords($request->input("apellido")));
            $foto_perfil = $request->input("foto_perfil");

            $password = trim($request->input("password"));
            $password2 = trim($request->input("password2"));

            $input= [
                "usuario"=>$usuario,
                "correo"=>$correo,
                "nombre"=>$nombre,
                "apellido"=>$apellido,
            ];

            $rules = [
                "usuario"=>"required|min:6|unique:usuarios,usuario,".$id,
                "correo"=>"required|email|unique:usuarios,correo,".$id,
                "nombre"=>"required|min:3",
                "apellido"=>"required|min:3",
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