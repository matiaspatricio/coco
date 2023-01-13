@extends('frontend.template.master')

@section('title', 'Olvidé mis datos')


@section('contenido')

<div class="ps-page--my-account">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Inicio</a></li>
            <li>Olvidé mis datos</li>
            </ul>
        </div>
    </div>
    <div class="ps-my-account">
        <div class="container">
            <form class="ps-form--account ps-tab-root" action="#" method="post" id="formulario_forgot">
                <ul class="ps-tab-list">
                    <li class="active"><a href="#forgot_step">Olvidé mis datos</a></li>
                </ul>
                <div class="ps-tabs">
                    <div class="ps-tab active" id="forgot_step">
                        <div class="ps-form__content">
                            <h5>Para recuperar tus datos de ingreso a tu cuenta, necesitarás ingresar tu correo, y te enviaremos los datos de ingreso</h5>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Correo" name="correo">
                            </div>
                            <div class="form-group submtit">
                                <button class="ps-btn ps-btn--fullwidth">Enviar Datos</button>
                            </div>
                            <div class="form-group" style="padding-bottom: 30px;text-align:center">    
                                <p><a href="{{url('/ingresar')}}">Ingresar</a></p>  
                                <p><a href="{{url('/registrarse')}}">Registrarse</a></p>
                                <p><a href="{{url('/enviar_correo_activacion')}}">Reenviar Correo de activación</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    
@endsection

@section("js_code")
<script>
    $("#formulario_forgot").submit(function(){

        var correo = $("#formulario_forgot [name=correo]").val();

        $.ajax({
            url: "{{url('/forgot_password')}}",
            type: "POST",
            data: {
                correo:correo,
            },
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            beforeSend: function(e)
            {
                abrir_loading();
            },
            success: function(data)
            {
                cerrar_loading();

                try
                {
                    if(data["response"] == true)
                    {
                        mostrar_mensajes_success("Datos Enviados!","Se han enviado los datos a tu correo","{{url('/ingresar')}}");
                    }
                    else
                    {
                        mostrar_mensajes_errores(data["messages_errors"]);
                    }
                }
                catch(e)
                {
                    mostrar_mensajes_errores();
                }
            },
            error: function(e)
            {
                mostrar_mensajes_errores();
                cerrar_loading();
            }
        });

        return false;
    });
</script>
@endsection

