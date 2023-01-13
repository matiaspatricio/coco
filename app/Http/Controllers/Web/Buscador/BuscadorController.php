<?php

namespace App\Http\Controllers\Web\Buscador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Categoria;
use App\Subcategoria;
use App\Publicacion;
use App\Color;
use App\Talle;

class BuscadorController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categoria::where("activa",true)->get();
        $subcategorias = null;
        $categoria_selecionada_obj = null;
        $colores = Color::orderBy("nombre")->get();
        $talles = Talle::all();
        
        $texto = trim($request->input("texto"));

        $id_categoria = (int)$request->input("id_categoria");
        $id_subcategoria = (int)$request->input("id_subcategoria");

        
        $tipo_ordenamiento = (int)$request->input("tipo_ordenamiento");

        if($tipo_ordenamiento < 0 || $tipo_ordenamiento > 3)
        {
            $tipo_ordenamiento = 0;
        }

        // PUBLICACIONES
        $publicaciones=
        Publicacion::join("usuarios","usuarios.id","=","publicaciones.id_usuario")
        ->select(
            'publicaciones.*',
            "usuarios.usuario as vendedor",
            "usuarios.nombre as vendedor_nombre",
            "usuarios.apellido as vendedor_apellido"
        )
        ->where("publicaciones.id_estado_publicacion",2)
        ->where("usuarios.id_estado_usuario",1);

        
        if($texto != "")
        {
            $publicaciones = $publicaciones->where("titulo","like",'%'.$texto.'%');
        }

        if($id_categoria != 0)
        {
            $publicaciones = $publicaciones->where("publicaciones.id_categoria",$id_categoria);

            $subcategorias = Subcategoria::where("activa",true)->where("id_categoria",$id_categoria)->get();
            $categoria_selecionada_obj = Categoria::where("id",$id_categoria)->where("activa",true)->first();
        }

        /* 
        0 - Ordenar por último
        1 - Ordenar por popularidad
        2 - Ordenar por precio: de menor a mayor
        3 - Ordenar por precio: de mayor a menor
        */

        switch($tipo_ordenamiento)
        {
            case 1:
                $publicaciones = $publicaciones->orderBy("publicaciones.visitas","desc");
            break;

            case 2:
                $publicaciones = $publicaciones->orderBy("publicaciones.precio_desde","asc")->orderBy("publicaciones.precio_hasta","asc");
            break;

            case 3:
                $publicaciones = $publicaciones->orderBy("publicaciones.precio_desde","desc")->orderBy("publicaciones.precio_hasta","desc");
            break;

            default:
                $publicaciones = $publicaciones->orderBy("publicaciones.id","desc");
            break;
        }
        
        
        $publicaciones = $publicaciones->paginate(9);

        $publicaciones->appends(
            [
                'texto' => trim($request->input("texto"))
            ]
        );
        

        // FIN PUBLICACIONES

        return View("frontend.buscador.buscar")
        ->with("publicaciones",$publicaciones)
        ->with("categorias",$categorias)
        ->with("subcategorias",$subcategorias)
        ->with("categoria_selecionada_obj",$categoria_selecionada_obj)
        ->with("colores",$colores)
        ->with("talles",$talles)
        ->with("texto",$texto);
    }

    public function listado_de_categorias(Request $request)
    {
        $categorias = Categoria::where("activa",true)->get();

        return View("frontend.buscador.listado_de_categorias")
        ->with("categorias",$categorias);
    }
}
