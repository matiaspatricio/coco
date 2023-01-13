<?php
namespace App\Library;

use Illuminate\Http\Request;
use App\Usuario;

class SessionHelper
{
    public function actualiza_session_usuario(Request $request)
	{
        $request->session()->put("ingreso_backend",false);
        $request->session()->put("ingreso_frontend",false);

        $usuario_obj = Usuario::find($request->session()->get("id"));

        if($usuario_obj && $usuario_obj->id_estado_usuario == 1 && $usuario_obj->eliminado == false)
        {
            $request->session()->put("nombre",$usuario_obj->nombre);
            $request->session()->put("apellido",$usuario_obj->apellido);
            $request->session()->put("correo",$usuario_obj->correo);
            $request->session()->put("usuario",$usuario_obj->usuario);
            $request->session()->put("password",$usuario_obj->password);
            $request->session()->put("id_rol",$usuario_obj->id_rol);
            $request->session()->put("foto_perfil",$usuario_obj->foto_perfil);

            if($usuario_obj->id_rol == 1) // ADMINISTRADOR
            {
                $request->session()->put("ingreso_backend",true);
            }
            else if($usuario_obj->id_rol == 2){ // USUARIO FRONTEND
                $request->session()->put("ingreso_frontend",true);
            }
            else{
                $this->destroy_session($request);
            }
        }
        else{
            $this->destroy_session($request);
        }
	}

    public function destroy_session(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->flush();
    }
}

?>