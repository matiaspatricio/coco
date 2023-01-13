<?php

namespace App\Http\Controllers\Web\Publicaciones;

use Illuminate\Http\Request;

use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use App\Publicacion;
use App\PreguntaPublicacion;

class PreguntasPublicacionesController
{
    public function __construct()
    {
    }

    public function get_pagination(Request $request)
    {
        $id_publicacion = (int)$request->input("id_publicacion");

        $publicacion_obj = Publicacion::find($id_publicacion);

        $page = (int) $request->input("page");
        if($page == 0){$page = 1;}
        
        $id_paciente = (int) $request->input("id_paciente");

        $search = trim($request->input("search"));

        $data = DB::table("preguntas_publicaciones")
        ->join("publicaciones","publicaciones.id","=","preguntas_publicaciones.id_publicacion")
        ->join("usuarios","usuarios.id","=","preguntas_publicaciones.id_usuario")
        ->join("usuarios as usuarios2","usuarios2.id","=","publicaciones.id_usuario")
        ->select(
            "preguntas_publicaciones.*"
        )
        ->where("publicaciones.id",$id_publicacion)
        ->whereNotNull("respuesta");

        $totalData = $data->count();
        $totalFiltered =$totalData;
        
        $data = $data->orderBy("id","desc")->paginate(5);

        $function_js = "cargar_pagina";

        return View('frontend.publicaciones.preguntas.listado_paginacion')
        ->with("data",$data)
        ->with("function_js",$function_js)
        ->with("totalData",$totalData)
        ->with("totalFiltered",$totalFiltered)
        ->with("page",$page);
    }

    public function get_pagination_sin_responder(Request $request)
    {
        $id_publicacion = (int)$request->input("id_publicacion");

        $publicacion_obj = Publicacion::find($id_publicacion);

        $page = (int) $request->input("page");
        if($page == 0){$page = 1;}
        
        $id_paciente = (int) $request->input("id_paciente");

        $search = trim($request->input("search"));

        $data = DB::table("preguntas_publicaciones")
        ->join("publicaciones","publicaciones.id","=","preguntas_publicaciones.id_publicacion")
        ->join("usuarios","usuarios.id","=","preguntas_publicaciones.id_usuario")
        ->join("usuarios as usuarios2","usuarios2.id","=","publicaciones.id_usuario")
        ->select(
            "preguntas_publicaciones.*"
        )
        ->where("publicaciones.id",$id_publicacion)
        ->where("publicaciones.id_usuario",$request->session()->get("id"))
        ->whereNull("respuesta");

        $totalData = $data->count();
        $totalFiltered =$totalData;
        
        $data = $data->orderBy("id","desc")->paginate(5);

        $function_js = "cargar_pagina_preg_sin_responder";

        return View('frontend.publicaciones.preguntas.listado_paginacion_sin_responder')
        ->with("data",$data)
        ->with("function_js",$function_js)
        ->with("totalData",$totalData)
        ->with("totalFiltered",$totalFiltered)
        ->with("page",$page);
    }
    
}
