@extends('backend.template.master')

@section('title', $title_page)

@section('contenido')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">{{$title_page}}</h4>
            </div>
            
            <div class="row">
                <div class="col-12 mb-2">
                    <a href="{{ $link_controlador }}" class="{{$config_buttons['go_back']['class']}}">
                        <i class="{{$config_buttons['go_back']['icon']}}"></i> {{$config_buttons['go_back']['title']}}
                    </a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            
                        </div>
                        <div class="card-body">

                            <form action="#" id="formulario_agregar" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div  style="text-align: center">
                                            <img id="preview_imagen_perfil" src="{{asset('/storage/imagenes/usuarios/'.$row_obj->foto_perfil)}}" class="img-fluid avatar-img rounded-circle" style="margin: 0 auto !important;">
                                        </div>
                                        <div class="mt-1" style="text-align: center" >
                                            <button type="button" class="btn btn-sm btn-primary" onclick="$('#cambiar_imagen_perfil').click()">
                                                <i class="fa fa-camera"></i> Cambiar
                                            </button>
                                        </div>
                                        <input type="hidden" name="foto_perfil" id="foto_perfil" value="{{$row_obj->foto_perfil}}">
                                        <div id="cambiar_imagen_perfil" style="display: none"></div>
                                    </div>


                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" id="nombre" name="nombre" class="form-control" value="{{$row_obj->nombre}}">
                                            </div>

                                            <div class="col-md-12">
                                                <label for="apellido">Apellido</label>
                                                <input type="text" id="apellido" name="apellido" class="form-control" value="{{$row_obj->apellido}}">
                                            </div>

                                            <div class="col-md-12">
                                                <label for="correo">Correo</label>
                                                <input type="text" id="correo" name="correo" class="form-control" value="{{$row_obj->correo}}">
                                            </div>

                                            <div class="col-md-12">
                                                <label for="usuario">Usuario</label>
                                                <input type="text" id="usuario" name="usuario" class="form-control" value="{{$row_obj->usuario}}">
                                            </div>

                                            <div class="col-md-12">
                                                <label for="password">Estado</label>
                                                <select id="id_estado_usuario" name="id_estado_usuario" class="form-control">
                                                    @foreach($estados_usuarios as $estado_usuario)
                                                    <option value="{{$estado_usuario->id}}">{{$estado_usuario->estado}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="password">Cambiar Contraseña</label>
                                                <input type="password" id="password" name="password" class="form-control">
                                            </div>

                                            <div class="col-md-12">
                                                <label for="password2">Repetir Contraseña</label>
                                                <input type="password" id="password2" name="password2" class="form-control">
                                            </div>

                                            
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12" style="text-align:center;">
                                        <button class="{{$config_buttons['edit']['class']}}">
                                            <i class="{{$config_buttons['edit']['icon']}}"></i> {{$config_buttons['edit']['title']}}
                                        </button>
                                    </div>
                                </div>

                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    
@endsection


@section("modals")
@endsection

@section("js_code")

<script src="{{asset('/admin/assets/js/plugin/dropzone/dropzone.js')}}"></script>

<script type="text/javascript">


$(document).ready(function(){
    $("#id_estado_usuario").val({{$row_obj->id_estado_usuario}});

    $("#cambiar_imagen_perfil").dropzone({
        autoProcessQueue: true,
        url: "{{url('/backend/upload_foto_perfil')}}",
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
                            $("#formulario_agregar [name=foto_perfil]").val(file_name);
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

});

$("#formulario_agregar").submit(function(){

    var formdata = new FormData();

    formdata.append("id",{{$row_obj->id}});
    formdata.append("nombre",$("#formulario_agregar [name=nombre]").val());
    formdata.append("apellido",$("#formulario_agregar [name=apellido]").val());
    formdata.append("correo",$("#formulario_agregar [name=correo]").val());
    formdata.append("usuario",$("#formulario_agregar [name=usuario]").val());
    formdata.append("password",$("#formulario_agregar [name=password]").val());
    formdata.append("foto_perfil",$("#formulario_agregar [name=foto_perfil]").val());
    formdata.append("id_estado_usuario",$("#formulario_agregar [name=id_estado_usuario]").val());
    
    $.ajax({
        url: "{{ $link_controlador }}update",
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

            try
            {
              if(data["response"] == true)
              {
                mostrar_mensajes_success("Editado!","Se ha editado el usuario correctamente","{{$link_controlador}}");
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

</script>

@endsection