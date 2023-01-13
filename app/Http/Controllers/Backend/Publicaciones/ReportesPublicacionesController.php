<?php

namespace App\Http\Controllers\Backend\Publicaciones;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\ABM_Core;

use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use App\ReportePublicacion;

class ReportesPublicacionesController extends ABM_Core
{
	public function __construct()
    {
        $this->link_controlador = url('/backend/publicaciones/reportes').'/';
        $this->carpeta_views = "backend.reportes.";

        $this->entity ="Reporte";
        $this->title_page = "Reportes";

        $this->columns = [
          ["name"=>"Título","reference"=>"reportes_publicaciones.titulo"],
          ["name"=>"Usuario","reference"=>"reportes_publicaciones.id_usuario"],
          ["name"=>"Publicación","reference"=>"reportes_publicaciones.id_publicacion"],
          ["name"=>"Controlado","reference"=>"reportes_publicaciones.controlado"],
          ["name"=>"Enviado","reference"=>"reportes_publicaciones.enviado"],
          ["name"=>"Fecha Hora","reference"=>"reportes_publicaciones.created_at"],
          ["name"=>"Acciones","reference"=>null]
        ];

        $this->is_ajax = true;
        $this->add_active = false;
        $this->edit_active = true;
        $this->delete_active = false;
    }
    
    public function index(Request $request)
    {
        $this->share_parameters();
        return View($this->carpeta_views."browse");
    }

    public function get_listado_dt(Request $request)
    {
        $consulta_orm_principal = DB::table("reportes_publicaciones")
        ->join("usuarios","usuarios.id","=","reportes_publicaciones.id_usuario")
        ->select(
            "reportes_publicaciones.*",
            "usuarios.usuario as usuarios_usuario"
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
               $query->where("reportes_publicaciones.nombre","like","%".$search['value']."%")
               ->orWhere("reportes_publicaciones.id","like","%".$search['value']."%");
           });
        }

        $totalFiltered=$consulta_orm_principal->count();
        $consulta_orm_principal = $consulta_orm_principal->take($length)->skip($start);

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

            $row_of_data[]=strip_tags($result_row->titulo);
            $row_of_data[]="<a href='".url('/backend/usuarios_frontend/editar/'.$result_row->id_usuario)."'>".strip_tags($result_row->usuarios_usuario)."</a>";
            
            $row_of_data[]="<a href='".url('backend/publicaciones/editar/'.$result_row->id_publicacion)."'>#".strip_tags($result_row->id_publicacion)."</a>";

            if($result_row->controlado == true){
            	$row_of_data[]='<span class="badge text-white" style="background-color: #28a745">Si</span>';
            }else{
            	$row_of_data[]='<span class="badge text-white" style="background-color: #dc3545">No</span>';
            }

            if($result_row->enviado == true){
            	$row_of_data[]='<span class="badge text-white" style="background-color: #28a745">Si</span>';
            }else{
            	$row_of_data[]='<span class="badge text-white" style="background-color: #dc3545">No</span>';
            }

            $fecha_hora = \DateTime::createFromFormat("Y-m-d H:i:s",$result_row->created_at);
            $fecha_hora = $fecha_hora->format("d/m/Y H:i");

            $row_of_data[]=strip_tags($fecha_hora);

            $buttons_actions = "<div class='form-button-action'>";

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

    public function get(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");

        $row_obj = ReportePublicacion::find($id);
        
        if($row_obj)
        {
            // agregado a respuesta json
            $row_obj->get_usuario;

            $response_estructure->set_response(true);
            $response_estructure->set_data($row_obj);
        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error($this->text_no_search);
        }
        

        return response()->json($response_estructure->get_response_array());
    }

    public function update(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");

        $row_obj = ReportePublicacion::find($id);
        
        if($row_obj)
        {
            $controlado = $request->input("controlado");

            $input= [
                "controlado"=>$controlado,
            ];

            $rules = [
                "controlado"=>"required" 
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

                $row_obj->controlado = $controlado;
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

        $row_obj = Categoria::find($id);
        
        if($row_obj)
        {
            $imagen = $row_obj->imagen;

            $row_obj->delete();

            if ($imagen != "default.jpg" && Storage::exists("public/imagenes/categorias/".$imagen)) {
                Storage::delete("public/imagenes/categorias/".$imagen);
            }
            
            $response_estructure->set_response(true);
        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error($this->text_no_search);
        }


        return response()->json($response_estructure->get_response_array());
    }

}
