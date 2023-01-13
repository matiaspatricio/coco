@extends('frontend.template.master')

@section('title', e($publicacion_obj->titulo))

@section("style")

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

@endsection

@section('contenido')
<div class="ps-breadcrumb">
    <div class="ps-container">
    <ul class="breadcrumb">
        <li><a href="{{url('/')}}">Inicio</a></li>
        <li><a href="{{url('/buscar?id_categoria='.$publicacion_obj->id_categoria)}}">{{$publicacion_obj->get_categoria->nombre}}</a></li>
        <li><a href="{{url('/buscar?id_categoria='.$publicacion_obj->id_categoria.'&id_subcategoria='.$publicacion_obj->id_subcategoria)}}">{{$publicacion_obj->get_subcategoria->nombre}}</a></li>
        <li>{{$publicacion_obj->titulo}}</li>
    </ul>
    </div>
</div>
<div class="ps-page--product">
    <div class="ps-container">
    <div class="ps-page__container">
        <div class="ps-page__left">
        <div class="ps-product--detail ps-product--fullwidth">
            <div class="ps-product__header">
            <div class="ps-product__thumbnail" data-vertical="true">
                <figure>
                    <div class="ps-wrapper">
                        <div class="ps-product__gallery" data-arrow="true">
                          @foreach($publicacion_obj->get_imagenes as $imagen_publicacion)
                          <div class="item">
                            <a href="{{ asset('/storage/imagenes/publicaciones/'.$imagen_publicacion->file_name) }}">
                              <img src="{{ asset('/storage/imagenes/publicaciones/'.$imagen_publicacion->file_name) }}" alt="">
                            </a>
                          </div>
                          @endforeach

                        </div>
                    </div>
                </figure>
                <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
                  
                  @foreach($publicacion_obj->get_imagenes as $imagen_publicacion)
                  <div class="item">
                    <img src="{{ asset('/storage/imagenes/publicaciones/'.$imagen_publicacion->file_name) }}" alt="">
                  </div>
                  @endforeach
                </div>
            </div>
            <div class="ps-product__info">
                <h1>{{$publicacion_obj->titulo}}</h1>
                <div class="ps-product__meta">
                </div>
                <h4 class="ps-product__price">
                @if($publicacion_obj->precio_desde != $publicacion_obj->precio_hasta)
                    ${{number_format($publicacion_obj->precio_desde,2,",",".")}} – ${{number_format($publicacion_obj->precio_hasta,2,",",".")}}
                @else
                    ${{number_format($publicacion_obj->precio_desde,2,",",".")}}
                @endif
                </h4>
                
                <div class="ps-product__desc">
                    <p>Publicado por:<a href="javascript:void()"><strong> {{$publicacion_obj->get_usuario->usuario}}</strong></a></p>
                    <ul class="ps-list--dot">
                        <?php
                        
                        $metodos_de_pagos = $publicacion_obj->get_metodos_de_pago;

                        $metodos_de_pagos_string = "";

                        if(count($metodos_de_pagos) > 0)
                        {
                            foreach($metodos_de_pagos as $medio_de_pago_publicacion_row)
                            {
                                $medio_de_pago_row = $medio_de_pago_publicacion_row->get_medio_de_pago;
    
                                if($medio_de_pago_row)
                                {
                                    if($metodos_de_pagos_string == "")
                                    {
                                        $metodos_de_pagos_string = $medio_de_pago_row->medio_de_pago;
                                    }
                                    else
                                    {
                                        $metodos_de_pagos_string .= ", ".$medio_de_pago_row->medio_de_pago;
                                    }
                                }
                            }
                        }
                        else
                        {
                            $metodos_de_pagos_string = "No especificado";
                        }
                        
                        ?>
                        <li>
                            Tipo de operación: <?php echo e($publicacion_obj->condicion);?>
                        </li>
                        <li>
                            Condición: <?php echo e($publicacion_obj->condicion);?>
                        </li>
                        <li>
                            Métodos de pago: <?php echo e($metodos_de_pagos_string);?>
                        </li>
                    </ul>
                </div>
                <div class="ps-product__variations">
                    <figure>
                        <figcaption>Color</figcaption>
                            @foreach($publicacion_obj->get_colores_publicacion as $color_publicacion_row)
                                @php
                                $color_row = $color_publicacion_row->get_color;
                                @endphp
                                
                                @if($color_row)
                                    <div class="ps-variant ps-variant--color color--{{$color_row->id}}"><span class="ps-variant__tooltip">{{$color_row->nombre}}</span></div>
                                @endif
                        @endforeach
                    </figure>
                </div>

                <div class="ps-product__shopping">
                    @if($publicacion_obj->id_usuario != session("id"))
                        <figure>
                            <figcaption>Cantidad</figcaption>
                            <div class="form-group--number">
                            <button class="up" onclick="sumar_cantidad()"><i class="fa fa-plus"></i></button>
                            <button class="down" onclick="restar_cantidad()"><i class="fa fa-minus"></i></button>
                            <input class="form-control" type="text" placeholder="1" id="cantidad_a_solicitar">
                            </div>
                        </figure>
                        <a class="ps-btn ps-btn--gray" href="#">Agregar al Carrito</a>
                        <a class="ps-btn" href="#">Compra ahora</a>
                        @if($publicacion_obj->id_usuario != session("id") && session("ingreso_frontend") === true)
                        <div class="ps-product__actions" >
                            <a href="javascript:agregar_a_favorito()" id="corazon_favorito">
                                @if($favorito_publicacion)
                                    <i style='color: #f00;' class='fa fa-heart'></i>
                                @else
                                    <i class='fa fa-heart-o'></i>
                                @endif
                            </a>
                            <!--<a href="#"><i class="icon-chart-bars"></i></a>-->
                        </div>
                        @endif
                    @endif
                </div>
                <div class="ps-product__specification">
                    @if($publicacion_obj->id_usuario != session("id"))
                    <a class="report" href="javascript:abrir_modal_reportar_abuso()">Reportar abuso</a>
                    @endif
                    <!--<p><strong>SKU:</strong> SF1133569600-1</p>-->
                    <p class="categories"><strong> Categoría:</strong><a href="{{url('/buscar?id_categoria='.$publicacion_obj->id_categoria)}}">{{$publicacion_obj->get_categoria->nombre}}</a></p>
                    <p class="categories"><strong> Subcategoría:</strong><a href="{{url('/buscar?id_categoria='.$publicacion_obj->id_categoria.'&id_subcategoria='.$publicacion_obj->id_subcategoria)}}">{{$publicacion_obj->get_subcategoria->nombre}}</a></p>
                    <!--<p class="tags"><strong> Tags: </strong><a href="#">sofa</a>, <a href="#">tecnologías</a>, <a href="#">wifi</a></p>-->
                </div>

                <div class="ps-product__sharing">
                    <a class="facebook fb-share" href="#"><i class="fa fa-facebook"></i></a>
                    <a class="twitter tw-share" href="#"><i class="fa fa-twitter"></i></a>
                    <a class="google" href="#"><i class="fa fa-google-plus"></i></a>
                    <a class="whatsapp wp-share" href="#"><i class="fa fa-whatsapp"></i></a>
                    <a class="linkedin lin-share" href="#"><i class="fa fa-linkedin"></i></a>
                </div>
            </div>
            </div>
            <div class="ps-product__content ps-tab-root">
                <ul class="ps-tab-list">
                    <li class="active"><a href="#tab-1">Descripción</a></li>
                    @if($publicacion_obj->id_usuario == session("id"))
                    <li><a href="#tab-3">Preguntas sin constestar</a></li>
                    @endif
                    <li><a href="#tab-2">Preguntas y respuestas</a></li>
                </ul>
                <div class="ps-tabs">
                    <div class="ps-tab active" id="tab-1">
                        <div class="ps-document">
                            {{$publicacion_obj->descripcion}}
                        </div>
                    </div>
                    <div class="ps-tab" id="tab-2">
                        <div class="ps-block--questions-answers">
                            <!--<h3>Preguntas y Respuestas</h3>-->
                            @if($publicacion_obj->id_usuario != session("id"))
                                @if(session("ingreso_frontend") == TRUE)
                                    <form id="formulario_hacer_pregunta">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="¿Tienes una pregunta?" name="pregunta">
                                            <div style="text-align: center;" class="mt-3">
                                                <button class="ps-btn">
                                                    Enviar pregunta
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            @else

                            @endif

                            <div id="listado_preguntas_respuestas"></div>
                        </div>
                    </div>
                    <div class="ps-tab" id="tab-3">
                        <div class="ps-block--questions-answers">
                            <div id="listado_preguntas_sin_responder"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="ps-page__right">
        <aside class="widget widget_product widget_features">
            <p><i class="icon-network"></i> Envíos a todo el país</p>
            <p><i class="icon-credit-card"></i> Pague en línea o al recibir bienes</p>
        </aside>
        @if(session("ingreso_frontend") !== TRUE)
        <aside class="widget widget_sell-on-site">
            <p><i class="icon-store"></i> ¿Publicar en {{Config("app.name")}}?<a href="#"> Registrarse !</a></p>
        </aside>
        @endif
        <aside class="widget widget_ads"><a href="#"><img src="{{ asset('/assets/img/ads/product-ads.png') }}" alt=""></a></aside>
        <aside class="widget widget_same-brand">
            <h3>Publicaciones del vendedor</h3>
            <div class="widget__content">
            
            @foreach($mas_publicaciones_publicador as $mas_publicacion_obj)
            <div class="ps-product">
                <div class="ps-product__thumbnail">
                    <a href="{{$mas_publicacion_obj->get_url()}}">
                        <img src="{{ asset('/storage/imagenes/publicaciones/'.$mas_publicacion_obj->imagen_principal) }}" alt=""/>
                    </a>
                </div>
                <div class="ps-product__container">
                    <a class="ps-product__vendor" href="#">
                    <?php
                    $usuario_publicador = $mas_publicacion_obj->get_usuario;
                    ?>
                    {{$usuario_publicador->nombre.' '.$usuario_publicador->apellido}}
                    </a>
                    <div class="ps-product__content">
                        <a class="ps-product__title" href="{{$mas_publicacion_obj->get_url()}}">
                            {{$mas_publicacion_obj->titulo}}
                        </a>
                        
                        <p class="ps-product__price sale">
                        @if($mas_publicacion_obj->precio_desde != $mas_publicacion_obj->precio_hasta)
                            ${{number_format($mas_publicacion_obj->precio_desde,2,",",".")}} – ${{number_format($mas_publicacion_obj->precio_hasta,2,",",".")}}
                        @else
                            ${{number_format($mas_publicacion_obj->precio_desde,2,",",".")}}
                        @endif
                        </p>
                    </div>
                    <div class="ps-product__content hover"><a class="ps-product__title" href="{{$mas_publicacion_obj->get_url()}}">Grand Slam Indoor Of Show Jumping Novel</a>
                        <p class="ps-product__price sale">
                        @if($mas_publicacion_obj->precio_desde != $mas_publicacion_obj->precio_hasta)
                            ${{number_format($mas_publicacion_obj->precio_desde,2,",",".")}} – ${{number_format($mas_publicacion_obj->precio_hasta,2,",",".")}}
                        @else
                            ${{number_format($mas_publicacion_obj->precio_desde,2,",",".")}}
                        @endif
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
            
            </div>
        </aside>
        </div>
    </div>
    <div class="ps-section--default ps-customer-bought">
        <div class="ps-section__header">
        <h3>Los clientes que compraron este artículo también compraron</h3>
        </div>
        <div class="ps-section__content">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
            <div class="ps-product">
                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="{{ asset('/assets/img/products/shop/4.jpg') }}" alt=""/></a>
                <div class="ps-product__badge hot">hot</div>
                <ul class="ps-product__actions">
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                </ul>
                </div>
                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Global Office</a>
                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Xbox One Wireless Controller Black Color</a>
                    <div class="ps-product__rating">
                    <select class="ps-rating" data-read-only="true">
                        <option value="1">1</option>
                        <option value="1">2</option>
                        <option value="1">3</option>
                        <option value="1">4</option>
                        <option value="2">5</option>
                    </select><span>01</span>
                    </div>
                    <p class="ps-product__price">$55.99</p>
                </div>
                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Xbox One Wireless Controller Black Color</a>
                    <p class="ps-product__price">$55.99</p>
                </div>
                </div>
            </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
            <div class="ps-product">
                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="{{ asset('/assets/img/products/shop/5.jpg') }}" alt=""/></a>
                <div class="ps-product__badge">-37%</div>
                <ul class="ps-product__actions">
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                </ul>
                </div>
                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>
                    <div class="ps-product__rating">
                    <select class="ps-rating" data-read-only="true">
                        <option value="1">1</option>
                        <option value="1">2</option>
                        <option value="1">3</option>
                        <option value="1">4</option>
                        <option value="2">5</option>
                    </select><span>01</span>
                    </div>
                    <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p>
                </div>
                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>
                    <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p>
                </div>
                </div>
            </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
            <div class="ps-product">
                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="{{ asset('/assets/img/products/shop/6.jpg') }}" alt=""/></a>
                <div class="ps-product__badge">-5%</div>
                <ul class="ps-product__actions">
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                </ul>
                </div>
                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Youngshop</a>
                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>
                    <div class="ps-product__rating">
                    <select class="ps-rating" data-read-only="true">
                        <option value="1">1</option>
                        <option value="1">2</option>
                        <option value="1">3</option>
                        <option value="1">4</option>
                        <option value="2">5</option>
                    </select><span>01</span>
                    </div>
                    <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p>
                </div>
                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>
                    <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p>
                </div>
                </div>
            </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
            <div class="ps-product">
                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="{{ asset('/assets/img/products/shop/7.jpg') }}" alt=""/></a>
                <div class="ps-product__badge">-16%</div>
                <ul class="ps-product__actions">
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                </ul>
                </div>
                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Youngshop</a>
                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Korea Long Sofa Fabric In Blue Navy Color</a>
                    <div class="ps-product__rating">
                    <select class="ps-rating" data-read-only="true">
                        <option value="1">1</option>
                        <option value="1">2</option>
                        <option value="1">3</option>
                        <option value="1">4</option>
                        <option value="2">5</option>
                    </select><span>01</span>
                    </div>
                    <p class="ps-product__price sale">$567.89 <del>$670.20 </del></p>
                </div>
                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Korea Long Sofa Fabric In Blue Navy Color</a>
                    <p class="ps-product__price sale">$567.89 <del>$670.20 </del></p>
                </div>
                </div>
            </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
            <div class="ps-product">
                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="{{ asset('/assets/img/products/shop/8.jpg') }}" alt=""/></a>
                <div class="ps-product__badge">-16%</div>
                <ul class="ps-product__actions">
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                </ul>
                </div>
                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young shop</a>
                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Unero Military Classical Backpack</a>
                    <div class="ps-product__rating">
                    <select class="ps-rating" data-read-only="true">
                        <option value="1">1</option>
                        <option value="1">2</option>
                        <option value="1">3</option>
                        <option value="1">4</option>
                        <option value="2">5</option>
                    </select><span>02</span>
                    </div>
                    <p class="ps-product__price sale">$35.89 <del>$42.20 </del></p>
                </div>
                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Unero Military Classical Backpack</a>
                    <p class="ps-product__price sale">$35.89 <del>$42.20 </del></p>
                </div>
                </div>
            </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
            <div class="ps-product">
                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="{{ asset('/assets/img/products/shop/9.jpg') }}" alt=""/></a>
                <ul class="ps-product__actions">
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                </ul>
                </div>
                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young shop</a>
                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Rayban Rounded Sunglass Brown Color</a>
                    <div class="ps-product__rating">
                    <select class="ps-rating" data-read-only="true">
                        <option value="1">1</option>
                        <option value="1">2</option>
                        <option value="1">3</option>
                        <option value="1">4</option>
                        <option value="2">5</option>
                    </select><span>02</span>
                    </div>
                    <p class="ps-product__price">$35.89</p>
                </div>
                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Rayban Rounded Sunglass Brown Color</a>
                    <p class="ps-product__price">$35.89</p>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

    <?php
    $cantidad_publicaciones_relacionadas = count($publicaciones_relacionadas);
    ?>

    @if($cantidad_publicaciones_relacionadas > 0)
    <div class="ps-section--default">
        <div class="ps-section__header">
            <h3>Productos relacionados</h3>
        </div>
        <div class="ps-section__content">
            <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                
                @foreach($publicaciones_relacionadas as $publicacion_relacionada)
                <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                    <div class="ps-product">
                        <div class="ps-product__thumbnail"><a href="{{$publicacion_relacionada->get_url()}}">
                            <img src="{{ asset('/storage/imagenes/publicaciones/'.$publicacion_relacionada->imagen_principal) }}" alt=""/>
                        </a>
                        <!--<div class="ps-product__badge hot">hot</div>-->
                       
                        </div>
                        <div class="ps-product__container">
                        <a class="ps-product__vendor" href="#">
                        <?php
                        $usuario_publicador = $publicacion_relacionada->get_usuario;
                        ?>
                        {{$usuario_publicador->nombre.' '.$usuario_publicador->apellido}}
                        </a>
                        <div class="ps-product__content">
                            <a class="ps-product__title" href="{{$publicacion_relacionada->get_url()}}">
                                {{$publicacion_relacionada->titulo}}
                            </a>
                            <div class="ps-product__rating">
                            
                            </div>
                            <p class="ps-product__price">
                            @if($publicacion_relacionada->precio_desde != $publicacion_relacionada->precio_hasta)
                                ${{number_format($publicacion_relacionada->precio_desde,2,",",".")}} – ${{number_format($publicacion_relacionada->precio_hasta,2,",",".")}}
                            @else
                                ${{number_format($publicacion_relacionada->precio_desde,2,",",".")}}
                            @endif
                            </p>
                        </div>
                        <div class="ps-product__content hover">
                            <a class="ps-product__title" href="{{$publicacion_relacionada->get_url()}}">
                                {{$publicacion_relacionada->titulo}}
                            </a>
                            <p class="ps-product__price">
                            @if($publicacion_relacionada->precio_desde != $publicacion_relacionada->precio_hasta)
                                ${{number_format($publicacion_relacionada->precio_desde,2,",",".")}} – ${{number_format($publicacion_relacionada->precio_hasta,2,",",".")}}
                            @else
                                ${{number_format($publicacion_relacionada->precio_desde,2,",",".")}}
                            @endif
                            </p>
                        </div>
                        </div>
                    </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    @endif

    </div>
