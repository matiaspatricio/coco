@extends('emails.template.master')

@section('title', 'Bienvenido')

@section('contenido')
<table width="100%"  align="center">
	<tr>
		<td colspan="3" align="center">
			<h2 style="color: #37436c">{{$email_sender->asunto}}:</h2>
		</td>
	</tr>
    
    @if($email_sender->estado_pago_exposicion == "pagado")
    
    <tr>
		<td colspan="3" align="center">
            <p>La publicación ha sido pagada correctamente!</p>
		</td>
	</tr>
    
    @elseif($email_sender->estado_pago_exposicion == "rechazado")

    <tr>
		<td colspan="3" align="center">
            <p>Lo sentimos el pago ha sido rechazado, puede intentar pagar de nuevo si lo desea.</p>
            <br>
            <br>
            <a href="{{url('/mp/pagar/'.$email_sender->id_publicacion)}}" class="btn btn-lg btn-primary">
                Intentar pagar de nuevo
            </a>
		</td>
	</tr>

    @elseif($email_sender->estado_pago_exposicion == "pendiente")

    <tr>
		<td colspan="3" align="center">
			<p>El pago de la publicación está en estado pendiente, le enviaremos un mail cuando el pago haya sido confirmado o rechazado.</p>
		</td>
	</tr>

    @endif
	<tr>
		<td colspan="3" align="center">
            <h3>{{$email_sender->titulo}}</h3>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
            <a href="{{$email_sender->url}}"><img src="{{ asset('/storage/imagenes/publicaciones/'.$email_sender->imagen) }}" alt="" width="200"></a>
		</td>
	</tr>
    <tr>
		<td colspan="3" align="center">
			<a href="{{$email_sender->url}}" class="btn btn-primary" style="color: #fff">VER PUBLICACIÓN</a>
		</td>
	</tr>
</table>
@endsection