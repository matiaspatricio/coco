<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnlacesRapidosController extends Controller
{
    public function politica(Request $request)
    {
        return View("frontend.enlaces_rapidos.politica");
    }

    public function terminos_y_condiciones(Request $request)
    {
        return View("frontend.enlaces_rapidos.terminos_y_condiciones");
    }

    public function envios(Request $request)
    {
        return View("frontend.enlaces_rapidos.envios");
    }

    public function devoluciones(Request $request)
    {
        return View("frontend.enlaces_rapidos.devoluciones");
    }

    public function preguntas_frecuentes(Request $request)
    {
        return View("frontend.enlaces_rapidos.preguntas_frecuentes");
    }

}