</div>
@endsection

@section("modals")

<div class="modal" tabindex="-1" role="dialog" id="modal_reportar_abuso">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reportar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formulario_reportar">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning" role="alert">
                        Reporte la publicación y un administrador la revisará, ingrese un titulo y su descripción del reporte
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="titulo_reportar_abuso">Titulo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="titulo_reportar_abuso" name="titulo">
                </div>
                <div class="col-md-12">
                    <label for="descripcion_reportar_abuso">Descripción: <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="descripcion_reportar_abuso" name="descripcion" rows="5"></textarea>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-primary" onclick='enviar_reporte()'>Enviar Reporte</button>
        <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


@if($publicacion_obj->id_usuario == session("id"))
<div class="modal" tabindex="-1" role="dialog" id="modal_responder_pregunta">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Responder pregunta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formulario_responder_pregunta">
            <div class="row">
                <div class="col-md-12">
                    <label for="respuesta_responder_pregunta">Respuesta <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="respuesta_responder_pregunta" name="respuesta"></textarea>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-primary" onclick='enviar_respuesta()'>Enviar Respuesta</button>
        <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
@endif

@endsection

@section("js_code")

<script>
    var page = 1;

    @if($publicacion_obj->id_usuario == session("id"))
    var page_preg_sin_responder = 1;
    @endif

    $(window).load(function() {
        cargar_pagina(page);
        @if($publicacion_obj->id_usuario == session("id"))
        cargar_pagina_preg_sin_responder(page_preg_sin_responder);
        @endif
    });

    function cargar_pagina(page_parameter)
    {
        page = page_parameter;

        $.ajax(
        {
            url: "{{url('/publicaciones/get_pagination')}}",
            type: "POST",
            datatype: "html",
            data: {
                id_publicacion: {{$publicacion_obj->id}},
                page:page
            },
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        }).done(function(data){

            $("#listado_preguntas_respuestas").empty().html(data);

        }).fail(function(jqXHR, ajaxOptions, thrownError){
            mostrar_mensajes_errores();
        });
    }

    function agregar_a_favorito()
    {
      $.ajax({
          url: "{{url('/publicaciones/agregar_a_favorito')}}",
          type: "POST",
          data: {id_publicacion:{{$publicacion_obj->id}}},
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
                        $("#corazon_favorito").html("<i style='color: #f00;' class='fa fa-heart'></i>");
                    }
                    else
                    {
                        $("#corazon_favorito").html("<i class='fa fa-heart-o'></i>"); 
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

    @if($publicacion_obj->id_usuario == session("id"))

    function cargar_pagina_preg_sin_responder(page_parameter)
    {
        page_preg_sin_responder = page_parameter;

        $.ajax(
        {
            url: "{{url('/publicaciones/get_pagination_sin_responder')}}",
            type: "POST",
            datatype: "html",
            data: {
                id_publicacion: {{$publicacion_obj->id}},
                page:page_preg_sin_responder
            },
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        }).done(function(data){

            $("#listado_preguntas_sin_responder").empty().html(data);

        }).fail(function(jqXHR, ajaxOptions, thrownError){
            mostrar_mensajes_errores();
        });
    }

    var id_pregunta_a_responder = null;

    function abrir_modal_responder(id)
    {
        id_pregunta_a_responder = id;
        $("#respuesta_responder_pregunta").modal("hide");
        $("#modal_responder_pregunta").modal("show");
    }

    function enviar_respuesta()
    {
        var formdata = new FormData();

        formdata.append("id_pregunta_publicacion",id_pregunta_a_responder);
        formdata.append("respuesta",$("#formulario_responder_pregunta [name=respuesta]").val());

        $.ajax({
            url: "{{url('/publicaciones/responder_pregunta')}}",
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

                try{

                    if(data["response"])
                    {
                        $("#formulario_reportar [name=respuesta]").val("");
                        $("#modal_responder_pregunta").modal("hide");

                        mostrar_mensajes_success("Respondido!","Se ha enviado la respuesta correctamente");
                        cargar_pagina_preg_sin_responder(page_preg_sin_responder);
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

    @endif


    $("#cantidad_a_solicitar").on("input",function(){
        get_cantidad_a_solicitar();
    });

    function sumar_cantidad()
    {
        var cantidad_a_solicitar = get_cantidad_a_solicitar();
        cantidad_a_solicitar++;
        $("#cantidad_a_solicitar").val(cantidad_a_solicitar);
        get_cantidad_a_solicitar();
    }

    function restar_cantidad()
    {
        var cantidad_a_solicitar = get_cantidad_a_solicitar();
        cantidad_a_solicitar--;
        $("#cantidad_a_solicitar").val(cantidad_a_solicitar);
        get_cantidad_a_solicitar();
    }


    function get_cantidad_a_solicitar()
    {
        var cantidad_a_solicitar = parseInt($("#cantidad_a_solicitar").val());

        if(isNaN(cantidad_a_solicitar) || cantidad_a_solicitar == "" || cantidad_a_solicitar < 1)
        {
            $("#cantidad_a_solicitar").val(1);
            cantidad_a_solicitar = 1;
        }

        return cantidad_a_solicitar;
    }
</script>

<script>

$("#formulario_hacer_pregunta").submit(function(){

    var formdata = new FormData();

    formdata.append("id_publicacion",{{$publicacion_obj->id}});
    formdata.append("pregunta",$("#formulario_hacer_pregunta [name=pregunta]").val());

    $.ajax({
        url: "{{url('/publicaciones/agregar_pregunta')}}",
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

            try{

                if(data["response"])
                {
                    $("#formulario_hacer_pregunta [name=pregunta]").val("");

                    mostrar_mensajes_success("Enviada!","Se ha enviado la pregunta correctamente, te enviaremos un mail cuando sea respondida");
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

function abrir_modal_reportar_abuso()
{
    $("#modal_reportar_abuso").modal("show");
    return false;
}

$("#formulario_reportar").submit(function(){
    enviar_reporte();
    return false;
});

function enviar_reporte()
{
    var formdata = new FormData();

    formdata.append("id_publicacion",{{$publicacion_obj->id}});
    formdata.append("titulo",$("#formulario_reportar [name=titulo]").val());
    formdata.append("descripcion",$("#formulario_reportar [name=descripcion]").val());

    $.ajax({
        url: "{{url('/reportes/realizar_reporte')}}",
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

            try{

                if(data["response"])
                {
                    $("#formulario_reportar [name=titulo]").val("");
                    $("#formulario_reportar [name=descripcion]").val("");
                    $("#modal_reportar_abuso").modal("hide");

                    mostrar_mensajes_success("Enviado!","Se ha enviado el reporte correctamente");
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

<script>
    function PopupCenter(url, title, w, h)
    {
	    // Fixes dual-screen position                         Most browsers      Firefox
	    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
	    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

	    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
	    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

	    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
	    var top = ((height / 2) - (h / 2)) + dualScreenTop;
	    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

	    // Puts focus on the newWindow
	    if (window.focus) {
	        newWindow.focus();
	    }
	}

    $('.fb-share').on('click', function(){
        PopupCenter('https://www.facebook.com/sharer/sharer.php?u={{urlencode($publicacion_obj->get_url())}}','xtf','785','450');
        return false;
    })

    $('.tw-share').on('click', function(){
        PopupCenter('https://twitter.com/intent/tweet?text=Testing : {{urlencode($publicacion_obj->get_url())}}','xtf','785','450');
        return false;
    })

    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
    {
        $('.wp-share').attr('href', 'whatsapp://send?text={{urlencode($publicacion_obj->get_url())}}');
    }
    else
    {
        $('.wp-share').on('click', function(){
            PopupCenter('https://web.whatsapp.com/send?text=Terreno en Venta "Venta Urdinarrain Terrenos": {{urlencode($publicacion_obj->get_url())}}','xtf','785','450');
            return false;
        })
    }

    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
    {
        $('#aside-share').append('<a id="msg-share" href="fb-messenger://share/?link= https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fsharing%2Freference%2Fsend-dialog&app_id=123456789”" style="color: #0184ff"><i class="fab fa-facebook-messenger"></i></a>');
    }

    $('.lin-share').on('click', function(){
        PopupCenter('https://www.linkedin.com/shareArticle?mini=true&url=&{{urlencode($publicacion_obj->get_url())}}&title=Venta Urdinarrain Terrenos&summary=Vendo en Urdinarrain, excelente lotes en el acceso sur de la ciudad , su consulta no molesta!!&nbsp;','xtf','785','450');
        return false;
    })
</script>



@endsection
