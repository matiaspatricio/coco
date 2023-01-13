@extends('frontend.template.master')

@section('title', 'Iniciar Sesion')


@section('contenido')

<div class="ps-page--my-account">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Inicio</a></li>
            <li>Ingresar</li>
            </ul>
        </div>
    </div>
    <div class="ps-my-account">
        <div class="container">
            <form class="ps-form--account ps-tab-root" action="#" method="post" id="formulario_ingreso">
                <ul class="ps-tab-list">
                    <li class="active"><a href="#ingresar_step">Ingresar</a></li>
                </ul>
                <div class="ps-tabs">
                    <div class="ps-tab active" id="ingresar_step">
                        <div class="ps-form__content">
                            <h5>Ingresá en tu cuenta</h5>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Usuario o correo" name="correo">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Contraseña" name="password">
                            </div>
                            <div class="form-group submtit">
                                <button class="ps-btn ps-btn--fullwidth">Ingresar</button>
                            </div>

                            <div class="form-group" style="padding-bottom: 30px;text-align:center">    
                                <p><a href="{{url('/olvide_mis_datos')}}">No recuerdo mis datos de ingreso</a></p>
                                <p><a href="{{url('/enviar_correo_activacion')}}">Reenviar Correo de activación</a></p>
                                <p><a href="{{url('/registrarse')}}">Registrarse</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="clearfix"></div>
<br>

    
@endsection

@section("js_code")
<script>
    $("#formulario_ingreso").submit(function(){

        var correo = $("#formulario_ingreso [name=correo]").val();
        var password = $("#formulario_ingreso [name=password]").val();

        $.ajax({
            url: "{{url('/ingresar_post')}}",
            type: "POST",
            data: {
                correo:correo,
                password:password
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
                        location.href="{{url('/')}}";
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

