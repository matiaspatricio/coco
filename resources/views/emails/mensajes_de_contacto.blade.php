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
			<p>Se han recibido {{count($email_sender->mensajes_contacto)}} mensajes de contacto:</p>
		</td>
	</tr>
</table>

<h2>Mensajes de Contacto:</h2>

@foreach($email_sender->mensajes_contacto as $mensaje_contacto_obj)

    <table width="100%" style="background-color: #ebeff1;">
        <tr>
            <td colspan="3">
                <p><strong>Nombre y apellido</strong>: {{$mensaje_contacto_obj->nombre}} {{$mensaje_contacto_obj->apellido}}</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p><strong>Correo</strong>: {{$mensaje_contacto_obj->correo}}</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p><strong>Mensaje</strong>:</p>
                <p>{{$mensaje_contacto_obj->mensaje}}</p>
            </td>
        </tr>
    </table>
    <br><br>

@endforeach

@endsection