<?php

namespace App\Library;

use Illuminate\Http\Request;
use App\Library\SessionHelper;
use Illuminate\Support\Facades\Hash;

use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSender;

use App\Usuario;
use App\ConfirmacionUsuario;

class LoginCore
{
    public function ingresar(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $correo = trim(strtolower($request->input("correo")));
        $password = $request->input("password");

        $input = [
            "correo"=>$correo,
            "password"=>$password
        ];

        $rules = [
            "correo"=>"required",
            "password"=>"required"
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

            $rules["correo"]="required|email";

            $validator = Validator::make($input, $rules);

            $usuario_obj = null;

            $es_correo = true;

            if ($validator->fails()) {

                $usuario_obj = Usuario::where("usuario",$correo)->where("eliminado",false)->first();
                $es_correo = false;
            }
            else
            {
                $usuario_obj = Usuario::where("correo",$correo)->where("eliminado",false)->first();
            }

            if($usuario_obj && $usuario_obj->eliminado){$usuario_obj = null;}


            if($usuario_obj && $usuario_obj->id_estado_usuario == 1 && $usuario_obj->correo_confirmado == true)
            {
                if (Hash::check($password, $usuario_obj->password)) {

                    $request->session()->put("id",$usuario_obj->id);

                    $session_helper = new SessionHelper();
                    $session_helper->actualiza_session_usuario($request);

                    $response_estructure->set_response(true);
                }
                else
                {
                    $response_estructure->set_response(false);
                    $response_estructure->add_message_error("Contraseña incorrecta");
                }
            }
            else
            {

                $response_estructure->set_response(false);

                if($usuario_obj)
                {
                    if($usuario_obj->id_estado_usuario != 1)
                    {
                        $response_estructure->add_message_error("El usuario no está activado");
                    }
                    else
                    {
                        if($usuario_obj->correo_confirmado != true)
                        {
                            $response_estructure->add_message_error(
                            "Debe confirmar su correo, sino recibió el correo de activación 
                            puede solicitarlo de nuevo haciendo <a href='".url('/enviar_correo_activacion?correo='.$correo)."'>Click Aquí</a>");
                        }
                    }
                }
                else
                {
                    if($es_correo)
                    {
                        $response_estructure->add_message_error("No se ha encontrado el correo ingresado");
                    }
                    else
                    {
                        $response_estructure->add_message_error("No se ha encontrado el usuario ingresado");
                    }
                }
            }
        }

        return $response_estructure->get_response_array();
    }

    public function registrarse(Request $request,$id_rol)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $nombre = trim(ucwords($request->input("nombre")));
        $apellido = trim(ucwords($request->input("apellido")));
        $correo = trim(strtolower($request->input("correo")));
        $usuario = trim(strtolower($request->input("usuario")));
        $password = $request->input("password");
        $id_provincia = $request->input("id_provincia");
        $id_localidad = $request->input("id_localidad");
        $codigo_postal = $request->input("codigo_postal");
        $direccion = $request->input("direccion");
        $telefono = $request->input("telefono");

        $input = [
            "nombre"=>$nombre,
            "apellido"=>$apellido,
            "correo"=>$correo,
            "usuario"=>$usuario,
            "password"=>$password,
            "provincia"=>$id_provincia,
            "localidad"=>$id_localidad,
            "codigo_postal"=>$codigo_postal,
            "direccion"=>$direccion,
            "telefono"=>$telefono
        ];

        $rules = [
            "nombre"=>"required|min:3",
            "apellido"=>"required|min:3",
            "correo"=>"required|email|unique:usuarios",
            "usuario"=>"required|min:6|unique:usuarios",
            "password"=>"required|min:8",
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
            $usuario_obj = new Usuario();
            $usuario_obj->nombre = $nombre;
            $usuario_obj->apellido = $apellido;
            $usuario_obj->correo = $correo;
            $usuario_obj->usuario = $usuario;
            $usuario_obj->password = bcrypt($password);
            $usuario_obj->id_pais = 1; // ARGENTINA
            $usuario_obj->id_provincia = $id_provincia;
            $usuario_obj->id_localidad = $id_localidad;
            $usuario_obj->codigo_postal = $codigo_postal;
            $usuario_obj->direccion = $direccion;
            $usuario_obj->telefono = $telefono;
            $usuario_obj->id_rol = $id_rol;
            $usuario_obj->id_estado_usuario = 1;
            $usuario_obj->save();

            $response_estructure->set_response(true);

            if($id_rol == 2) // USUARIO FRONTEND
            {
                $key_activation = $this->generate_code_activation();

                $confirmacion_usuario_obj = new ConfirmacionUsuario();
                $confirmacion_usuario_obj->key = $key_activation;
                $confirmacion_usuario_obj->id_usuario = $usuario_obj->id;
                $confirmacion_usuario_obj->save();

                $email_sender = new \stdClass();
                $email_sender->asunto = "Bienvenido";
                $email_sender->nombre = $nombre;
                $email_sender->apellido = $apellido;
                $email_sender->correo = $correo;
                $email_sender->usuario = $usuario;

                $email_sender->url_confirmar_correo = url('/confirmar_correo?code='.urlencode($key_activation));

                Mail::to($correo)->send(new EmailSender($email_sender,$email_sender->asunto,"emails.bienvenido"));
            }
        }

        return $response_estructure->get_response_array();
    }

