@extends('emails.template.master')

@section('title', 'Nueva pregunta en tu publicación')

@section('contenido')
<table width="100%"  align="center">
	<tr>
		<td colspan="3" align="center">
			<h2 style="color: #37436c">{{$email_sender->asunto}}:</h2>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<p>Hola <b>{{ $email_sender->apellido." ".$email_sender->nombre }}</b>, haz recibido una nueva pregunta en {{Config("app.name")}}:</p>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<p style="font-size: 17px;">{{$email_sender->publicacion_obj->titulo}}</p>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<p style="font-size: 17px;"><img src="{{ asset('/storage/imagenes/publicaciones/'.$email_sender->publicacion_obj->imagen_principal) }}" width="200"></p>
		</td>
    </tr>
    <tr>
		<td colspan="3" align="center">
			<p style="font-size: 17px;">Pregunta: {{$email_sender->pregunta}}</p>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<a href="{{$email_sender->publicacion_obj->get_url()}}" class="btn btn-primary" style="color: #fff">Ir a la publicación</a>
		</td>
	</tr>
</table>
@endsection