@extends('frontend.template.master')

@section('title', 'Mi Cuenta')

@section('contenido')

<div class="ps-page--my-account mb-3">
    <div class="ps-breadcrumb">
        <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Inicio</a></li>
            <li>Mi Cuenta</li>
        </ul>
        </div>
    </div>
    
    <div class="ps-my-account">
        <div class="container">
            
            <form action="" id="formulario_mi_cuenta">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">Mi Cuenta</h2>
                        <div class="card">
                            <div class="card-body">
                                
                                <div class="row">
                                    <div class="col-md-2" style="text-align: center;">
                                        <label>Imagen de Perfil</label>
                                        <div  style="text-align: center">
                                            <img id="preview_imagen_perfil" src="{{asset('storage/imagenes/usuarios/'.session('foto_perfil'))}}" class="img-fluid avatar-img" style="margin: 0 auto !important;">
                                        </div>
                                        <div  class="mt-1">
                                            <button type="button" class="btn btn-lg btn-primary" onclick="$('#cambiar_imagen_perfil').click()">
                                                <i class="fa fa-camera"></i> Seleccionar
                                            </button>
                                        </div>
                                        <input type="hidden" name="foto_perfil" id="foto_perfil" value="{{$row_obj->foto_perfil}}">
                                        <div id="cambiar_imagen_perfil" style="display: none"></div>
                                    </div>

                                    <div class="col-md-10">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="correo">Correo <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="correo" name="correo" value="{{$row_obj->correo}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="usuario">Usuario <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="usuario" name="usuario" value="{{$row_obj->usuario}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="nombre">Nombre <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$row_obj->nombre}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="apellido">Apellido <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="apellido" name="apellido" value="{{$row_obj->apellido}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="id_provincia">Provincia <span class="text-danger">*</span></label>
                                                <select class="form-control" id="id_provincia" name="id_provincia" onchange="cambio_provincia()">
                                                    @foreach($provincias as $provincia_obj)
                                                    <option value="{{$provincia_obj->id}}">{{$provincia_obj->provincia}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="id_localidad">Localidad <span class="text-danger">*</span></label>
                                                <select class="form-control" id="id_localidad" name="id_localidad">
                                                    @foreach($localidades as $localidad_obj)
                                                        <option value="{{$localidad_obj->id}}">{{$localidad_obj->localidad}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="codigo_postal">Código postal <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="{{$row_obj->codigo_postal}}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="direccion">Dirección <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="direccion" name="direccion" value="{{$row_obj->direccion}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="telefono">Teléfono <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="telefono" name="telefono" value="{{$row_obj->telefono}}">
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <h4>Cambiar Contraseña</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <label id="new_password">Nueva contraseña</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password">
                                    </div>
                                    <div class="col-md-4">
                                        <label id="new_password2">Repetir nueva contraseña</label>
                                        <input type="password" class="form-control" id="new_password2" name="new_password2">
                                    </div>
                                </div>


                                <div class="row mt-5">
                                    <div class="col-md-12" style="text-align: center;">
                                        <button class="btn btn-lg btn-primary">
                                            <i class="fa fa-save"></i> Guardar Cambios
                                        </button>
                                    </div>
                                </div>
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

<script src="{{asset('/assets/plugins/dropzone/dropzone.js')}}"></script>
<script src="{{asset('/assets/plugins/dropzone/dropzone.js')}}"></script>

<script>
    
$(document).ready(function(){
    $("#id_provincia").val({{$row_obj->id_provincia}});
    $("#id_localidad").val({{$row_obj->id_localidad}});
});

$("#cambiar_imagen_perfil").dropzone({
    autoProcessQueue: true,
    url: "{{url('/upload_foto_perfil')}}",
    acceptedFiles: 'image/*',
    paramName: "file",
    uploadMultiple: false,
    chunking: true,
    chunkSize: 1000000,
    addRemoveLinks: true,
    dictRemoveFile : "Eliminar",

    init: function() {

        this.on("sending", function(file, xhr, formData) {
        abrir_loading();

        try{
            xhr.onreadystatechange = function() {

                if (xhr.readyState == XMLHttpRequest.DONE) {

                    var respuesta = JSON.parse(xhr.responseText);

                    if(respuesta["done"] == undefined)
                    {
                        var file_name =  respuesta["name"];

                        $("#preview_imagen_perfil").attr("src","{{asset('/storage/imagenes/usuarios')}}/"+file_name);
                        $("#formulario_mi_cuenta [name=foto_perfil]").val(file_name);
                        cerrar_loading();
                    }
                }
            }
        }
        catch(e)
        {

        }
    });

    this.on("dictResponseError",function(error){
        mostrar_mensajes_errores();
    });

    this.on("removedfile", function (file) {
    });

    },
    success: function(file, response){
        cerrar_loading();
    },
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
});

$("#formulario_mi_cuenta").submit(function(){

    var formdata = new FormData();

    formdata.append("correo",$("#formulario_mi_cuenta [name=correo]").val());
    formdata.append("usuario",$("#formulario_mi_cuenta [name=usuario]").val());
    formdata.append("nombre",$("#formulario_mi_cuenta [name=nombre]").val());
    formdata.append("apellido",$("#formulario_mi_cuenta [name=apellido]").val());
    formdata.append("id_pais",$("#formulario_mi_cuenta [name=id_pais]").val());
    formdata.append("id_provincia",$("#formulario_mi_cuenta [name=id_provincia]").val());
    formdata.append("id_localidad",$("#formulario_mi_cuenta [name=id_localidad]").val());
    formdata.append("codigo_postal",$("#formulario_mi_cuenta [name=codigo_postal]").val());
    formdata.append("direccion",$("#formulario_mi_cuenta [name=direccion]").val());
    formdata.append("telefono",$("#formulario_mi_cuenta [name=telefono]").val());

    formdata.append("foto_perfil",$("#formulario_mi_cuenta [name=foto_perfil]").val());

    formdata.append("new_password",$("#formulario_mi_cuenta [name=new_password]").val());
    formdata.append("new_password2",$("#formulario_mi_cuenta [name=new_password2]").val());

    $.ajax({
        url: "{{url('/cuenta/guardar_datos_mi_cuenta')}}",
        type: "POST",
        contentType: false,
        cache: false,
        processData:false,
        data: formdata,
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function(event){
            abrir_loading();
        },
        success: function(data)
        {
            cerrar_loading();

            try{

                if(data["response"])
                {
                    mostrar_mensajes_success("Guardado!","Se han guardado los datos correctamente!","{{url('/cuenta/mi_cuenta')}}");
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
        error: function(error){
            cerrar_loading();
            mostrar_mensajes_errores();
        },
    });

    return false;
});

function cambio_provincia()
{
    var id_provincia = parseInt($("#formulario_mi_cuenta [name=id_provincia]").val());

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
                        if(data["data"]["localidades"].length == 0)
                        {
                            $("#formulario_mi_cuenta [name=id_localidad]").html('<option value="">Localidad</option>');
                        }
                        else
                        {
                            $("#formulario_mi_cuenta [name=id_localidad]").html('');
                        }

                        for(var i=0; i < data["data"]["localidades"].length;i++)
                        {
                            $("#formulario_mi_cuenta [name=id_localidad]").append('<option value="'+data["data"]["localidades"][i]["id"]+'">'+data["data"]["localidades"][i]["localidad"]+'</option>');
                        }

                        if(data["data"]["localidades"].length == 0)
                        {
                            $("#formulario_mi_cuenta [name=id_localidad]").val("");
                        }
                        else
                        {
                            $("#formulario_mi_cuenta [name=id_localidad]").val(data["data"]["localidades"][0]["id"]);
                        }

                        $("#formulario_mi_cuenta [name=id_localidad]").attr("disabled",false);
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
        $("#formulario_mi_cuenta [name=id_localidad]").html('<option value="">Localidad</option>');
        $("#formulario_mi_cuenta [name=id_localidad]").val("");
        $("#formulario_mi_cuenta [name=id_localidad]").attr("disabled",true);
    }
}

</script>

@endsection