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
                            <div class="d-flex align-items-center">
                                <a class='{{$config_buttons["go_back"]["class"]}}' href="{{ $link_controlador }}">
                                    <i class='{{$config_buttons["go_back"]["icon"]}}'></i>
                                    {{$config_buttons["go_back"]["title"]}}
                                </a>
                            </div>
                        </div>

                        <div class="card-body">

                          <div class="row">

                            <div class="col-md-6 mt-2">
                                <label for="clave">Nombre: <span class="text-danger">*</span></label>
                                <input type="text" name="clave" id="clave" class="form-control" value="{{$row_obj->clave}}" readonly="true">
                            </div>

                             <div class="col-md-6 mt-2">
                                 <label for="valor">Valor: <span class="text-danger">*</span></label>
                                 <input type="text" name="valor" id="valor" class="form-control" value="{{$row_obj->valor}}">
                             </div>

                              <div class="col-md-12 mt-4" style="text-align: center;">
                                  <button class='{{$config_buttons["edit"]["class"]}}' onClick="editar()">
                                      <i class='{{$config_buttons["edit"]["icon"]}}'></i>
                                      {{$config_buttons["edit"]["title"]}} {{$entity}}
                                  </button>
                              </div>

                          </div>

                        </div>
                    </div>
                </div>
	          </div>
        </div>
    </div>
</div>
@endsection



@section("js_code")

<script type="text/javascript">

$(document).ready( function () {
    
});

function editar()
{
    var formdata = new FormData();

    formdata.append("id",{{$row_obj->id}});
    formdata.append("valor",$("#valor").val());

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
}
</script>

@endsection
