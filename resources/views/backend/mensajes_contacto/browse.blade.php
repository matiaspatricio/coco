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
    @component('backend.template.modal_ver')
        @slot('entidad')
            {{$entity}}
        @endslot

        @slot('inputs')
            <div class="col-md-6">
                <label for="nombre_ver">Nombre</label>
                <input type="text" class="form-control" id="nombre_ver" readonly="true" style="background-color: #fff !important;">
            </div>
            <div class="col-md-6">
                <label for="apellido_ver">Apellido</label>
                <input type="text" class="form-control" id="apellido_ver" readonly="true" style="background-color: #fff !important;">
            </div>
            <div class="col-md-12">
                <label for="asunto_ver">asunto</label>
                <input type="text" class="form-control" id="asunto_ver" readonly="true" style="background-color: #fff !important;">
            </div>
            <div class="col-md-12">
                <label for="mensaje_ver">Mensaje</label>
                <textarea class="form-control" id="mensaje_ver" readonly="true" rows="5" style="background-color: #fff !important;"></textarea>
            </div>
        @endslot
    @endcomponent
@endsection

@section("js_code")

<script type="text/javascript">

$(document).ready( function () {
    listado= $('#tabla_listado').DataTable( {
        "processing": true,
        "serverSide": true,
        "responsive":true,
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

function abrir_modal_ver(id)
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
                $("#nombre_ver").val(data["data"]["nombre"]);
                $("#apellido_ver").val(data["data"]["apellido"]);
                $("#asunto_ver").val(data["data"]["asunto"]);
                $("#mensaje_ver").val(data["data"]["mensaje"]);
                $("#modal_ver").modal("show");
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
</script>

@endsection