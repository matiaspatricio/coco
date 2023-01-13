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