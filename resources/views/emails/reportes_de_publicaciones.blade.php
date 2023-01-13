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
			<p>Se han recibido {{count($email_sender->reportes_publicaciones)}} reportes de publicaciones:</p>
		</td>
	</tr>
</table>

<h2>Reportes de publicaciones:</h2>

@foreach($email_sender->reportes_publicaciones as $reporte_publicacion_obj)

    <table width="100%" style="background-color: #ebeff1;">
        <tr>
            <td colspan="3">
                <p><strong>Publicacion</strong>: {{$reporte_publicacion_obj->get_publicacion->get_url()}}</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p><strong>Titulo</strong>: {{$reporte_publicacion_obj->titulo}}</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p><strong>Descripción</strong>:</p>
                <p>{{$reporte_publicacion_obj->descripcion}}</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p><strong>Usuario</strong>: {{$reporte_publicacion_obj->get_usuario->usuario}}</p>
            </td>
        </tr>
    </table>
    <br><br>

@endforeach

@endsection