@extends('backend.template.master')

@section('title', $title_page)

@section('style')
<style>
.ck-editor__editable {
    min-height: 400px;
}
</style>
@endsection

@section('contenido')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">{{$title_page}}</h4>
            </div>

            <div class="row">
                <div class="col-12">
                    <a href="{{ $link_controlador }}" class="{{$config_buttons['go_back']['class']}}">
                        <i class="{{$config_buttons['go_back']['icon']}}"></i> {{$config_buttons['go_back']['title']}}
                    </a>
                </div>
                <div class="col-12" style="margin-top: 10px;">
                    <div class="card">
                        <div class="card-body">
                            <form action="#" id="formulario_editar" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="titulo">Titulo</label>
                                        <input type="text" id="titulo" name="titulo" class="form-control" value="{{$row_obj->titulo}}">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="descripcion">Descripción</label>
                                        <textarea id="descripcion" name="descripcion" class="form-control" rows="7">{{$row_obj->descripcion}}</textarea>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="cantidad">Cantidad</label>
                                        <input type="text" id="cantidad" name="cantidad" class="form-control" value="{{$row_obj->cantidad}}">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="id_estado_publicacion">Estado</label>
                                        <select id="id_estado_publicacion" name="id_estado_publicacion" class="form-control">
                                            @foreach($estados_publicaciones as $estado_publicacion)
                                                <option value="{{$estado_publicacion->id}}">{{$estado_publicacion->estado}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="precio_desde">Precio desde</label>
                                        <input type="text" id="precio_desde" name="precio_desde" class="form-control" value="{{$row_obj->precio_desde}}">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="precio_hasta">Precio hasta</label>
                                        <input type="text" id="precio_hasta" name="precio_hasta" class="form-control" value="{{$row_obj->precio_hasta}}">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="fecha_vencimiento">Fecha Vencimiento</label>
                                        <input type="text" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control" value="{{$row_obj->fecha_vencimiento}}">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="imagen_principal">Imagen Principal</label>
                                        <div style="text-align:center;">
                                            <img src="{{asset('/storage/imagenes/publicaciones/'.$row_obj->imagen_principal)}}" alt="" width="200">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="id_categoria">Categoría</label>
                                        <select id="id_categoria" name="id_categoria" class="form-control">
                                            @foreach($categorias as $categoria)
                                                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="id_subcategoria">Subcategoría</label>
                                        <select id="id_subcategoria" name="id_subcategoria" class="form-control">
                                            @foreach($subcategorias as $subcategoria)
                                                <option value="{{$subcategoria->id}}">{{$subcategoria->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="modelo">Modelo</label>
                                        <input type="text" id="modelo" name="modelo" class="form-control" value="{{$row_obj->modelo}}">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="version">Version</label>
                                        <input type="text" id="version" name="version" class="form-control" value="{{$row_obj->version}}">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="color">Color</label>
                                        <input type="text" id="color" name="color" class="form-control" value="{{$row_obj->color}}">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="cantidad_minima">Cantidad minima</label>
                                        <input type="text" id="cantidad_minima" name="cantidad_minima" class="form-control" value="{{$row_obj->cantidad_minima}}">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="id_provincia_alcanze">Provincia alcanze</label>
                                        <select id="id_provincia_alcanze" name="id_provincia_alcanze" class="form-control">
                                            @foreach($provincias as $provincia)
                                                <option value="{{$provincia->id}}">{{$provincia->provincia}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="id_ciudad_alcanze">Localidad alcanze</label>
                                        <select id="id_ciudad_alcanze" name="id_ciudad_alcanze" class="form-control">
                                            @foreach($localidades as $localidad)
                                                <option value="{{$localidad->id}}">{{$localidad->localidad}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="tipo">Tipo</label>
                                        <select id="tipo" name="tipo" class="form-control">
                                            @foreach($listado_tipos_publicaciones as $row_tipo_publicacion)
                                                <option value="{{$row_tipo_publicacion}}">{{$row_tipo_publicacion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                

                                
                                
                                <div class="row">
                                    <div class="col-md-12" style="text-align:center;margin-top: 10px;">
                                        <button class="{{$config_buttons['save']['class']}}">
                                            <i class="{{$config_buttons['save']['icon']}}"></i> {{$config_buttons['save']['title']}}
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

		</div>
    </div>
</div>

@endsection

@section("js_code")
<script src="{{asset('/admin/assets/js/plugin/dropzone/dropzone.js')}}"></script>

<script src="{{ url('adminlte3/plugins/ckeditor/ckeditor.js')}}"></script>

<script type="text/javascript">

var the_editor = null;

$(document).ready(function(){
    
    //CODIGO NUEVO
    $("#id_categoria").val({{$row_obj->id_categoria}});
    $("#id_subcategoria").val({{$row_obj->id_subcategoria}});
    $("#id_provincia_alcanze").val({{$row_obj->id_provincia_alcanze}});
    $("#id_ciudad_alcanze").val({{$row_obj->id_ciudad_alcanze}});
    $("#tipo").val({{$row_obj->tipo}});
    //FIN CODIGO NUEVO

    ClassicEditor
      .create(document.querySelector('#contenido'))
      .then(function (editor) {
        the_editor = editor;
      })
      .catch(function (error) {
        console.error(error)
    });

    $("#cambiar_imagen_icono").dropzone({
        autoProcessQueue: true,
        url: "{{url('/backend/upload_foto_icono_blog')}}",
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

                            $("#preview_imagen_icono").attr("src","{{asset('/storage/imagenes/blog/iconos')}}/"+file_name);
                            $("#formulario_editar [name=imagen_icono]").val(file_name);
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

    $("#cambiar_imagen_principal").dropzone({
        autoProcessQueue: true,
        url: "{{url('/backend/upload_foto_principal_blog')}}",
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

                            $("#preview_imagen_principal").attr("src","{{asset('/storage/imagenes/blog/imagenes')}}/"+file_name);
                            $("#formulario_editar [name=imagen_principal]").val(file_name);
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

    $("#id_categoria_blog").val({{$row_obj->id_categoria_blog}});
    $("#permite_comentarios").val({{$row_obj->permite_comentarios}});
    $("#activo").val({{$row_obj->activo}});
});

$("#formulario_editar").submit(function(){

    var formdata = new FormData();

    formdata.append("id",{{$row_obj->id}});
    formdata.append("titulo",$("#formulario_editar [name=titulo]").val());
    formdata.append("introduccion",$("#formulario_editar [name=introduccion]").val());
    formdata.append("url",$("#formulario_editar [name=url]").val());
    formdata.append("id_categoria_blog",$("#formulario_editar [name=id_categoria_blog]").val());
    formdata.append("permite_comentarios",$("#formulario_editar [name=permite_comentarios]").val());
    formdata.append("activo",$("#formulario_editar [name=activo]").val());
    formdata.append("imagen_icono",$("#formulario_editar [name=imagen_icono]").val());
    formdata.append("imagen_principal",$("#formulario_editar [name=imagen_principal]").val());
    formdata.append("contenido",the_editor.getData());
    
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
                mostrar_mensajes_success("Editado!","Se ha editado correctamente el blog","{{$link_controlador}}");
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