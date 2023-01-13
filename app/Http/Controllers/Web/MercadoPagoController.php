<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ConfiguracionMercadoPago;

use MP; // MERCADOPAGO LIBRARY

use App\Publicacion;

class MercadoPagoController extends Controller
{
    public function crear_usuarios_de_prueba()
    {
        $config_mp = ConfiguracionMercadoPago::find(1);

        if($config_mp)
        {
            $config_mp = new MP($config_mp->CLIENT_ID, $config_mp->CLIENT_SECRET);

            $body = array(
                "site_id" => "MLA"
            );
  
            $result = $config_mp->post('/users/test_user', $body);
  
            var_dump($result);
  
            /*
            VENDEDOR
            ["id"]=> int(477007788) 
            ["nickname"]=> string(8) "TT984252" 
            ["password"]=> string(10) "qatest5908" 
            ["site_status"]=> string(6) "active" 
            ["email"]=> string(31) "test_user_50957479@testuser.com"

            COMPRADOR
            ["id"]=> int(477005050) 
            ["nickname"]=> string(12) "TEST0UOI6NIT" 
            ["password"]=> string(10) "qatest1226" 
            ["site_status"]=> string(6) "active" 
            ["email"]=> string(31) "test_user_47309305@testuser.com"

            Argentina	4509 9535 6623 3704
            APRO
            */
        }
    }

    public function pagar(Request $request,$id)
    {
        $config_mp = ConfiguracionMercadoPago::find(1);

        $id_usuario = $request->session()->get("id");
        
        $publicacion_obj = Publicacion::where("id",$id)->where("id_usuario",$id_usuario)->first();

        if($publicacion_obj && $config_mp)
        {
            $tipo_exposicion_obj = $publicacion_obj->get_tipo_exposicion_a_poner;

            if($tipo_exposicion_obj && $tipo_exposicion_obj->precio > 0)
            {
                if($publicacion_obj->estado_pago_exposicion == "pendiente")
                {
                    $config_mp = new MP ($config_mp->CLIENT_ID, $config_mp->CLIENT_SECRET);

                    $access_token = $config_mp->get_access_token();
                    $data = array('site_id' => 'MLA');

                    $preference_data = array(
                        "external_reference" => encrypt("publicacion_".$publicacion_obj->id),
                        "items" => array(
                            array(
                                "id" => "publicacion_".$publicacion_obj->id,
                                "title" => "Exposición ".$tipo_exposicion_obj->tipo_exposicion,
                                "category_id" => "Publicación",
                                "quantity" => 1,
                                "unit_price" => floatval(number_format((float)$publicacion_obj->precio_tipo_exposicion, 2, '.', '')),
                            )
                        ),
                        "auto_return" => "approved",
                        "back_urls" => array(
                            "failure" => url("/mp/pago_correcto"),
                            "pending" => url("/mp/pago_pendiente"),
                            "success" => url("/mp/pago_correcto"),
                        )
                    );

                    $preference = $config_mp->create_preference($preference_data);

                    return Redirect($preference['response']['init_point']);
                }
                else if($publicacion_obj->estado_pago_exposicion == "pagado")
                {
                    return View("frontend.publicaciones.publicacion_pagada")
                    ->with("publicacion_obj",$publicacion_obj);
                }
                else if($publicacion_obj->estado_pago_exposicion == "rechazado")
                {
                    return View("frontend.publicaciones.publicacion_rechazada")
                    ->with("publicacion_obj",$publicacion_obj);
                }
            }
        }
    }

