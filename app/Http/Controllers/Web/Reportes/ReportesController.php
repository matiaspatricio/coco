<?php

namespace App\Http\Controllers\Web\Reportes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Library\ResponseEstructure;

use App\Publicacion;
use App\ReportePublicacion;

class ReportesController extends Controller
{
    public function realizar_reporte(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $titulo = trim($request->input("titulo"));
        $descripcion = trim($request->input("descripcion"));
        $id_publicacion	 = trim($request->input("id_publicacion"));
        $id_usuario = $request->session()->get("id");

        $input= [
            "titulo"=>$titulo,
            "descripcion"=>$descripcion,
            "id_publicacion"=>$id_publicacion,
        ];

        $rules = [
            "titulo"=>"required|min:12",
            "descripcion"=>"required|min:50",
            "id_publicacion"=>"required|numeric",
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
            $publicacion_obj = Publicacion::find($id_publicacion);
            
            // SI LA PUBLICACION EXISTE Y ESTÁ ACTIVA
            if($publicacion_obj && $publicacion_obj->id_estado_publicacion == 2 && $publicacion_obj->id_usuario != $id_usuario)
            {
                $reporte_publicacion_obj = new ReportePublicacion();
                $reporte_publicacion_obj->titulo = $titulo;
                $reporte_publicacion_obj->descripcion = $descripcion;
                $reporte_publicacion_obj->id_usuario = $id_usuario;
                $reporte_publicacion_obj->id_publicacion = $publicacion_obj->id;
                $reporte_publicacion_obj->save();

                $response_estructure->set_response(true);
            }
            else
            {
                $response_estructure->add_message_error("No se encontró la publicación");
            }
        }

        return response()->json($response_estructure->get_response_array());
    }
}
