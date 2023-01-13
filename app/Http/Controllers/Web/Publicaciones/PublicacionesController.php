<?php

namespace App\Http\Controllers\Web\Publicaciones;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Library\ResponseEstructure;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSender;

use App\Publicacion;
use App\PreguntaPublicacion;
use App\VisitaPublicacion;
use App\FavoritoPublicacion;
use App\TipoPublicacion;
use App\Categoria;
use App\Genero;
use App\Provincia;
use App\Color;
use App\ImagenPublicacion;
use App\RangoPrecioPublicacion;
use App\TipoOperacion;
use App\TipoExposicion;
use App\Garantia;
use App\MedioDePago;
use App\Localidad;
use App\MedioDePagoPublicacion;
use App\ProvLocPublicacion;
use App\ColorPublicacion;
use App\Talle;


class PublicacionesController extends Controller
{
    public function ver(Request $request,$titulo,$id)
    {
        $publicacion_obj = Publicacion::find($id);

        if($publicacion_obj)
        {
            $visita_publicacion = VisitaPublicacion::where("ip_visitor",$request->ip())->first();

            if(!$visita_publicacion)
            {
                $visita_publicacion = new VisitaPublicacion();
                $visita_publicacion->ip_visitor = $request->ip();
                $visita_publicacion->id_publicacion = $publicacion_obj->id;
                $visita_publicacion->save();

                $publicacion_obj->visitas = ($publicacion_obj->visitas +1);
                $publicacion_obj->save();
            }

            $favorito_publicacion = null;

            if($request->session()->get("ingreso_frontend") === true)
            {
                $id_usuario = $request->session()->get("id");

                $favorito_publicacion = FavoritoPublicacion::where("id_publicacion",$publicacion_obj->id)->where("id_usuario",$id_usuario)->first();
            }

            $mas_publicaciones_publicador = Publicacion::where("id_usuario",$publicacion_obj->id_usuario)
            ->where("id_estado_publicacion",2)->where("id","<>",$publicacion_obj->id)
            ->orderBy("id")->take(3)->get();

            $publicaciones_relacionadas = Publicacion::where("id_subcategoria",$publicacion_obj->id_subcategoria)
            ->where("id_estado_publicacion",2)
            ->orderBy(DB::raw('RAND()'))->take(12)->get();

            $colores = Color::all();

            return View("frontend.publicaciones.ver_publicacion")
            ->with("publicacion_obj",$publicacion_obj)
            ->with("favorito_publicacion",$favorito_publicacion)
            ->with("mas_publicaciones_publicador",$mas_publicaciones_publicador)
            ->with("publicaciones_relacionadas",$publicaciones_relacionadas)
            ->with("colores",$colores);
        }
        else
        {
            return View("frontend.publicaciones.publicacion_no_encontrada");
        }
    }

