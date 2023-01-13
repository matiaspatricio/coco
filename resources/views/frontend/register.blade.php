@extends('frontend.template.master')

@section('title', 'Registrarse')


@section('contenido')

<div class="ps-page--my-account">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Inicio</a></li>
            <li>Registrarse</li>
            </ul>
        </div>
    </div>
    <div class="ps-my-account">
        <div class="container">
            <form class="ps-form--account ps-tab-root" action="#" method="post" id="formulario_registro">
                <ul class="ps-tab-list">
                    <li class="active"><a href="#ingresar_step">Registrarse</a></li>
                </ul>
                <div class="ps-tabs">
                    <div class="ps-tab active" id="ingresar_step">
                    <div class="ps-form__content">
                        <h5>Creá una cuenta</h5>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Nombre" name="nombre">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Apellido" name="apellido">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Correo" name="correo">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Usuario" name="usuario">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Contraseña" name="password">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="id_provincia" onchange="cambio_provincia()">
                                        <option value="">Provincia</option>
                                        @foreach($provincias as $provincia_row)
                                        <option value="{{$provincia_row->id}}">{{$provincia_row->provincia}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="id_localidad" disabled>
                                        <option value="">Localidad</option>
                                        <option value="">Entre Ríos</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Código postal" name="codigo_postal">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Dirección" name="direccion">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Teléfono" name="telefono">
                                </div>
                            </div>
                        </div>

                        
                        <div class="form-group submtit">
                        <button class="ps-btn ps-btn--fullwidth">Registrarse</button>
                        </div>

                        <div class="form-group" style="padding-bottom: 30px;text-align:center">   
                            <p><a href="{{url('/ingresar')}}">Ingresar</a></p> 
                            <p><a href="{{url('/olvide_mis_datos')}}">No recuerdo mis datos de ingreso</a></p>
                            <p><a href="{{url('/enviar_correo_activacion')}}">Reenviar Correo de activación</a></p>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<br>

    
@endsection

@section("js_code")
<script>
    $("#formulario_registro").submit(function(){

        var nombre = $("#formulario_registro [name=nombre]").val();
        var apellido = $("#formulario_registro [name=apellido]").val();
        var correo = $("#formulario_registro [name=correo]").val();
        var usuario = $("#formulario_registro [name=usuario]").val();
        var password = $("#formulario_registro [name=password]").val();
        var id_provincia = $("#formulario_registro [name=id_provincia]").val();
        var id_localidad = $("#formulario_registro [name=id_localidad]").val();

        var codigo_postal = $("#formulario_registro [name=codigo_postal]").val();
        var direccion = $("#formulario_registro [name=direccion]").val();
        var telefono = $("#formulario_registro [name=telefono]").val();

        $.ajax({
            url: "{{url('/registrarse_post')}}",
            type: "POST",
            data: {
                nombre:nombre,
                apellido:apellido,
                correo:correo,
                usuario:usuario,
                password:password,
                id_provincia:id_provincia,
                id_localidad:id_localidad,
                codigo_postal:codigo_postal,
                direccion:direccion,
                telefono:telefono
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
                        mostrar_mensajes_success("Registrado!","Se ha registrado correctamente, <b>le enviamos un mail para activar su cuenta</b>","{{url('/')}}");
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
                cerrar_loading();
                mostrar_mensajes_errores();
            }
        });

        return false;
    });

    function cambio_provincia()
    {
        var id_provincia = parseInt($("#formulario_registro [name=id_provincia]").val());

        if(!isNaN(id_provincia) && id_provincia > 0 && id_provincia != "")
        {
            $.ajax({
                url: "{{url('/get_localidades_provincia')}}",
                type: "POST",
                data: {
                    id_provincia:id_provincia
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
                            $("#formulario_registro [name=id_localidad]").html('<option value="">Localidad</option>');

                            for(var i=0; i < data["data"]["localidades"].length;i++)
                            {
                                $("#formulario_registro [name=id_localidad]").append('<option value="'+data["data"]["localidades"][i]["id"]+'">'+data["data"]["localidades"][i]["localidad"]+'</option>');
                            }

                            $("#formulario_registro [name=id_localidad]").val("");
                            $("#formulario_registro [name=id_localidad]").attr("disabled",false);
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
                    cerrar_loading();
                    mostrar_mensajes_errores();
                }
            });
        }
        else
        {
            $("#formulario_registro [name=id_localidad]").html('<option value="">Localidad</option>');
            $("#formulario_registro [name=id_localidad]").val("");
            $("#formulario_registro [name=id_localidad]").attr("disabled",true);
        }
    }
</script>
@endsection

