@extends('backend.template.master')

@section('title', $title_page)

@section("style")
<!-- CSS SUMMERNOTE -->
<link rel="stylesheet" href="{{ asset('/admin/assets/js/plugin/summernote/dist/summernote.css') }}">
<link rel="stylesheet" href="{{ asset('/admin/assets/js/plugin/summernote/dist/summernote-bs4') }}">
@endsection

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

                            <form action="#" id="formulario_editar" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-md-12">
                                        <label for="asunto">Asunto: <span class="text-danger">*</span></label>
                                        <input type="text" id="asunto" name="asunto" class="form-control" value="{{$row_obj->asunto}}">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="mensaje">Mensaje: <span class="text-danger">*</span></label>
                                        <div id="mensaje">{!!$row_obj->mensaje!!}</div>
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

                            <div id="dropzone_images_summer" style="display:none"></div>
                            
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

<script src="{{asset('/admin/assets/js/plugin/summernote/dist/summernote-bs4.min.js')}}"></script>

<script src="{{asset('/admin/assets/js/plugin/dropzone/dropzone.js')}}"></script>

<script type="text/javascript">

var dropzone_images_summer = null;

$(document).ready(function(){

    $('#mensaje').summernote(
        { 
            height: 400,
            callbacks: {
                onImageUpload: function(files) {
                    
                    for(var i=0; i < files.length;i++)
                    {
                        dropzone_images_summer.addFile(files[i]);
                    }
                    
                }
            }
        }
    );

    $("#dropzone_images_summer").dropzone({
        autoProcessQueue: true,
        url: "{{url('/backend/upload_image_galery')}}",
        acceptedFiles: 'image/*',
        paramName: "file",
        uploadMultiple: false,
        chunking: true,
        chunkSize: 1000000,
        addRemoveLinks: true,
        dictRemoveFile : "Eliminar",

        init: function() {

            dropzone_images_summer = this;

            this.on("sending", function(file, xhr, formData) {
            abrir_loading();

            try{
                xhr.onreadystatechange = function() {

                    if (xhr.readyState == XMLHttpRequest.DONE) {

                        var respuesta = JSON.parse(xhr.responseText);

                        if(respuesta["done"] == undefined)
                        {
                            var file_name =  respuesta["name"];

                            $('#mensaje').summernote('insertImage', "{{asset('/storage/uploads')}}/"+respuesta["fecha"]+"/"+file_name, file_name);

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

$("#formulario_editar").submit(function(){

    var formdata = new FormData();

    formdata.append("id",{{$row_obj->id}});
    formdata.append("asunto",$("#formulario_editar [name=asunto]").val());
    formdata.append("mensaje",$('#mensaje').summernote('code'));
    
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
                mostrar_mensajes_success(
                    "{{$abm_messages['success_edit']['title']}}",
                    "{{$abm_messages['success_edit']['description']}}",
                    "{{$link_controlador}}"
                );
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