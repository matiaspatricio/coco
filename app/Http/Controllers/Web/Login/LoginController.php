<?php

namespace App\Http\Controllers\Web\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Library\LoginCore;
use App\Library\SessionHelper;

use App\Usuario;
use App\ConfirmacionUsuario;

use App\Provincia;
use App\Localidad;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return View("frontend.login");
    }

    public function ingresar_post(Request $request)
    {
        $login_core = new LoginCore();
        return response()->json($login_core->ingresar($request));
    }

    public function registrarse(Request $request)
    {
        $provincias = Provincia::orderBy("provincia")->get();

        return View("frontend.register")
        ->with("provincias",$provincias);
    }

    public function registrarse_post(Request $request)
    {
        $login_core = new LoginCore();
        $id_rol = 2; // FOR USER FRONTEND
        return response()->json($login_core->registrarse($request,$id_rol));
    }

    public function olvide_mis_datos()
    {
        return View("frontend.forgot_data");
    }

    public function forgot_password(Request $request)
    {
        $login_core = new LoginCore();
        return response()->json($login_core->forgot_password($request));
    }

    public function cerrar_sesion(Request $request)
    {
        $login_core = new LoginCore();
        $login_core->cerrar_sesion($request);

        return Redirect("/");
    }

    public function confirmar_correo(Request $request)
    {
        $code = urldecode($request->input("code"));

        $respuesta = false;

        $confirmacion_usuario_obj = ConfirmacionUsuario::where("key",$code)->where("usado",0)->first();
        
        if($confirmacion_usuario_obj)
        {
            $usuario_obj = $confirmacion_usuario_obj->get_usuario;

            if($usuario_obj)
            {
                $usuario_obj->correo_confirmado = true;
                $usuario_obj->save();

                $confirmacion_usuario_obj->usado = true;
                $confirmacion_usuario_obj->save();

                $respuesta = true;

                // SI EL USUARIO ESTÁ ACTIVO INICIA SESION
                if($usuario_obj->id_estado_usuario == 1) 
                {
                    $request->session()->put("id",$usuario_obj->id);

                    $session_helper = new SessionHelper();
                    $session_helper->actualiza_session_usuario($request);
                }
            }
        }

        return View("frontend.cuenta_activada")
        ->with("respuesta",$respuesta);
    }

    public function enviar_correo_activacion(Request $request)
    {
        $correo = trim(strtolower($request->input("correo")));

        return View("frontend.enviar_correo_activacion")
        ->with("correo",$correo);
    }

    public function enviar_correo_activacion_post(Request $request)
    {
        $login_core = new LoginCore();
        return response()->json($login_core->enviar_correo_activacion_post($request));
    }
}
