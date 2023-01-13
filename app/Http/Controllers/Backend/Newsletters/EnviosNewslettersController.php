<?php
namespace App\Http\Controllers\Backend\Newsletters;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\ABM_Core;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSender;

use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;

use App\Newsletter;
use App\EnvioNewsletter;
use App\Configuracion;

class EnviosNewslettersController extends ABM_Core
{
    public function __construct()
    {
        $this->link_controlador = url('/backend/newsletters/envios').'/';
        $this->carpeta_views = "backend.newsletters.envios.";

        $this->entity ="Envío Newsletter";
        $this->title_page = "Envíos Newsletters";

        $this->columns = [
          ["name"=>"Asunto","reference"=>"envios_newsletter.asunto"],
          ["name"=>"Veces enviado","reference"=>"envios_newsletter.cantidad_veces_enviado"],
          ["name"=>"Creación","reference"=>DB::raw("DATE_FORMAT(envios_newsletter.created_at,'%d/%m/%Y %H:%i')")],
          ["name"=>"Acciones","reference"=>null]
        ];

        $this->is_ajax = false;
    }

    public function index(Request $request)
    {
        $this->share_parameters();
        return View($this->carpeta_views."browse");
    }

    public function get_listado_dt(Request $request)
    {
        $consulta_orm_principal = DB::table("envios_newsletter")
        ->select(
            "envios_newsletter.*"
        );

    	$totalData = $consulta_orm_principal->count();

        $totalFiltered = $totalData;

        $search = $request->input("search");
        $start = $request->input('start');
        $length = $request->input('length');
        $order = $request->input('order');

        $resultado = array();

        if(!empty($search['value']))
        {
          $consulta_orm_principal = $consulta_orm_principal
           ->where(function($query) use($search){
               $query->where("envios_newsletter.asunto","like","%".$search['value']."%");
           });
        }

        $consulta_orm_principal = $consulta_orm_principal->take($length)->skip($start);
        $totalFiltered=$consulta_orm_principal->count();

        $columna_a_ordenar = (int)$order[0]["column"];

        if(isset($this->columns[$columna_a_ordenar]) && $this->columns[$columna_a_ordenar]["reference"] != null){
          $resultado = $consulta_orm_principal->orderBy($this->columns[$columna_a_ordenar]["reference"],$order[0]["dir"])->get();
        }
        else{
          $resultado = $consulta_orm_principal->orderBy("id","desc")->get();
        }

        $data= array();

        foreach($resultado as $result_row)
        {
            $row_of_data = array();

            $fecha_creacion = \DateTime::createFromFormat("Y-m-d H:i:s",$result_row->created_at);
            $fecha_creacion = $fecha_creacion->format("d/m/Y H:i");

            $row_of_data[]=strip_tags($result_row->asunto);

            $row_of_data[]=strip_tags($result_row->cantidad_veces_enviado);

            $row_of_data[] = $fecha_creacion;

            $buttons_actions = "<div class='form-button-action'>";

            $buttons_actions .=
            "<button onclick='abrir_modal_enviar(".$result_row->id.")' type='button' data-toggle='tooltip' title='' class='btn-sm btn btn-success btn-round' data-original-title='Enviar'>
                <i class='fa fa-envelope'></i> Enviar
            </button> &nbsp;";

            if($this->edit_active)
            {
                if($this->is_ajax)
                {
                    $buttons_actions .=
                    "<button onclick='abrir_modal_editar(".$result_row->id.")' type='button' data-toggle='tooltip' title='' class='btn-sm ".$this->config_buttons["edit"]["class"]."' data-original-title='".$this->config_buttons["edit"]["title"]."'>
                        <i class='".$this->config_buttons["edit"]["icon"]."'></i>
                    </button>";
                }
                else{
                    $buttons_actions .=
                    "<a href='".$this->link_controlador."editar/".$result_row->id."' data-toggle='tooltip' title='' class='btn-sm ".$this->config_buttons["edit"]["class"]."' data-original-title='".$this->config_buttons["edit"]["title"]."'>
                        <i class='".$this->config_buttons["edit"]["icon"]."'></i>
                    </a>";
                }
            }

            if($this->delete_active)
            {
                $buttons_actions.=
                "<button onclick='eliminar(".$result_row->id.")' type='button' data-toggle='tooltip' title='' class='btn-sm ".$this->config_buttons["delete"]["class"]."' data-original-title='".$this->config_buttons["delete"]["title"]."'>
                    <i class='".$this->config_buttons["delete"]["icon"]."'></i>
                </button>";
            }

            $buttons_actions.="</div>";


            $row_of_data[]=$buttons_actions;

            $data[]=$row_of_data;
        }

		$json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

    	return response()->json($json_data);
    }

