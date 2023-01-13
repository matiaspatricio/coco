<?php

namespace App\Http\Controllers\Web\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\SliderHome;
use App\Publicacion;
use App\Categoria;
use App\Localidad;

class HomeController extends Controller
{
    public function index(Request $request)
    {
      $slider_home = SliderHome::where("activo",1)->orderBy("id","desc")->get();

      $ultimas_publicaciones = Publicacion::get_ultimas_publicaciones();
      $publicaciones_mas_vistas = Publicacion::get_publicaciones_mas_visitadas();

      return View("frontend.home")
      ->with("slider_home",$slider_home)
      ->with("ultimas_publicaciones",$ultimas_publicaciones)
      ->with("publicaciones_mas_vistas",$publicaciones_mas_vistas);
    }

    public function get_localidades_provincia(Request $request)
    {
      $response_estructure = new ResponseEstructure();
      $response_estructure->set_response(false);

      $id_provincia = $request->input("id_provincia");

      $input = [
        "id_provincia" => $id_provincia,
      ];

      $rules = [
        "id_provincia" => "required|numeric",
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
        $localidades = Localidad::where("id_provincia",$id_provincia)->orderBy("localidad")->get();

        $response_estructure->set_data(["localidades"=>$localidades]);

        $response_estructure->set_response(true);
      }

      return response()->json($response_estructure->get_response_array());
    }

    public function suscribirme(Request $request)
    {
      $response_estructure = new ResponseEstructure();
      $response_estructure->set_response(false);

      $correo = trim(strtolower($request->input("correo")));
      
      $input = [
        "correo" => $correo,
      ];

      $rules = [
        "correo" => "required|email",
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
        $new_newsletter = \App\Newsletter::where("correo",$correo)->first();

        if(!$new_newsletter)
        {
          $new_newsletter = new \App\Newsletter();
          $new_newsletter->correo = $correo;
          $new_newsletter->save();
        }

        $response_estructure->set_response(true);
      }

      return response()->json($response_estructure->get_response_array());
    }

    public function test_ml_js(Request $request)
    {
        return View("frontend.test_ml_js");
    }
}
