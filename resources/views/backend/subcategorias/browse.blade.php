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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            @if($add_active === true)
                            <div class="d-flex align-items-center">
                                @if($is_ajax == true)
                                <button class='{{$config_buttons["add"]["class"]}}' onClick="abrir_modal_agregar()">
                                    <i class='{{$config_buttons["add"]["icon"]}}'></i>
                                    {{$config_buttons["add"]["title"]}} {{$entity}}
                                </button>
                                @else
                                <a href="{{$link_controlador.'nuevo'}}" class='{{$config_buttons["add"]["class"]}}'>
                                    <i class='{{$config_buttons["add"]["icon"]}}'></i>
                                    {{$config_buttons["add"]["title"]}} {{$entity}}
                                </a>
                                @endif
                            </div>
                            @endif
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="tabla_listado" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            @foreach($columns as $column)
                                            <th>{{$column["name"]}}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection

@section("modals")

    @component('backend.template.modal_agregar')
        @slot('entidad')
            Subcategor??a
        @endslot

        @slot('inputs')
            <div class="col-md-12">
                <label for="nombre_agregar">Nombre</label>
                <input type="text" class="form-control" id="nombre_agregar" name="nombre">
            </div>
            <div class="col-md-12">
                <label for="">Imagen</label>
                <div style="text-align: center;">
                    <img id="preview_imagen_agregar" src="{{ asset('/storage/imagenes/categorias/default.jpg') }}" class="img-fluid" style="width: 300px;margin: 0 auto !important;">
                </div>
                <div class="mt-1" style="text-align: center" >
                    <button type="button" class="btn btn-sm btn-primary" onclick="$('#cambiar_imagen_agregar').click()">
                        <i class="fa fa-camera"></i> Cambiar
                    </button>
                </div>
                <input type="hidden" name="imagen" id="imagen_agregar" value="default.jpg">
                <div id="cambiar_imagen_agregar" style="display: none"></div>
            </div>
            <div class="col-md-12">
                <label for="mostrar_en_menu_agregar">Mostrar en men??</label>
                <select id="mostrar_en_menu_agregar" name="mostrar_en_menu" class="form-control">
                    <option value="">Seleccionar</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="activa_agregar">Activa</label>
                <select id="activa_agregar" name="activa" class="form-control">
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </div>
        @endslot
    @endcomponent

    @component('backend.template.modal_editar')
        @slot('entidad')
            Subcategor??a
        @endslot

        @slot('inputs')
            <div class="col-md-12">
                <label for="nombre_editar">Nombre</label>
                <input type="text" class="form-control" id="nombre_editar" name="nombre">
            </div>
            <div class="col-md-12">
                <label for="">Imagen</label>
                <div style="text-align: center;">
                    <img id="preview_imagen_editar" src="{{ asset('/storage/imagenes/categorias/default.jpg') }}" class="img-fluid" style="width: 300px;margin: 0 auto !important;">
                </div>
                <div class="mt-1" style="text-align: center" >
                    <button type="button" class="btn btn-sm btn-primary" onclick="$('#cambiar_imagen_editar').click()">
                        <i class="fa fa-camera"></i> Cambiar
                    </button>
                </div>
                <input type="hidden" name="imagen" id="imagen_editar" value="default.jpg">
                <div id="cambiar_imagen_editar" style="display: none"></div>
            </div>
            <div class="col-md-12">
                <label for="mostrar_en_menu_editar">Mostrar en men??</label>
                <select id="mostrar_en_menu_editar" name="mostrar_en_menu" class="form-control">
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="activa_editar">Activa</label>
                <select id="activa_editar" name="activa" class="form-control">
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </div>
        @endslot
    @endcomponent

@endsection

@section("js_code")

<script src="{{asset('/admin/assets/js/plugin/dropzone/dropzone.js')}}"></script>
<script type="text/javascript">

var listado = null;
var id_trabajando = 0;

