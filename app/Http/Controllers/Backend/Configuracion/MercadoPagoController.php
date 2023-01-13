<?php

namespace App\Http\Controllers\Backend\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\ABM_Core;

use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use App\ConfiguracionMercadoPago;

class MercadoPagoController extends ABM_Core
{
    public function __construct()
    {
        $this->link_controlador = url('/backend/mercadopago').'/';
        $this->carpeta_views = "backend.mercadopago.";

        $this->entity ="MercadoPago";
        $this->title_page = "MercadoPago";

        $this->columns = [];

        $this->is_ajax = true;
    }
    
    public function index(Request $request)
    {
        $this->share_parameters();

        $row_obj = ConfiguracionMercadoPago::first();

        return View($this->carpeta_views."browse")
        ->with("row_obj",$row_obj);
    }

    public function update(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $CLIENT_ID = trim($request->input("CLIENT_ID"));
        $CLIENT_SECRET = trim($request->input("CLIENT_SECRET"));
        $SHORT_NAME = trim($request->input("SHORT_NAME"));

        $row_obj = ConfiguracionMercadoPago::first();
        
        if($row_obj)
        {
            $input= [
                "CLIENT_ID"=>$CLIENT_ID,
                "CLIENT_SECRET"=>$CLIENT_SECRET, 
                "SHORT_NAME"=>$SHORT_NAME,
            ];
    
            $rules = [
                "CLIENT_ID"=>"required",
                "CLIENT_SECRET"=>"required",
                "SHORT_NAME"=>"required",
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
                $row_obj->CLIENT_ID = $CLIENT_ID;
                $row_obj->CLIENT_SECRET = $CLIENT_SECRET; 
                $row_obj->SHORT_NAME = $SHORT_NAME;
                $row_obj->save();

                $response_estructure->set_response(true);
            }
        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error($this->text_no_search);
        }
        

        return response()->json($response_estructure->get_response_array());
    }
}
