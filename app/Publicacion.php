<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSender;

class Publicacion extends Model
{
    public $table = "publicaciones";

    public function get_categoria()
    {
        return $this->hasOne("App\Categoria","id","id_categoria");
    }

    public function get_subcategoria()
    {
        return $this->hasOne("App\Subcategoria","id","id_subcategoria");
    }

    public function get_usuario()
    {
        return $this->hasOne("App\Usuario","id","id_usuario");
    }

    public function get_url()
    {
        return url('/publicaciones/ver/'.urlencode($this->titulo).'/'.$this->id);
    }

    public function get_cantidad_preguntas()
    {
        if($this->id_usuario == session("id"))
        {
            return \App\PreguntaPublicacion::where("id_publicacion",$this->id)->count();
        }
        else
        {
            return \App\PreguntaPublicacion::where("id_publicacion",$this->id)->whereNotNull("respuesta")->count();
        }
    }

    public static function get_ultimas_publicaciones()
    {
        return Publicacion::where("id_estado_publicacion",2)->orderBy("id","desc")->take(10)->get();
    }

    public static function get_publicaciones_mas_visitadas()
    {
        return Publicacion::where("id_estado_publicacion",2)->orderBy("visitas","desc")->take(10)->get();
    }

    public function get_listado_tipos_publicaciones()
    {
        return ['Bienes', 'Servicios'];
    }

    public function get_imagenes()
    {
      return $this->hasMany("App\ImagenPublicacion","id_publicacion","id");
    }

    public function get_colores_publicacion()
    {
        return $this->hasMany("App\ColorPublicacion","id_publicacion","id");
    }

    public function get_metodos_de_pago()
    {
      return $this->hasMany("App\MedioDePagoPublicacion","id_publicacion","id");
    }

    public function get_tipo_exposicion()
    {
      return $this->hasOne("App\TipoExposicion","id","id_tipo_exposicion");
    }

    public function get_tipo_exposicion_a_poner()
    {
      return $this->hasOne("App\TipoExposicion","id","id_tipo_exposicion_a_poner");
    }

    public function enviarCorreoEstadoPago()
    {
        $asunto = "";


        if($this->estado_pago_exposicion == "pagado")
        {
            $asunto ="Pago correcto!";
        }

        if($this->estado_pago_exposicion == "rechazado")
        {
            $asunto ="Pago rechazado!";
        }

        if($this->estado_pago_exposicion == "pendiente")
        {
            $asunto ="Pago pendiente!";
        }

    	$email_sender = new \stdClass();
        $email_sender->asunto = $asunto;
        $email_sender->url = $this->get_url();
        $email_sender->imagen = "";
        $email_sender->estado_pago_exposicion = $this->estado_pago_exposicion;
        $email_sender->id_publicacion = $this->id;

        $imagenes = $this->get_imagenes;

        if(count($imagenes))
        {
            $email_sender->imagen = $imagenes[0]->file_name;
        }

        $email_sender->titulo = $this->titulo;

        $usuario_row = $this->get_usuario;

        if($usuario_row)
        {
            Mail::to($usuario_row->correo)->send(new EmailSender($email_sender,$email_sender->asunto,"emails.cambio_estado_pago_publicacion"));
        }
    }
}
