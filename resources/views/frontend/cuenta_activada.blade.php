@extends('frontend.template.master')

@section('title', 'Cuenta Activada')


@section('contenido')

<div class="container-fluid">

    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-4" style="text-align:center;">
            
            <div class="card">
                <div class="card-body">
                    @if($respuesta)
                        <h3>CORREO CONFIRMADO</h3>
                        <p><strong>Felicidades!</strong> su correo ha sido confirmado, ahora podrá utilizar su cuenta de {{Config("app.name")}} </p>
                    @else
                        <h3>CORREO CONFIRMADO</h3>
                        <p>Su correo no ha podido ser confirmado</p>
                    @endif

                    <p>Lo <strong>redireccionaremos</strong> al inicio en 8 segundos</p>
                </div>
            </div>

        </div>
    </div>
</div>

    
@endsection

@section("js_code")

<script>
$(document).ready(function(){

    setTimeout(() => {
        location.href="{{url('/')}}";
    }, 8000);

});
</script>

@endsection