    public function nuevo(Request $request)
    {
        $this->title_page = $this->config_buttons["add"]["title"]." ".$this->entity;
        $this->share_parameters();

        return View($this->carpeta_views."add");
    }

    public function editar(Request $request,$id)
    {
        $row_obj = EnvioNewsletter::find($id);

        if($row_obj)
        {
            $this->title_page = $this->config_buttons["edit"]["title"]." ".$this->entity;
            $this->share_parameters();
            
            return View($this->carpeta_views."edit")
            ->with("row_obj",$row_obj);
        }
    }

    public function store(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $asunto = trim($request->input("asunto"));
        $mensaje = trim($request->input("mensaje"));

        $input= [
            "asunto"=>$asunto,
            "mensaje"=>$mensaje,
        ];

        $rules = [
            "asunto"=>"required|min:3",
            "mensaje"=>"required",
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
            $row_obj = new EnvioNewsletter();
            $row_obj->asunto = $asunto;
            $row_obj->mensaje = $mensaje;
            $row_obj->save();

            $response_estructure->set_response(true);
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function update(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");

        $row_obj = EnvioNewsletter::find($id);
        
        if($row_obj)
        {
            $asunto = trim($request->input("asunto"));
            $mensaje = trim($request->input("mensaje"));

            $input= [
                "asunto"=>$asunto,
                "mensaje"=>$mensaje,
            ];

            $rules = [
                "asunto"=>"required|min:3",
                "mensaje"=>"required", 
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
                $response_estructure->set_response(true);

                $row_obj->asunto = $asunto;
                $row_obj->mensaje = $mensaje;
                $row_obj->save();
            }
        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error($this->text_no_search);
        }
        

        return response()->json($response_estructure->get_response_array());
    }

    public function delete(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");

        $row_obj = EnvioNewsletter::find($id);

        if($row_obj)
        {
            $row_obj->delete();
            $response_estructure->set_response(true);
        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error($this->text_no_search);
        }


        return response()->json($response_estructure->get_response_array());
    }

    public function enviar_envio(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");
        $enviar_correos_suscritos = json_decode($request->input("enviar_correos_suscritos"));
        $enviar_correo_prueba = json_decode($request->input("enviar_correo_prueba"));

        $row_obj = EnvioNewsletter::find($id);

        if($row_obj)
        {
            if($enviar_correos_suscritos === true || $enviar_correo_prueba === true)
            {
                $correos_a_enviar = array();

                if($enviar_correos_suscritos === true)
                {
                    $correos_newsletters = DB::table("newsletters")
                    ->select(
                        "newsletters.correo"
                    )
                    ->where("activo",1)
                    ->get();

                    foreach($correos_newsletters as $correo_newsletters)
                    {
                        $correos_a_enviar[] = $correo_newsletters->correo;
                    }
                }

                if($enviar_correo_prueba === true)
                {
                    $configuracion_obj = Configuracion::where("clave","correo_prueba_newsletter")->first();

                    if($configuracion_obj)
                    {
                        $correos_a_enviar[] = $configuracion_obj->valor;
                    }
                }

                if(count($correos_a_enviar) > 0)
                {
                    $email_sender = new \stdClass();
                    $email_sender->asunto = $row_obj->asunto;
                    $email_sender->mensaje = $row_obj->mensaje;

                    Mail::to($correos_a_enviar)->send(
                        new EmailSender($email_sender,$email_sender->asunto,"emails.envio_newsletter"));

                    $cantidad_veces_enviado = $row_obj->cantidad_veces_enviado + 1;
                    $row_obj->cantidad_veces_enviado = $cantidad_veces_enviado;
                    $row_obj->save();
                    
                    $response_estructure->set_response(true);
                }
                else
                {
                    $response_estructure->add_message_error("No se encontraron correos para enviar");
                }
            }
            else
            {
                $response_estructure->add_message_error("Seleccione como mínimo una de las dos opciones");
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
