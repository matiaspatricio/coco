<?php

namespace App\Http\Controllers\Web\Contacto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;

use App\MensajeContacto;

class ContactoController extends Controller
{
    public function index(Request $request)
    {
        return View("frontend.contacto");
    }

    public function enviar_mensaje(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $nombre = ucwords(trim($request->input("nombre")));
        $apellido = ucwords(trim($request->input("apellido")));
        $correo = trim($request->input("correo"));
        $asunto = ucwords(trim($request->input("asunto")));
        $mensaje = ucwords(trim($request->input("mensaje")));

        $input= [
            "nombre"=>$nombre,
            "apellido"=>$apellido,
            "correo"=>$correo,
            "asunto"=>$asunto,
            "mensaje"=>$mensaje,
        ];

        $rules = [
            "nombre"=>"required",
            "apellido"=>"required",
            "correo"=>"required|email",
            "asunto"=>"required",
            "mensaje"=>"required",
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
            $mensaje_contacto = new MensajeContacto();
            $mensaje_contacto->nombre = $nombre;
            $mensaje_contacto->apellido = $apellido;
            $mensaje_contacto->correo = $correo;
            $mensaje_contacto->asunto = $asunto;
            $mensaje_contacto->mensaje = $mensaje;
            $mensaje_contacto->save();

            $response_estructure->set_response(true);
        }

        return response()->json($response_estructure->get_response_array());
    }
}
