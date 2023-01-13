@extends('frontend.template.master')

@section('title', 'Reenviar correo de activación')


@section('contenido')

<div class="container-fluid">

    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form action="" id="formulario_reenvio_codigo">
                        <div class="row" style="text-align: center;">
                            <div class="col-md-12">
                                <h4>REENVIAR CORREO DE ACTIVACIÓN</h4>
                                <p>Si no recibió el correo de activación, puede ingresar el correo asociado a su cuenta, y le enviaremos nuevamente el link de activación</p>
                            </div>   
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="correo" value="{{$correo}}">    
                            </div>
                            <div class="col-md-12 mt-2"> 
                                <button class="btn btn-lg btn-primary">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

    
@endsection

@section("js_code")

<script>
    $("#formulario_reenvio_codigo").submit(function(){

        var correo = $("#formulario_reenvio_codigo [name=correo]").val();

        $.ajax({
            url: "{{url('/enviar_correo_activacion_post')}}",
            type: "POST",
            data: {
                correo:correo
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
                        mostrar_mensajes_success("Correo enviado!","Se ha enviado el link de confirmación","{{url('/ingresar')}}");
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

