<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpresaController extends Controller
{
    
    public function sobre_nosotros(Request $request)
    {
        return View("frontend.empresa.sobre_nosotros");
    }
    
    public function afiliate(Request $request)
    {
        return View("frontend.empresa.afiliate");
    }
    
    public function carrera(Request $request)
    {
        return View("frontend.empresa.carrera");
    }
    
}