    public function forgot_password(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $correo = trim(strtolower($request->input("correo")));

        $input = ["correo"=>$correo];
        $rules = ["correo"=>"required|email"];

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {

            $errors = $validator->errors();

            foreach ($errors->all() as $error) {
                $response_estructure->add_message_error($error);
            }
        }
        else
        {
            $user_obj = Usuario::where("correo",$correo)->first();

            if($user_obj && $user_obj->eliminado){$user_obj = null;}

            if($user_obj)
            {
                $user_obj->sendNewPassword();
                $response_estructure->set_response(true);
            }
            else{
                $response_estructure->add_message_error("No se ha encontrado la cuenta");
            }
        }

        return $response_estructure->get_response_array();
    }

    public function cerrar_sesion(Request $request)
    {
        $session_helper = new SessionHelper();
        $session_helper->destroy_session($request);
    }

    public function enviar_correo_activacion_post(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $correo = trim(strtolower($request->input("correo")));

        $input = ["correo"=>$correo];
        $rules = ["correo"=>"required|email"];

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {

            $errors = $validator->errors();

            foreach ($errors->all() as $error) {
                $response_estructure->add_message_error($error);
            }
        }
        else
        {
            $user_obj = Usuario::where("correo",$correo)->first();

            if($user_obj && $user_obj->eliminado){$user_obj = null;}

            if($user_obj)
            {
                if($user_obj->correo_confirmado == true)
                {
                    $response_estructure->add_message_error("El correo ya se encuentra confirmado");
                }
                else{
                    $confirmacion_usuario_obj = ConfirmacionUsuario::where("id_usuario",$user_obj->id)->first();

                    if($confirmacion_usuario_obj && $confirmacion_usuario_obj->usado == false)
                    {
                        $email_sender = new \stdClass();
                        $email_sender->asunto = "Bienvenido";
                        $email_sender->nombre = $user_obj->nombre;
                        $email_sender->apellido = $user_obj->apellido;
                        $email_sender->correo = $user_obj->correo;
                        $email_sender->usuario = $user_obj->usuario;

                        $email_sender->url_confirmar_correo = url('/confirmar_correo?code='.urlencode($confirmacion_usuario_obj->key));

                        Mail::to($correo)->send(new EmailSender($email_sender,$email_sender->asunto,"emails.bienvenido"));
                        
                        $response_estructure->set_response(true);
                    }
                    else
                    {
                        $response_estructure->add_message_error("El correo ya se encuentra confirmado");
                    }
                }
            }
            else{
                $response_estructure->add_message_error("No se ha encontrado una cuenta con el correo ingresado");
            }
        }

        return $response_estructure->get_response_array();
    }

    private function generate_code_activation($length = 8)
    {
		$characters = '012345!6789a"bcdef#ghijk$lmno%pqr&stu/vwxy/zABC(DE)FG%HIJKL!MNO&PQRST=UVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
	    return $randomString;
	}
}