    public function agregar_pregunta(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $pregunta = trim($request->input("pregunta"));
        $id_publicacion	 = trim($request->input("id_publicacion"));
        $id_usuario = $request->session()->get("id");

        $input= [
            "pregunta"=>$pregunta,
            "id_publicacion"=>$id_publicacion,
        ];

        $rules = [
            "pregunta"=>"required|min:12",
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
                $pregunta_publicacion_obj = new PreguntaPublicacion();
                $pregunta_publicacion_obj->pregunta = $pregunta;
                $pregunta_publicacion_obj->id_usuario = $id_usuario;
                $pregunta_publicacion_obj->id_publicacion = $publicacion_obj->id;
                $pregunta_publicacion_obj->save();

                // ENVIO DE CORREO
                $usuario = $publicacion_obj->get_usuario;

                $email_sender = new \stdClass();
                $email_sender->asunto = "Nueva pregunta en tu publicación";
                $email_sender->apellido = $usuario->apellido;
                $email_sender->nombre = $usuario->nombre;
                $email_sender->publicacion_obj = $publicacion_obj;
                $email_sender->pregunta = $pregunta;

                $response = Mail::to($usuario->correo)
                ->send(
                    new EmailSender(
                        $email_sender,
                        $email_sender->asunto,"emails.nueva_pregunta"
                    )
                );
                // FIN ENVIO DE CORREO

                $response_estructure->set_response(true);
            }
            else
            {
                $response_estructure->add_message_error("No se encontró la publicación");
            }
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function responder_pregunta(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id_pregunta_publicacion = $request->input("id_pregunta_publicacion");
        $respuesta = trim($request->input("respuesta"));
        $id_usuario = $request->session()->get("id");

        $input= [
            "id_pregunta_publicacion"=>$id_pregunta_publicacion,
            "respuesta"=>$respuesta
        ];

        $rules = [
            "id_pregunta_publicacion"=>"required|numeric",
            "respuesta"=>"required|min:2"
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
            $pregunta_publicacion_obj = PreguntaPublicacion::find($id_pregunta_publicacion);

            // SI LA PREGUNTA EXISTE
            if($pregunta_publicacion_obj)
            {
                $publicacion_obj = $pregunta_publicacion_obj->get_publicacion;

                // SI EXISTE LA PUBLICACION Y ESTÁ ACTIVA
                if($publicacion_obj && $publicacion_obj->id_estado_publicacion == 2 && $publicacion_obj->id_usuario == $id_usuario && $pregunta_publicacion_obj->respuesta == null)
                {
                    $pregunta_publicacion_obj->respuesta = $respuesta;
                    $pregunta_publicacion_obj->save();


                    // ENVIO DE CORREO
                    $usuario = $pregunta_publicacion_obj->get_usuario_pregunta;

                    $email_sender = new \stdClass();
                    $email_sender->asunto = "Te respondieron tu pregunta en la publicación";
                    $email_sender->apellido = $usuario->apellido;
                    $email_sender->nombre = $usuario->nombre;
                    $email_sender->publicacion_obj = $publicacion_obj;
                    $email_sender->pregunta_publicacion_obj = $pregunta_publicacion_obj;

                    $response = Mail::to($usuario->correo)
                    ->send(
                        new EmailSender(
                            $email_sender,
                            $email_sender->asunto,"emails.te_respondieron"
                        )
                    );
                    // FIN ENVIO DE CORREO

                    $response_estructure->set_response(true);
                }
                else
                {
                    $response_estructure->add_message_error("No se encontró la publicación");
                }
            }
            else
            {
                $response_estructure->add_message_error("No se encontró la pregunta");
            }
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function agregar_a_favorito(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id_publicacion = $request->input("id_publicacion");
        $id_usuario = $request->session()->get("id");

        $input= [
            "id_publicacion"=>$id_publicacion,
        ];

        $rules = [
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

                $publicacion_obj = Publicacion::where("id",$id_publicacion)->first();

                // SI EXISTE LA PUBLICACION Y ESTÁ ACTIVA
                if($publicacion_obj && $publicacion_obj->id_estado_publicacion == 2 && $publicacion_obj->id_usuario != $id_usuario)
                {

                $favorito_publicacion = FavoritoPublicacion::where("id_publicacion",$publicacion_obj->id)->where("id_usuario",$id_usuario)->first();

                $data = ["agregado" => false];

                if($favorito_publicacion)
                {
                    $favorito_publicacion->delete();
                    $data["agregado"] = false;
                }
                else {

                    $favorito_publicacion = new FavoritoPublicacion();
                    $favorito_publicacion->id_publicacion = $publicacion_obj->id;
                    $favorito_publicacion->id_usuario = $id_usuario;
                    $favorito_publicacion->save();

                    $data["agregado"] = true;
                }

                $data["cantidad_favoritos"] = FavoritoPublicacion::where("id_usuario",$id_usuario)->count();

                $response_estructure->set_data($data);
                $response_estructure->set_response(true);
                }
                else
                {
                    $response_estructure->add_message_error("No se encontró la publicación");
                }
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function publicar(Request $request,$id_tipo_publicacion = null,$tipo=null)
    {
        $tipo = ucfirst(strtolower(trim($tipo)));

        $id_tipo_publicacion = strtolower(trim($id_tipo_publicacion));
        $nombre_tipo_publicacion = $id_tipo_publicacion;

        if($id_tipo_publicacion == "oferta")
        {
            $id_tipo_publicacion = TipoPublicacion::OFERTA;
        }
        else if($id_tipo_publicacion == "demanda")
        {
            $id_tipo_publicacion = TipoPublicacion::DEMANDA;
        }

        if($request->session()->get("ingreso_frontend") === true)
        {
            // SI EL ID_TIPO NO ES OFERTA O DEMANDA
            if($id_tipo_publicacion != TipoPublicacion::OFERTA && $id_tipo_publicacion != TipoPublicacion::DEMANDA)
            {
              return View("frontend.publicaciones.publicar.seleccionar_id_tipo_publicacion");
            }
            else if($tipo != "Bienes" && $tipo != "Servicios")
            {
              return View("frontend.publicaciones.publicar.seleccionar_tipo_publicacion")
              ->with("id_tipo_publicacion",$id_tipo_publicacion)
              ->with("nombre_tipo_publicacion",$nombre_tipo_publicacion);
            }
            else
            {
                if($id_tipo_publicacion == TipoPublicacion::OFERTA)
                {
                    if($tipo == "Bienes")
                    {
                        $tipos_publicaciones = TipoPublicacion::all();
                        $categorias = Categoria::all();
                        $generos = Genero::all();
                        $provincias = Provincia::orderBy("provincia")->get();
                        $colores = Color::all();
                        $tipos_operaciones = TipoOperacion::all();
                        $tipos_exposiciones = TipoExposicion::all();
                        $garantias = Garantia::all();
                        $medios_de_pago = MedioDePago::all();
                        $talles = Talle::all();

                        $localidades = array();

                        if(count($provincias))
                        {
                            $localidades = Localidad::where("id_provincia",$provincias[0]->id)
                            ->orderBy("localidad")->get();
                        }

                        return View("frontend.publicaciones.publicar.publicar_oferta_producto")
                        ->with("tipo",$tipo)
                        ->with("id_tipo_publicacion",$id_tipo_publicacion)
                        ->with("tipos_publicaciones",$tipos_publicaciones)
                        ->with("categorias",$categorias)
                        ->with("generos",$generos)
                        ->with("provincias",$provincias)
                        ->with("localidades",$localidades)
                        ->with("colores",$colores)
                        ->with("tipos_operaciones",$tipos_operaciones)
                        ->with("tipos_exposiciones",$tipos_exposiciones)
                        ->with("garantias",$garantias)
                        ->with("medios_de_pago",$medios_de_pago)
                        ->with("talles",$talles);
                    }
                    else if($tipo == "Servicios")
                    {
                        $tipos_publicaciones = TipoPublicacion::all();
                        $categorias = Categoria::all();
                        $generos = Genero::all();
                        $provincias = Provincia::orderBy("provincia")->get();
                        $colores = Color::all();
                        $tipos_operaciones = TipoOperacion::all();
                        $tipos_exposiciones = TipoExposicion::all();
                        $garantias = Garantia::all();
                        $medios_de_pago = MedioDePago::all();
                        $talles = Talle::all();

                        $localidades = array();

                        if(count($provincias))
                        {
                            $localidades = Localidad::where("id_provincia",$provincias[0]->id)
                            ->orderBy("localidad")->get();
                        }

                        return View("frontend.publicaciones.publicar.publicar_oferta_servicio")
                        ->with("tipo",$tipo)
                        ->with("id_tipo_publicacion",$id_tipo_publicacion)
                        ->with("tipos_publicaciones",$tipos_publicaciones)
                        ->with("categorias",$categorias)
                        ->with("generos",$generos)
                        ->with("provincias",$provincias)
                        ->with("localidades",$localidades)
                        ->with("colores",$colores)
                        ->with("tipos_operaciones",$tipos_operaciones)
                        ->with("tipos_exposiciones",$tipos_exposiciones)
                        ->with("garantias",$garantias)
                        ->with("medios_de_pago",$medios_de_pago)
                        ->with("talles",$talles);
                    }
                }
            }
        }
        else
        {
            return View("frontend.publicaciones.registrarse_para_publicar");
        }
    }

    public function agregar_publicacion_oferta(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $data = array();

        $titulo = ucfirst(trim($request->input("titulo"))); // LISTO
        $descripcion = $request->input("descripcion"); // LISTO

        $cantidad = $request->input("cantidad");
        $condicion = $request->input("condicion");
        $precio = $request->input("precio");
        $fecha_vencimiento = trim($request->input("fecha_vencimiento"));
        $id_categoria = $request->input("id_categoria"); // LISTO
        $id_subcategoria = $request->input("id_subcategoria"); // LISTO
        $id_tipo_operacion = $request->input("id_tipo_operacion"); // LISTO
        $id_tipo_exposicion = $request->input("id_tipo_exposicion"); // LISTO
        $id_garantia = $request->input("id_garantia"); // LISTO
        $link_video_youtube = $request->input("link_video_youtube");
        $marca = trim($request->input("marca"));
        $modelo = $request->input("modelo");
        $version = $request->input("version");
        $colores = $request->input("colores");
        $id_genero = $request->input("id_genero");
        $cantidad_minima = $request->input("cantidad_minima");

        $id_provincia_alcanze = $request->input("id_provincia_alcanze");
        $id_ciudad_alcanze = $request->input("id_ciudad_alcanze");

        $tipo = $request->input("tipo");
        $id_tipo_publicacion = $request->input("id_tipo_publicacion");

        $imagen_1 = $request->input("imagen_1");
        $imagen_2 = $request->input("imagen_2");
        $imagen_3 = $request->input("imagen_3");
        $imagen_4 = $request->input("imagen_4");
        $imagen_5 = $request->input("imagen_5");
        
        /*
        $link = 'http://www.youtube.com/watch?v=mw2fA4Z1f98';
        $link = 'http://www.youtube.com/v/mw2fA4Z1f98';

        if (preg_match('@^(?:http://(?:www\\.)?youtube.com/)(watch\\?v=|v/)([a-zA-Z0-9_]*)@', $link, $match)) {
            print 'true';
        } else {
            print 'false';
        }
        */

        /*
        A USAR:
        RangoPrecioPublicacion

        */

        $rangos_precios = array();

        try
        {
            $rangos_precios = json_decode($request->input("rangos_precios"),true);
        }catch(Exception $e){

        }

        $medios_de_pagos = array();

        try{
          $medios_de_pagos = json_decode($request->input("medios_de_pagos"),true);
        }
        catch(Exception $e){}

        $provincias = array();

        try{
            $provincias = json_decode($request->input("provincias"),true);
        }
        catch(Exception $e){}

        $localidades = array();

        try{
            $localidades = json_decode($request->input("localidades"),true);
        }
        catch(Exception $e){}

        $input= [
            "titulo"=>$titulo,
            "descripcion"=>$descripcion,
            "cantidad"=>$cantidad,
            "cantidad_minima"=>$cantidad_minima,
            "marca"=>$marca,
            "condicion"=>$condicion,
            "precio_total"=>$precio,
            "categoria"=>$id_categoria,
            "subcategoria"=>$id_subcategoria,
            "tipo_de_operacion"=>$id_tipo_operacion,
            "tipo_de_exposicion"=>$id_tipo_exposicion,
            "garantia"=>$id_garantia,
            "tipo"=>$tipo,
            "tipo_de_publicacion"=>$id_tipo_publicacion,


            "imagen_1"=>$imagen_1,
            "imagen_2"=>$imagen_2,
            "imagen_3"=>$imagen_3,
            "imagen_4"=>$imagen_4,
            "imagen_5"=>$imagen_5

        ];

        $rules = [
            "titulo"=>"required|min:15|max:60",
            "descripcion"=>"required|min:50",
            "cantidad"=>"required|numeric|min:1",
            "cantidad_minima"=>"required|numeric|min:1",
            "marca"=>"required|min:3",
            "condicion"=>"required",
            "precio_total"=>"required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
            "categoria"=>"required",
            "subcategoria"=>"required",
            "tipo_de_operacion"=>"required",
            "tipo"=>"required",
            "tipo_de_publicacion"=>"required",
            "tipo_de_exposicion"=>"required",
            "garantia"=>"required",


            "imagen_1"=>"required",
            "imagen_2"=>"required",
            "imagen_3"=>"required",
            "imagen_4"=>"required",
            "imagen_5"=>"required",
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
            $paso_validaciones = true;

            $tipo_exposicion_obj = TipoExposicion::find($id_tipo_exposicion);

            if(!is_array($medios_de_pagos) || count($medios_de_pagos) == 0)
            {
                $paso_validaciones = false;
                $response_estructure->add_message_error("Seleccione los medios de pago");
            }

            if(!$tipo_exposicion_obj)
            {
                $paso_validaciones = false;
                $response_estructure->add_message_error("Seleccione un tipo de exposición");
            }

            if($paso_validaciones)
            {   
                if($fecha_vencimiento != "")
                {
                    $fecha_vencimiento = \DateTime::createFromFormat("d/m/Y",$fecha_vencimiento);
                    $fecha_vencimiento = $fecha_vencimiento->format("Y-m-d");
                }

                $publicacion_obj = new Publicacion();
                $publicacion_obj->titulo = $titulo;
                $publicacion_obj->descripcion = $descripcion;
                $publicacion_obj->cantidad = $cantidad;
                $publicacion_obj->marca = $marca;
                $publicacion_obj->condicion = $condicion;
                $publicacion_obj->precio_desde = $precio;
                $publicacion_obj->precio_hasta = $precio;
                $publicacion_obj->fecha_vencimiento = $fecha_vencimiento;
                $publicacion_obj->id_categoria = $id_categoria;
                $publicacion_obj->id_subcategoria = $id_subcategoria;
                $publicacion_obj->id_tipo_operacion = $id_tipo_operacion;

                if($tipo_exposicion_obj->precio <= 0)
                {
                    $publicacion_obj->id_tipo_exposicion = 1; // GRATUITA
                    $publicacion_obj->precio_tipo_exposicion = 0;
                    $publicacion_obj->estado_pago_exposicion = "pagado";
                }
                else
                {
                    $publicacion_obj->id_tipo_exposicion = 1; // GRATUITA
                    $publicacion_obj->id_tipo_exposicion_a_poner =  $id_tipo_exposicion;
                    $publicacion_obj->precio_tipo_exposicion = $tipo_exposicion_obj->precio;
                    $publicacion_obj->estado_pago_exposicion = "pendiente";
                }

                $publicacion_obj->id_garantia = $id_garantia;
                $publicacion_obj->link_video_youtube = $link_video_youtube;

                $publicacion_obj->modelo = $modelo;
                $publicacion_obj->version = $version;
                $publicacion_obj->id_genero = $id_genero;
                $publicacion_obj->cantidad_minima = $cantidad_minima;

                $publicacion_obj->condicion = $condicion;

                $publicacion_obj->tipo = $tipo;
                $publicacion_obj->id_tipo_publicacion = $id_tipo_publicacion;


                $publicacion_obj->id_estado_publicacion = 2;
                $publicacion_obj->id_usuario = $request->session()->get("id");

                // OBTENIENDO LA IMAGEN PRINCIPAL
                $publicacion_obj->imagen_principal = $imagen_1;

                $publicacion_obj->save();


                $data["id_publicacion"] = $publicacion_obj->id;
                $data["url_publicacion"] = $publicacion_obj->get_url();

                $response_estructure->set_response(true);

                // AGREGANDO IMÁGENES
                $imagen_publicacion = new ImagenPublicacion();
                $imagen_publicacion->file_name = $imagen_1;
                $imagen_publicacion->id_publicacion = $publicacion_obj->id;
                $imagen_publicacion->save();

                $imagen_publicacion = new ImagenPublicacion();
                $imagen_publicacion->file_name = $imagen_2;
                $imagen_publicacion->id_publicacion = $publicacion_obj->id;
                $imagen_publicacion->save();

                $imagen_publicacion = new ImagenPublicacion();
                $imagen_publicacion->file_name = $imagen_3;
                $imagen_publicacion->id_publicacion = $publicacion_obj->id;
                $imagen_publicacion->save();

                $imagen_publicacion = new ImagenPublicacion();
                $imagen_publicacion->file_name = $imagen_4;
                $imagen_publicacion->id_publicacion = $publicacion_obj->id;
                $imagen_publicacion->save();

                $imagen_publicacion = new ImagenPublicacion();
                $imagen_publicacion->file_name = $imagen_5;
                $imagen_publicacion->id_publicacion = $publicacion_obj->id;
                $imagen_publicacion->save();
                // FIN AGREGANDO IMÁGENES

                // AGREGANDO RANGOS DE PRECIOS
                if(is_array($rangos_precios))
                {
                    foreach($rangos_precios as $rangos_precio_row)
                    {
                        try
                        {
                            $rango_precio_obj = new RangoPrecioPublicacion();
                            $rango_precio_obj->cantidad_desde = $rangos_precio_row["cantidad_desde"];
                            $rango_precio_obj->cantidad_hasta = $rangos_precio_row["cantidad_hasta"];
                            $rango_precio_obj->precio = $rangos_precio_row["precio"];
                            $rango_precio_obj->id_publicacion = $publicacion_obj->id;
                            $rango_precio_obj->save();

                        }
                        catch(Exception $e)
                        {

                        }
                    }
                }
                // FIN AGREGANDO MEDIOS DE PAGO

                // AGREGANDO RANGOS DE PRECIOS
                if(is_array($medios_de_pagos))
                {
                    foreach($medios_de_pagos as $medio_de_pago_row)
                    {
                        try
                        {
                            $medio_de_pago_obj = new MedioDePagoPublicacion();
                            $medio_de_pago_obj->id_medio_de_pago = $medio_de_pago_row;
                            $medio_de_pago_obj->id_publicacion = $publicacion_obj->id;
                            $medio_de_pago_obj->save();
                        }
                        catch(Exception $e)
                        {

                        }
                    }
                }
                // FIN AGREGANDO MEDIOS DE PAGO

                // AGREGANDO COLORES
                if(strpos($colores,",") !== false || is_numeric($colores))
                {
                    $colores = explode(",",$colores);

                    foreach($colores as $color_row)
                    {
                        if(is_numeric($color_row))
                        {
                            $color_publicacion_obj = new ColorPublicacion();
                            $color_publicacion_obj->id_color = $color_row;
                            $color_publicacion_obj->id_publicacion = $publicacion_obj->id;
                            $color_publicacion_obj->save();
                        }
                    }
                }
                //

                $this->agregarProvinciasLocalidadesPublicacion($provincias,$localidades,$publicacion_obj->id);
            }
        }

        $response_estructure->set_data($data);

        return response()->json($response_estructure->get_response_array());
    }

    private function agregarProvinciasLocalidadesPublicacion($provincias,$localidades,$id_publicacion)
    {
        try
        {
            if($provincias != null && is_array($provincias))
            {
                foreach($provincias as $id_provincia)
                {
                    $localidades_encontradas = false;

                    foreach($localidades as $localidad_row)
                    {
                        if($localidad_row["id_provincia"] == $id_provincia)
                        {
                            $localidades_encontradas = true;

                            $prov_loc_publicacion = new ProvLocPublicacion();
                            $prov_loc_publicacion->id_localidad = $localidad_row["id"];
                            $prov_loc_publicacion->id_publicacion = $id_publicacion;
                            $prov_loc_publicacion->save();
                        }
                    }

                   
                    $prov_loc_publicacion = new ProvLocPublicacion();
                    $prov_loc_publicacion->id_provincia = $id_provincia;
                    $prov_loc_publicacion->id_publicacion = $id_publicacion;
                    $prov_loc_publicacion->save();
                    
                } 
            }
        }
        catch(Exception $e)
        {

        }
    }

}
