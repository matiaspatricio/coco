<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NegociosController extends Controller
{
    public function nuestra_prensa(Request $request)
    {
        return View("frontend.negocios.nuestra_prensa");
    }

    public function revisa(Request $request)
    {
        return View("frontend.negocios.revisa");
    }

    public function tienda(Request $request)
    {
        return View("frontend.negocios.tienda");
    }

}
