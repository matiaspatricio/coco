@extends('emails.template.master')

@section('title', $email_sender->asunto)

@section('contenido')
<table width="100%"  align="center">
	<tr>
		<td colspan="3" align="center">
			<h2 style="color: #37436c">{{$email_sender->asunto}}:</h2>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<p>Hola <b>{{ $email_sender->apellido." ".$email_sender->nombre }}</b>, hemos recibido una solcitud de reestablecimiento de tu contraseña, creamos una nueva contraseña, a continuación te dejamos los datos de acceso, no te olvides que puedes cambiarla ingresando al sistema:</p>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<p style="font-size: 17px;"><b>Correo:</b> {{$email_sender->correo}}</p>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<p style="font-size: 17px;"><b>Usuario:</b> {{$email_sender->usuario}}</p>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<p style="font-size: 17px;"><b>Contraseña:</b> {{$email_sender->password}}</p>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<a href="{{$email_sender->url_inicio_sesion}}" class="btn btn-primary" style="color: #fff">INICIAR SESIÓN</a>
		</td>
	</tr>
</table>
@endsection