    public function pago_correcto(Request $request)
    {
        $config_mp = ConfiguracionMercadoPago::find(1);

        if($config_mp)
        {
            $config_mp = new MP ($config_mp["CLIENT_ID"], $config_mp["CLIENT_SECRET"]);

            $external_reference = $request->input("external_reference");

            $decrypt_external_reference = decrypt($external_reference);

            if(strpos($decrypt_external_reference,"publicacion_") !== FALSE)
            {
                $id_publicacion = str_replace("publicacion_","",$decrypt_external_reference);

                $publicacion_obj = Publicacion::find($id_publicacion);

                if($publicacion_obj)
                {
                    $payment_info = $config_mp->get_payment_info($request->input("collection_id"));

                    $status_code = $payment_info["status"];
                    $transaction_amount = $payment_info["response"]["transaction_amount"];

                    $precio = floatval(number_format((float)$publicacion_obj->precio_tipo_exposicion, 2, '.', ''));

                    if($payment_info["status"] == 200 && $precio == $payment_info["response"]["transaction_amount"])
                    {
                        $view_to_load = "";

                        if($payment_info["response"]["status"] == 'approved')
                        {
                            $publicacion_obj->estado_pago_exposicion = "pagado";
                            $publicacion_obj->enviarCorreoEstadoPago();

                            $view_to_load = "publicacion_pagada";
                        }
                        else if($payment_info["response"]["status"] == 'rejected' || $payment_info["response"]["status"] == "cancelled")
                        {
                            $publicacion_obj->estado_pago_exposicion = "rechazado";
                            $publicacion_obj->enviarCorreoEstadoPago();

                            $view_to_load = "publicacion_rechazada";
                        }
                        else if($payment_info["response"]["status"] == 'in_process')
                        {
                            $publicacion_obj->estado_pago_exposicion = "pendiente";
                            $publicacion_obj->enviarCorreoEstadoPago();

                            $view_to_load = "publicacion_pendiente";
                        }

                        $publicacion_obj->id_mercado_pago = $request->get("collection_id");
                        $publicacion_obj->save();

                        if($view_to_load != "")
                        {
                            return View("frontend.publicaciones.".$view_to_load)
                            ->with("publicacion_obj",$publicacion_obj);
                        }
                    }
                }
            }
        }
    }

    public function pago_pendiente(Request $request)
    {
        $id_pago = $request->get("collection_id");

        $config_mp = ConfiguracionMercadoPago::find(1);

        $config_mp = new MP ($config_mp["CLIENT_ID"], $config_mp["CLIENT_SECRET"]);

        $payment_info = $config_mp->get_payment_info($id_pago);

        $external_reference = $payment_info["response"]["external_reference"];

        $decrypt_external_reference = decrypt($external_reference);

        if(strpos($decrypt_external_reference,"publicacion_") !== FALSE)
        {
            $id_publicacion = str_replace("publicacion_","",$decrypt_external_reference);

            $publicacion_obj = Publicacion::find($id_publicacion);

            if($publicacion_obj)
            {
                $publicacion_obj->estado_pago_exposicion = "pendiente";
                $publicacion_obj->id_mercado_pago = $id_pago;
                $publicacion_obj->save();

                $publicacion_obj->enviarCorreoEstadoPago();

                return View("frontend.publicaciones.publicacion_pendiente")
                ->with("publicacion_obj",$publicacion_obj);
            }
        }
    }

    public function notificacion_ipn(Request $request)
    {
        $id_pago = $request->get("id");

        $config_mp = ConfiguracionMercadoPago::find(1);

        $config_mp = new MP ($config_mp["CLIENT_ID"], $config_mp["CLIENT_SECRET"]);

        $payment_info = $config_mp->get_payment_info($id_pago);

        $external_reference = $payment_info["response"]["external_reference"];

        $decrypt_external_reference = decrypt($external_reference);

        if(strpos($decrypt_external_reference,"publicacion_") !== FALSE)
        {
            $id_publicacion = str_replace("publicacion_","",$decrypt_external_reference);

            $publicacion_obj = Publicacion::find($id_publicacion);

            if($publicacion_obj)
            {
                if($payment_info["response"]["status"] == 'approved')
                {
                    $publicacion_obj->estado_pago_exposicion = "pagado";
                }
                else if($payment_info["response"]["status"] == 'rejected' || $payment_info["response"]["status"] == "cancelled")
                {
                    $publicacion_obj->estado_pago_exposicion = "rechazado";
                }
                else if($payment_info["response"]["status"] == 'in_process')
                {
                    $publicacion_obj->estado_pago_exposicion = "pendiente";
                }

                $publicacion_obj->id_mercado_pago = $id_pago;
                $publicacion_obj->save();

                $publicacion_obj->enviarCorreoEstadoPago();
            }
        }
    }
}
