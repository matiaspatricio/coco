<?php

namespace App\Http\Controllers\Web\Publicaciones;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Subcategoria;

class SubCategoriasController extends Controller
{
    public function search_por_categoria(Request $request)
    {
        $busqueda = $request->input("q");
        $id_categoria = (int) $request->input("id_categoria");

        $rows = Subcategoria::where("id_categoria",$id_categoria)
        ->where("nombre","like","%".$busqueda."%")
        ->where("activa",1)
        ->get();

        $respuesta = [["id"=>"","text"=>"Seleccionar"]];

        if($rows)
        {
            foreach($rows as $row)
            {
                $respuesta[]= ["id"=>$row->id,"text"=>$row->nombre];
            }
        }

        return response()->json($respuesta);
    }

    public function get_subcategorias_de_categoria(Request $request)
    {
        $id_categoria = (int) $request->input("id_categoria");

        $rows = Subcategoria::where("id_categoria",$id_categoria)
        ->where("activa",1)
        ->get();

        return response()->json($rows);
    }
}
