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

<div class="modal" tabindex="-1" role="dialog" id="modal_enviar">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enviar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <h4>¿Donde enviar?</h4>
                <p>Seleccione donde desea enviar el mensaje</p>
            </div>
            <div class="col-md-12">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="" id="enviar_correos_suscritos">
                        <span class="form-check-sign">Correos suscritos</span>
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="" id="enviar_correo_prueba">
                        <span class="form-check-sign">Correo configurado de prueba <span class="text-info">(correo_prueba_newsletter)</span></span>
                    </label>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="enviar_envio()">Enviar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

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
        "ordering": true,
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

function abrir_modal_enviar(id)
{
    id_trabajando = id;
    $("#enviar_correos_suscritos").prop("checked",false);
    $("#enviar_correo_prueba").prop("checked",false);
    $("#modal_enviar").modal("show");
}

function enviar_envio()
{
    var formdata = new FormData();

    formdata.append("id",id_trabajando);
    formdata.append("enviar_correos_suscritos",$("#enviar_correos_suscritos").prop("checked"));
    formdata.append("enviar_correo_prueba",$("#enviar_correo_prueba").prop("checked"));
    
    $.ajax({
        url: "{{ $link_controlador }}enviar_envio",
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
                $("#modal_enviar").modal("hide");

                mostrar_mensajes_success(
                    "Enviado!",
                    "Se ha enviado correctamente el newsletter"
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
