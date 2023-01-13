<?php

namespace App\Http\Controllers\Web\Pagos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use MP;

class PagosController extends Controller
{
    public function index(Request $request)
    {
        $mp = new MP ("2497133636663218", "RPmudXX4mv5A8Jl7QyoRbwyJO36xXKGX");
        $access_token = $mp->get_access_token();

        $data = array('site_id' => 'MLA');

        $preference_data = array(
            "external_reference" => 1,
            "items" => array(
                array(
                    "id" => 1,
                    "title" => "TEST",
                    "category_id" => "Category",
                    "quantity" => 1,
                    "unit_price" => floatval(number_format((float)100, 2, '.', '')),
                    )
                ),
            "auto_return" => "approved",
            "back_urls" => array(
                    "failure" => url("/")."/pago_correcto",
                    "pending" => url("/")."/pago_pendiente",
                    "success" => url("/")."/pago_correcto",
                )
            );

        $preference = $mp->create_preference($preference_data);

        return Redirect($preference['response']['init_point']);

        /*
        $config_mp = ConfiguracionMercadoPago::find(1);
        $plan = Plan::find($id_plan);

        $mp = new MP ($config_mp["CLIENT_ID"], $config_mp["CLIENT_SECRET"]);

        $access_token = $mp->get_access_token();
        $data = array('site_id' => 'MLA');

        $preference_data = array(
            "external_reference" => $id_adquisicion,
            "items" => array(
                array(
                    "id" => $id_adquisicion,
                    "title" => $plan_obj->nombre,
                    "category_id" => "Category",
                    "quantity" => 1,
                    "unit_price" => floatval(number_format((float)$plan->precio, 2, '.', '')),
                    )
                ),
            "auto_return" => "approved",
            "back_urls" => array(
                    "failure" => url("/")."/pago_correcto",
                    "pending" => url("/")."/pago_pendiente",
                    "success" => url("/")."/pago_correcto",
                )
            );

        $preference = $mp->create_preference($preference_data);

        return Redirect($preference['response']['init_point']);
        */
    }

    public function crear_usuarios_test(Request $request)
    {
        /*$mp = new MP("**********", "*********");

        $body = array(
            "site_id" => "MLA"
        );

        $result = $mp->post('/users/test_user', $body);

        var_dump($result);
        */
    }

    /*
    public function pago_correcto(Request $request)
    {
        $config_mp = ConfiguracionMercadoPago::find(1);

        $plan_adquirido = null;
        $viene_por_app = false;

        // fix para app movil

        if($request->input("id_plan_adquirido"))
        {
            $plan_adquirido = PlanAdquirido::where("id",$request->input("id_plan_adquirido"))
            ->where("estado","nuevo")
            ->orderBy("id","desc")
            ->first();
            $viene_por_app= true;
        }
        else{
            $plan_adquirido = PlanAdquirido::where("id_usuario",$request->session()->get("id"))
            ->where("estado","nuevo")->orderBy("id","desc")->first();
        }

        // FIN FIX APP MOVIL

        if($plan_adquirido)
        {
            $plan_adquirido->id_mercado_pago=$request->input("collection_id");

            $plan = Plan::find($plan_adquirido->id_plan);

            $mp = new MP ($config_mp["CLIENT_ID"], $config_mp["CLIENT_SECRET"]);

            $payment_info = $mp->get_payment_info($request->input("collection_id"));

            $status_code = $payment_info["status"];
            $transaction_amount = $payment_info["response"]["collection"]["transaction_amount"];

            $precio_adquisicion = $plan_adquirido->monto;

            $plan_adquirido->save();

            $precio = floatval(number_format((float)$plan->precio, 2, '.', ''));

            if($payment_info["status"] == 200 && $precio_adquisicion == $payment_info["response"]["collection"]["transaction_amount"] )
            {

                if($payment_info["response"]["collection"]["status"] == 'approved')
                {
                   // CAMBIAR ESTADO A ACTIVO
                    $plan_adquirido->estado ="activo";
                    $plan_adquirido->save();

                    // FIX PARA HACER LAS 10 PUBLICACIONES DESTACADAS

                    if($plan_adquirido->id_plan == 3)
                    {
                        for($i=1; $i <= 10;$i++ )
                        {
                            // AQUI
                            $plan_destacada = new PlanAdquirido();
                            $plan_destacada->id_usuario = $plan_adquirido->id_usuario;
                            $plan_destacada->id_plan = $plan_adquirido->id_plan = 2;
                            $plan_destacada->monto = 0;
                            $plan_destacada->estado = "activo";
                            $plan_destacada->save();
                        }

                        $plan_adquirido->delete();
                    }




                    if($viene_por_app)
                    {
                        return redirect("/pago_correcto_app");
                    }
                    else{
                        return redirect("cuenta/publicar_una_propiedad");
                    }
                }
                else if($payment_info["response"]["collection"]["status"] == 'rejected' || $payment_info["response"]["collection"]["status"] == "cancelled")
                {
                    $request->session()->flash("errors",array("El pago ha sido rechazado, puede intentarlo de nuevo si lo desea."));

                    $plan_adquirido->estado ="no activo";
                    $plan_adquirido->save();

                    return redirect("seleccionar_plan_publicacion");
                }
            }
        }
    }

    public function pago_pendiente(Request $request)
    {
        $id_pago = $request->get("collection_id");

        $config_mp = ConfiguracionMercadoPago::find(1);

        $mp = new MP ($config_mp["CLIENT_ID"], $config_mp["CLIENT_SECRET"]);

        $payment_info = $mp->get_payment_info($id_pago);

        $external_reference = $payment_info["response"]["collection"]["external_reference"];

         $chat_mensajes = $this->get_mensajes($request);


        // SI ES UN PAGO COMUN
        if(strrpos($external_reference, "pago_destacar") === FALSE)
        {
            $id_plan_adquirido = $external_reference;

            $plan_adquirido = PlanAdquirido::where("id",$id_plan_adquirido)->first();

            if($plan_adquirido && $plan_adquirido->estado == "nuevo")
            {
                $plan_adquirido->estado = "pago_pendiente";
                $plan_adquirido->id_mercado_pago = $id_pago;
                $plan_adquirido->save();

                return View("frontend.pago_pendiente")->with("chat_mensajes",$chat_mensajes);
            }
            else
            {
                redirect("Web/index");
            }
        }
        // SINO ES UN PAGO COMUN, OSEA ES UN "DESTACAR PUBLICACION"
        else
        {
            $id_pago_destacar = str_replace("pago_destacar", "", $external_reference);

            $pago_destacar_obj = PagoDestacar::where("id",$id)->first();

            if($pago_destacar_obj && $pago_destacar_obj->estado == "nuevo")
            {
                $pago_destacar_obj->estado ="pago_pendiente";
                $pago_destacar_obj->id_mercado_pago = $id_pago;
                $pago_destacar_obj->save();

                return View("frontend.pago_pendiente")->with("chat_mensajes",$chat_mensajes);;
            }
            else
            {
                redirect("Web/index");
            }
        }
    }
    */
}
