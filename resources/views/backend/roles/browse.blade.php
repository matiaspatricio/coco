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
            Rol
        @endslot

        @slot('inputs')
            <div class="col-md-12">
                <label for="rol_agregar">Rol</label>
                <input type="text" class="form-control" id="rol_agregar" name="rol">
            </div>
        @endslot
    @endcomponent

    @component('backend.template.modal_editar')
        @slot('entidad')
            Rol
        @endslot

        @slot('inputs')
            <div class="col-md-12">
                <label for="rol_editar">Rol</label>
                <input type="text" class="form-control" id="rol_editar" name="rol">
            </div>
        @endslot
    @endcomponent

@endsection

@section("js_code")

<script type="text/javascript">
var listado = null;
var id_trabajando = 0;

$(document).ready( function () {
    listado= $('#tabla_listado').DataTable( {
          "processing": true,
          "serverSide": true,
          "responsive":false,
          "ajax":{
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
});

function abrir_modal_agregar()
{
  $("#formulario_agregar input[type=text]").val("");
  $("#formulario_agregar textarea").val("");
  $("#formulario_agregar select").val(0).trigger("change");
  $("#modal_agregar").modal("show");
}

function agregar()
{
    var formdata = new FormData();

    formdata.append("rol",$("#rol_agregar").val());

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
                $("#rol_editar").val(data["data"]["rol"]);
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
    formdata.append("rol",$("#rol_editar").val());

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