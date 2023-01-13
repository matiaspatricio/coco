@extends('frontend.template.master')

@section('title', 'BUSCAR')

@section('style')

<style>

.widget_shop .ps-checkbox.ps-checkbox--color>label:before {
    border-width: 1px;
    border-color: #000;
    border-style: solid;
}

</style>


<?php

foreach($colores as $color_obj)
{
    echo
    '<style>
    .ps-variant.ps-variant--color.color--'.$color_obj->id.':before {
        background-color: '.$color_obj->color.' !important;
    }
    </style>';
}
?>

<style>
.ps-checkbox--color>label:before {
    width: 30px !important;
    height: 30px !important;
    border-width: 1px;
    border-color: #000;
    border-style: solid;
}
</style>

@endsection


@section('contenido')

<div class="ps-breadcrumb">
    <div class="ps-container">
    <ul class="breadcrumb">
        <li>Búsqueda</li>
    </ul>
    </div>
</div>
<div class="ps-page--shop mt-2" id="shop-sidebar">
    <div class="container">
    <div class="ps-layout--shop">
        <div class="ps-layout__left">

            @if($subcategorias && $categoria_selecionada_obj)

            <aside class="widget widget_shop">
                <h4 class="widget-title">Subcategorías</h4>
                    <ul class="ps-list--categories">
                    
                        <?php

                        $contador_subcategorias_showing = 0;

                        foreach($subcategorias as $subcategoria_row)
                        {
                        ?>
                        
                            <li class="menu-item-has-children">
                                <a href="{{url('/buscar?texto='.$texto.'&id_subcategoria='.$subcategoria_row->id)}}">
                                    {{$subcategoria_row->nombre}} 
                                </a>
                            </li>

                        <?php
                            $contador_subcategorias_showing++;

                            if($contador_subcategorias_showing == 9)
                            {
                                break;
                            }
                        }
                        ?>

                        @if(count($subcategorias) > $contador_subcategorias_showing)
                        <li class="menu-item-has-children">
                            <a href="javascript:ver_todas_categorias()">Ver todas</a>
                        </li>
                        @endif
                    </ul>
                </li>
            </aside>

            @endif

        <aside class="widget widget_shop">
            <h4 class="widget-title">Categorías</h4>
                <ul class="ps-list--categories">
                
                    <?php

                    $contador_categorias_showing = 0;

                    foreach($categorias as $categoria_row)
                    {
                    ?>
                    
                        <li class="menu-item-has-children">
                            <a href="{{url('/buscar?texto='.$texto.'&id_categoria='.$categoria_row->id)}}">
                                {{$categoria_row->nombre}} 
                            </a>
                        </li>

                    <?php
                        $contador_categorias_showing++;

                        if($contador_categorias_showing == 9)
                        {
                            break;
                        }
                    }
                    ?>

                    @if(count($categorias) > $contador_categorias_showing)
                    <li class="menu-item-has-children">
                        <a href="javascript:ver_todas_categorias()">Ver todas</a>
                    </li>
                    @endif
                </ul>
            </li>
        </aside>

        <aside class="widget widget_shop">
            <h4 class="widget-title">Condición</h4>
                <ul class="ps-list--categories">
                    <li>
                        <a href="{{url('/buscar?texto='.$texto.'&id_categoria='.$categoria_row->id.'&condicion=nuevo')}}">
                            Nuevo
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/buscar?texto='.$texto.'&id_categoria='.$categoria_row->id.'&condicion=usado')}}">
                            Usado
                        </a>
                    </li>
                </ul>
            </li>
        </aside>

        <aside class="widget widget_shop">
            <h4 class="widget-title">Tipo</h4>
                <ul class="ps-list--categories">
                    <li>
                        <a href="{{url('/buscar?texto='.$texto.'&id_categoria='.$categoria_row->id.'&condicion=nuevo')}}">
                            Bienes
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/buscar?texto='.$texto.'&id_categoria='.$categoria_row->id.'&condicion=usado')}}">
                            Servicios
                        </a>
                    </li>
                </ul>
            </li>
        </aside>

        <aside class="widget widget_shop">
            
            <h4 class="widget-title">Por precio</h4>
            <div class="ps-slider" data-default-min="13" data-default-max="1300" data-max="1311" data-step="100" data-unit="$"></div>
            <p class="ps-slider__meta">Price:<span class="ps-slider__value ps-slider__min"></span>-<span class="ps-slider__value ps-slider__max"></span></p>
            </figure>
            <figure>
            
            <h4 class="widget-title">Por colores</h4>

            <select class="form-control" id="colores" multiple="multiple">
                @foreach($colores as $color_row)
                <option value="{{$color_row->id}}">{{$color_row->nombre}}</option>
                @endforeach
            </select>

            </figure>

            <h4 class="widget-title">Por talles</h4>

            <select class="form-control" id="talles" multiple="multiple">
                @foreach($talles as $talle_row)
                <option value="{{$talle_row->id}}">{{$talle_row->talle}}</option>
                @endforeach
            </select>

            </figure>
        </aside>
        </div>
        <div class="ps-layout__right">
        
        
        <div class="ps-shopping ps-tab-root"><a class="ps-shop__filter-mb" href="#" id="filter-sidebar"><i class="icon-menu"></i> Show Filter</a>
            @if($texto)
            <div>
            <h2>"{{$texto}}"</h2>
            </div>
            @endif
            <div class="ps-shopping__header">
                <p><strong> {{$publicaciones->total()}}</strong> Publicaciones encontradas</p>
                <div class="ps-shopping__actions">
                    <select class="ps-select" data-placeholder="Sort Items" id="selector_ordenamiento">
                        <option value="0">Ordenar por último</option>
                        <option value="1">Ordenar por popularidad</option>
                        <option value="2">Ordenar por precio: de menor a mayor</option>
                        <option value="3">Ordenar por precio: de mayor a menor</option>
                    </select>
                </div>
            </div>
            <div class="ps-tabs">
            

            <div class="ps-tab active" id="tab-2">
                @foreach($publicaciones as $publicacion_obj)
                <div class="ps-product ps-product--wide">
                <div class="ps-product__thumbnail"><a href="{{$publicacion_obj->get_url()}}">
                    <img src="{{ asset('/storage/imagenes/publicaciones/'.$publicacion_obj->imagen_principal) }}" alt=""/></a>
                </div>
                <div class="ps-product__container">
                    <div class="ps-product__content"><a class="ps-product__title" href="{{$publicacion_obj->get_url()}}">{{$publicacion_obj->titulo}}</a>
                    <p class="ps-product__vendor">Publicado por: <a href="#">{{$publicacion_obj->vendedor_apellido." ".$publicacion_obj->vendedor_nombre}}</a></p>
                    </div>
                    <div class="ps-product__shopping">
                    <p class="ps-product__price">
                    @if($publicacion_obj->precio_desde != $publicacion_obj->precio_hasta)
                        ${{number_format($publicacion_obj->precio_desde,2,",",".")}} – ${{number_format($publicacion_obj->precio_hasta,2,",",".")}}
                    @else
                        ${{number_format($publicacion_obj->precio_desde,2,",",".")}}
                    @endif
                    </p>
                    <a class="ps-btn" href="{{$publicacion_obj->get_url()}}">Ver publicación</a>

                    @if($publicacion_obj->id_usuario != session("id") && session("ingreso_frontend") === true)
                    <ul class="ps-product__actions">
                        <li>
                            <a href="javascript:agregar_a_favorito({{$publicacion_obj->id}})" id="corazon_favorito_{{$publicacion_obj->id}}">
                                <?php
                                $favorito_publicacion = \App\FavoritoPublicacion::where("id_publicacion",$publicacion_obj->id)->where("id_usuario",session("id"))->first();
                                ?>
                                @if($favorito_publicacion)
                                <i style='color: #f00;' class='fa fa-heart'></i> Quitar de favoritos
                                @else
                                <i class='fa fa-heart-o'></i> Agregar a favoritos
                                @endif

                            </a>
                        </li>
                    </ul>
                    @endif
                    </div>
                </div>
                </div>
                
                @endforeach
                
                
                <!--
                <div class="ps-pagination">
                <ul class="pagination">
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">Next Page<i class="icon-chevron-right"></i></a></li>
                </ul>
                </div>
                -->
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        {{ $publicaciones->links('frontend.template.default_pagination') }}
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