$(document).ready( function () {

    listado= $('#tabla_listado').DataTable( {
        "processing": true,
        "serverSide": true,
        "responsive":true,
        "ajax":{
        data: {id_categoria:{{$id_categoria}}},
        url : "{{$link_controlador}}get_listado_dt", // json datasource
        type: "post",
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function(error){
            $(".employee-grid-error").html("");
            $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No hay datos</th></tr></tbody>');
            $("#employee-grid_processing").css("display","none");
        }
        }
    });

    $("#cambiar_imagen_agregar").dropzone({
        autoProcessQueue: true,
        url: "{{url('/backend/upload_imagen_subcategoria')}}",
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

                            $("#preview_imagen_agregar").attr("src","{{asset('/storage/imagenes/subcategorias')}}/"+file_name);
                            $("#formulario_agregar [name=imagen]").val(file_name);
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

    $("#cambiar_imagen_editar").dropzone({
        autoProcessQueue: true,
        url: "{{url('/backend/upload_imagen_subcategoria')}}",
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

                            $("#preview_imagen_editar").attr("src","{{asset('/storage/imagenes/subcategorias')}}/"+file_name);
                            $("#formulario_editar [name=imagen]").val(file_name);
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

function abrir_modal_agregar()
{
    $("#formulario_agregar input[type=text]").val("");
    $("#formulario_agregar input[type=hidden]").val("");
    $("#formulario_agregar textarea").val("");
    $("#formulario_agregar select").val(0).trigger("change");

    $("#imagen_agregar").val("default.jpg");
    $("#preview_imagen_agregar").attr("src","{{ asset('/storage/imagenes/subcategorias/default.jpg') }}");
    $("#activa_agregar").val(1);
    $("#mostrar_en_menu_agregar").val("");

    $("#modal_agregar").modal("show");
}

function agregar()
{
    var formdata = new FormData();

    formdata.append("nombre",$("#formulario_agregar [name=nombre]").val());
    formdata.append("imagen",$("#formulario_agregar [name=imagen]").val());
    formdata.append("mostrar_en_menu",$("#formulario_agregar [name=mostrar_en_menu]").val());
    formdata.append("activa",$("#formulario_agregar [name=activa]").val());
    formdata.append("id_categoria",{{$id_categoria}});

    $.ajax({
        url: "{{$link_controlador}}store",
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
                $("#modal_agregar").modal("hide");

                mostrar_mensajes_success(
                    "{{$abm_messages['success_add']['title']}}",
                    "{{$abm_messages['success_add']['description']}}"
                );

                listado.draw();
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
}

function abrir_modal_editar(id)
{
    $.ajax({
        url: "{{$link_controlador}}get",
        type: "POST",
        data: {id:id},
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
                id_trabajando = id;
                $("#nombre_editar").val(data["data"]["nombre"]);
                $("#imagen_editar").val(data["data"]["imagen"]);
                $("#preview_imagen_editar").attr("src","{{ asset('/storage/imagenes/subcategorias') }}/"+data["data"]["imagen"]); 
                $("#mostrar_en_menu_editar").val(data["data"]["mostrar_en_menu"]);
                $("#activa_editar").val(data["data"]["activa"]);
                $("#modal_editar").modal("show");
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
}

function editar()
{
    var formdata = new FormData();

    formdata.append("id",id_trabajando);
    formdata.append("nombre",$("#formulario_editar [name=nombre]").val());
    formdata.append("imagen",$("#formulario_editar [name=imagen]").val());
    formdata.append("mostrar_en_menu",$("#formulario_editar [name=mostrar_en_menu]").val());
    formdata.append("activa",$("#formulario_editar [name=activa]").val());
    formdata.append("id_categoria",{{$id_categoria}});

    $.ajax({
        url: "{{$link_controlador}}update",
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
                $("#modal_editar").modal("hide");

                mostrar_mensajes_success(
                    "{{$abm_messages['success_edit']['title']}}",
                    "{{$abm_messages['success_edit']['description']}}"
                );

                listado.draw();
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
}

function eliminar(id)
{
    swal({
        title: "{{$abm_messages['delete']['title']}}",
        text: "{{$abm_messages['delete']['text']}}",
        type: 'error',
        buttons:{
            confirm: {
                text : "{{$abm_messages['delete']['confirmButtonText']}}",
                className : "{{$config_buttons['delete']['class']}}",
            },
            cancel: {
                visible: true,
                text : "{{$abm_messages['delete']['cancelButtonText']}}",
                className: "{{$config_buttons['cancel']['class']}}",
            }
        }
    }).then((Delete) => {
        if (Delete) {

            $.ajax({
                url: "{{$link_controlador}}delete",
                type: "POST",
                data: {id:id},
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
                            mostrar_mensajes_success(
                                "{{$abm_messages['delete']['success_text']}}",
                                "{{$abm_messages['delete']['success_description']}}",
                            );

                            listado.draw();
                        }
                        else
                        {
                            mostrar_mensajes_errores();
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
        } else {
            swal.close();
        }
    });
}

</script>

@endsection