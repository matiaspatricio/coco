@extends('emails.template.master')

@section('title', 'Bienvenido')

@section('contenido')
<table width="100%"  align="center">
	<tr>
		<td colspan="3" align="center">
			<h2 style="color: #37436c">{{$email_sender->asunto}}:</h2>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<p>Hola <b>{{ $email_sender->apellido." ".$email_sender->nombre }}</b>, le damos la bienvenida a {{Config("app.name")}}:</p>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<p style="font-size: 17px;">Ahora podrá activar su cuenta a través del siguiente enlace</p>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<a href="{{$email_sender->url_confirmar_correo}}" class="btn btn-primary" style="color: #fff">ACTIVAR CUENTA</a>
		</td>
	</tr>
</table>
@endsection