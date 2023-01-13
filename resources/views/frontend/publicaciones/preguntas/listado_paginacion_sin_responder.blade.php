@if(count($data))
    @foreach ($data as $value)
    
        <div class="card" style="margin-top: 10px;">
            <div class="card-body">
                <?php

                $fecha_hora = \DateTime::createFromFormat("Y-m-d H:i:s",$value->updated_at);
                $fecha_hora = $fecha_hora->format("d/m/Y H:i");
                ?>
                <span style="color: #0071df;font-weight: bold;">{{$fecha_hora}}</span>
                <p>{{$value->pregunta}}</p>
                <button class="btn btn-primary btn-default" onclick="abrir_modal_responder({{$value->id}})">
                    Responder
                </button>
            </div>
        </div>
    @endforeach
    
    <div class="row">
        <div class="col-md-12">
            <div class="dataTables_info" id="tabla_listado_info" role="status" aria-live="polite">
                Viendo desde {{ ($page*5-4) }} a {{($page*5-5) + count($data)}} de {{$totalFiltered}} registros
            </div>
        </div>
    </div>

    {!! $data->links('frontend.template.pagination_js',["function_js"=>$function_js]) !!}
@else
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
        </button>
        Todavía no se han cargado preguntas.
    </div>
@endif
