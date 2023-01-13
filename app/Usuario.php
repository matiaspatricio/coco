<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSender;

class Usuario extends Model {

    public $table = "usuarios";

    protected $hidden = [
        'password'
    ];

    public function get_estado_usuario()
    {
    	return $this->hasOne("App\EstadoUsuario","id","id_estado_usuario");
    }

    public function sendNewPassword()
    {
    	$nueva_password = $this->generate_password();

    	$this->password = bcrypt($nueva_password);
        $email_sender = new \stdClass();
        $email_sender->asunto = "Datos de tu cuenta";
        $email_sender->nombre = $this->nombre;
        $email_sender->apellido = $this->apellido;
        $email_sender->correo = $this->correo;
        $email_sender->usuario = $this->usuario;
        $email_sender->password = $nueva_password;

        $email_sender->url_inicio_sesion = url('/ingresar');

        if($this->id_rol == 1)
        {
            $email_sender->url_inicio_sesion = url('/backend');
        }

        Mail::to($this->correo)->send(new EmailSender($email_sender,$email_sender->asunto,"emails.olvide_mis_datos"));
      	$this->save();
    }

    private function generate_password($length = 8){
		$characters = '012345!6789a"bcdef#ghijk$lmno%pqr&stu/vwxy/zABC(DE)FG%HIJKL!MNO&PQRST=UVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}