@section("modals")

<div class="modal" tabindex="-1" role="dialog" id="modal_ver_todas_categorias">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Categorías</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

        @foreach($categorias as $categoria_row)
        <div class="col-md-4 mt-3">
            <a href="{{url('/buscar?texto='.$texto.'&id_categoria='.$categoria_row->id)}}">
                {{$categoria_row->nombre}} 
            </a>
        </div>
        
        @endforeach

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="modal_ver_todos_colores">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Colores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

        @foreach($colores as $color_obj)
                    
        <div class="col-md-2 mt-3" style="text-align:center;">
            <div class="ps-checkbox ps-checkbox--color color-{{$color_obj->id}} ps-checkbox--inline">
                <input class="form-control" type="checkbox" id="color-{{$color_obj->id}}-2" name="size"/>
                <label for="color-{{$color_obj->id}}-2"></label><br/>
                {{$color_obj->nombre}}
            </div>
        </div>
        @endforeach

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section("js_code")

<script>

$(document).ready(function(){

    $("#colores").select2({
      templateResult: function (data, container) {
          console.log($(data.element).attr("value")+"-"+$(data.element).text());

          var $result = $('<div class="ps-variant ps-variant--color color--'+($(data.element).attr("value"))+'" ><span class="ps-variant__tooltip"></span></div> <span>'+data.text+'</span>');
          return $result;
      }
    });

    $("#talles").select2();

});

$("#selector_ordenamiento").change(function()
{
    location.href="{{url('/buscar?texto='.$texto.'&id_categoria='.$categoria_row->id)}}&tipo_ordenamiento="+$(this).val();
});

function agregar_a_favorito(id_publicacion)
{
    $.ajax({
        url: "{{url('/publicaciones/agregar_a_favorito')}}",
        type: "POST",
        data: {id_publicacion:id_publicacion},
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
                    if(data["data"]["agregado"] == true)
                    {
                        $("#corazon_favorito_"+id_publicacion).html("<i style='color: #f00;' class='fa fa-heart'></i> Quitar de favoritos"); 
                    }
                    else
                    {
                        $("#corazon_favorito_"+id_publicacion).html("<i class='fa fa-heart-o'></i> Agregar a favoritos");
                    }

                    $("#cantidad_favoritos_menu_header").html(data["data"]["cantidad_favoritos"]);
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

function ver_todas_categorias()
{
    $("#modal_ver_todas_categorias").modal("show");
}

function ver_todos_colores()
{
    $("#modal_ver_todos_colores").modal("show");
}

</script>

@endsection