<?php

namespace App\Http\Controllers\Cron;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSender;

use App\Configuracion;
use App\MensajeContacto;
use App\ReportePublicacion;

class CronController extends Controller
{
    /**
    * RECOPILA LOS MENSAJES DE CONTACTO
    * LOS ENVIA AL CORREO CONFIGURADO
    * Y SETEA COMO ENVIADO LOS MENSAJES
    * EJECUTAR CADA 5 MIN APROX.
    */

    public function envio_mensajes_contacto(Request $request)
    {
        $configuracion_obj = Configuracion::where("clave","correo_recibe_contacto")->first();

        $mensajes_contacto = MensajeContacto::where("enviado",0)->get();

        if(count($mensajes_contacto) && $configuracion_obj && filter_var($configuracion_obj->valor, FILTER_VALIDATE_EMAIL))
        {
            $email_sender = new \stdClass();
            $email_sender->asunto = "Mensajes de Contacto";
            $email_sender->mensajes_contacto = $mensajes_contacto;
            
            $response = Mail::to($configuracion_obj->valor)
            ->send(
                new EmailSender(
                    $email_sender,
                    $email_sender->asunto,"emails.mensajes_de_contacto"
                )
            );

           DB::statement("update mensajes_contacto set enviado = 1");
        }
        
    }

    /*
    * RECOPILA LOS REPORTES DE PUBLICACIONES
    * LOS ENVIA AL CORREO CONFIGURADO
    * Y SETEA COMO ENVIADO LOS MENSAJES
    * EJECUTAR CADA 5 MIN APROX.
    */

    public function envio_mensajes_reportes(Request $request)
    {
        $configuracion_obj = Configuracion::where("clave","correo_recibe_reporte")->first();

        $reportes_publicaciones = ReportePublicacion::where("enviado",0)->get();

        if(count($reportes_publicaciones) && $configuracion_obj && filter_var($configuracion_obj->valor, FILTER_VALIDATE_EMAIL))
        {
            $email_sender = new \stdClass();
            $email_sender->asunto = "Reportes de publicaciones";
            $email_sender->reportes_publicaciones = $reportes_publicaciones;
            
            $response = Mail::to($configuracion_obj->valor)
            ->send(
                new EmailSender(
                    $email_sender,
                    $email_sender->asunto,"emails.reportes_de_publicaciones"
                )
            );

           DB::statement("update reportes_publicaciones set enviado = 1");
        }
    }

    // FINALIZA LAS PUBLICACIONES QUE ESTAN VENCIDDAS
    // EJECUTAR CADA 24 HS
    
    public function finalizar_publicaciones_vencidas(Request $request)
    {
        DB::statement("update publicaciones set id_estado_publicacion = 4 where fecha_vencimiento = ?",Date("Y-m-d"));
    }
}
