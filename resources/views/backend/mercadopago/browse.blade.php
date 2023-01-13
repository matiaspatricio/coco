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
                            
                        </div>
                        <div class="card-body">

                            <form action="#" id="formulario_editar" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="CLIENT_ID">CLIENT_ID <span class="text-danger">*</span></label>
                                        <input type="text" id="CLIENT_ID" name="CLIENT_ID" class="form-control" value="{{$row_obj->CLIENT_ID}}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="CLIENT_SECRET">CLIENT_SECRET <span class="text-danger">*</span></label>
                                        <input type="text" id="CLIENT_SECRET" name="CLIENT_SECRET" class="form-control" value="{{$row_obj->CLIENT_SECRET}}">
                                    </div>
                                </div>
                                <div class="row mt-3">

                                    <div class="col-md-12">
                                        <label for="SHORT_NAME">SHORT_NAME <span class="text-danger">*</span></label>
                                        <input type="text" id="SHORT_NAME" name="SHORT_NAME" class="form-control" value="{{$row_obj->SHORT_NAME}}">
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

<script type="text/javascript">


$("#formulario_editar").submit(function(){

    var formdata = new FormData();

    formdata.append("CLIENT_ID",$("#formulario_editar [name=CLIENT_ID]").val());
    formdata.append("CLIENT_SECRET",$("#formulario_editar [name=CLIENT_SECRET]").val());
    formdata.append("SHORT_NAME",$("#formulario_editar [name=SHORT_NAME]").val());
    
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
                mostrar_mensajes_success("Editado!","Se han editado los datos correctamente","{{$link_controlador}}");
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