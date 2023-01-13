<?php

namespace App\Http\Controllers\Backend\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\Controller;
use App\Library\SessionHelper;
use Illuminate\Support\Facades\Hash;

use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;

use App\Usuario;

use App\Library\LoginCore;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return View("backend.login.login");
    }

    public function recuperar_datos()
    {
        return View("backend.login.forgot");
    }

    public function ingresar(Request $request)
    {
        $login_core = new LoginCore();
        return response()->json($login_core->ingresar($request));
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

        return Redirect("/backend");
    }
}
