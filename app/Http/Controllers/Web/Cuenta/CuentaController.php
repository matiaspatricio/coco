<?php

namespace App\Http\Controllers\Web\Cuenta;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Library\ResponseEstructure;

use App\Usuario;
use App\FavoritoPublicacion;

use App\Provincia;
use App\Localidad;
use App\Publicacion;

class CuentaController extends Controller
{
    public function mi_cuenta(Request $request)
    {
        $id = $request->session()->get("id");
        $row_obj = Usuario::find($id);

        $provincias = Provincia::orderBy("provincia")->get();
        $localidades = Localidad::where("id_provincia",$row_obj->id_provincia)->orderBy("localidad")->get();

        return View("frontend.cuenta.mi_cuenta")
        ->with("provincias",$provincias)
        ->with("localidades",$localidades)
        ->with("row_obj",$row_obj);
    }

    public function guardar_datos_mi_cuenta(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->session()->get("id");

        $correo = trim($request->input("correo"));
        $usuario = trim($request->input("usuario"));
        $nombre = trim($request->input("nombre"));
        $apellido = trim($request->input("apellido"));
        $id_pais = 1; // ARGENTINA$
        $id_provincia = $request->input("id_provincia");
        $id_localidad = $request->input("id_localidad");
        $codigo_postal = $request->input("codigo_postal");
        $direccion = $request->input("direccion");
        $telefono = $request->input("telefono");

        $foto_perfil = $request->input("foto_perfil");

        $new_password = $request->input("new_password");
        $new_password2 = $request->input("new_password2");

        $input= [
            "correo"=>$correo,
            "usuario"=>$usuario,
            "nombre"=>$nombre,
            "apellido"=>$apellido,

            "provincia"=>$id_provincia,
            "localidad"=>$id_localidad,
            "codigo_postal"=>$codigo_postal,
            "direccion"=>$direccion,
            "telefono"=>$telefono
        ];

        $rules = [
            "correo"=>"required|email|unique:usuarios,correo,".$id,
            "usuario"=>"required|min:6|unique:usuarios,usuario,".$id,
            "nombre"=>"required|min:3",
            "apellido"=>"required|min:3",

            "provincia"=>"required|numeric",
            "localidad"=>"required|numeric",
            "codigo_postal"=>"required",
            "direccion"=>"required",
            "telefono"=>"required|min:8|max:14",
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
            $usuario_obj = Usuario::find($id);
            
            // SI LA PUBLICACION EXISTE Y ESTÁ ACTIVA
            if($usuario_obj)
            {
                $response_estructure->set_response(true);

                if(trim($new_password) != "" || trim($new_password2) != "")
                {
                    if($new_password != $new_password2)
                    {
                        $response_estructure->set_response(false);
                        $response_estructure->add_message_error("Verifique las contraseñas ingresadas");
                    }
                    else
                    {
                        if(strlen(trim($new_password)) < 8)
                        {
                            $response_estructure->set_response(false);
                            $response_estructure->add_message_error("La contraseña debe tener al menos 8 carácteres");
                        }
                    }
                }

                if($usuario_obj->foto_perfil != $foto_perfil && $usuario_obj->foto_perfil != "default.jpg")
                {
                    if (Storage::exists("public/imagenes/usuarios/".$usuario_obj->foto_perfil)) {
                        Storage::delete("public/imagenes/usuarios/".$usuario_obj->foto_perfil);
                    }
                }

                if($response_estructure->get_response() == TRUE)
                {
                    if($id_pais == 0){$id_pais = null;}
                    if($id_provincia == 0){$id_provincia = null;}
                    if($id_localidad == 0){$id_localidad = null;}

                    $usuario_obj->correo = $correo;
                    $usuario_obj->usuario = $usuario;
                    $usuario_obj->nombre = $nombre;
                    $usuario_obj->apellido = $apellido;
                    $usuario_obj->id_pais = $id_pais;
                    $usuario_obj->id_provincia = $id_provincia;
                    $usuario_obj->id_localidad = $id_localidad;
                    $usuario_obj->direccion = $direccion;
                    $usuario_obj->codigo_postal = $codigo_postal;
                    $usuario_obj->telefono = $telefono;
                    $usuario_obj->foto_perfil = $foto_perfil;

                    $usuario_obj->save();
                }
            }
            else
            {
                $response_estructure->add_message_error("No se encontró su cuenta");
            }
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function mis_favoritos(Request $request)
    {
        $id = $request->session()->get("id");

        $texto_buscar = trim($request->input("texto_buscar"));

        $favoritos_publicaciones= DB::table("favoritos_publicaciones")
        ->join("publicaciones","publicaciones.id","=","favoritos_publicaciones.id_publicacion")
        ->select(
            "favoritos_publicaciones.*")
        ->where("publicaciones.id_estado_publicacion",2)
        ->where("favoritos_publicaciones.id_usuario",$id);

        if($texto_buscar != "")
        {
            $favoritos_publicaciones = $favoritos_publicaciones->where("publicaciones.titulo","like","%".$texto_buscar."%");
        }

        $favoritos_publicaciones = $favoritos_publicaciones->paginate(9);

        return View("frontend.cuenta.mis_favoritos")
        ->with("favoritos_publicaciones",$favoritos_publicaciones);
    }

    public function mis_publicaciones(Request $request)
    {
        $id = $request->session()->get("id");

        $texto_buscar = trim($request->input("texto_buscar"));

        $mis_publicaciones = Publicacion::where("id_usuario",$request->session()->get("id"));

        if($texto_buscar != "")
        {
            $mis_publicaciones = $mis_publicaciones->where("publicaciones.titulo","like","%".$texto_buscar."%");
        }

        $mis_publicaciones = $mis_publicaciones->paginate(12);

        return View("frontend.cuenta.mis_publicaciones")
        ->with("mis_publicaciones",$mis_publicaciones);
    }
}
