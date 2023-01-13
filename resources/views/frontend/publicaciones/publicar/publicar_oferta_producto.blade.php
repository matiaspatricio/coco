@extends('frontend.template.master')

@section('title', 'Realizar publicación')

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
        <li><a href="{{url('/')}}">Inicio</a></li>
        <li>Publicar</li>
    </ul>
    </div>
</div>

<div class="ps-page--shop" id="shop-categories" style="padding-top: 50px;">

    <div class="container">

        <div class="ps-page--shop" id="shop-categories" style="">
            <div class="container">

            <div class="mb-5">
                <?php
                // OFERTA
                if($id_tipo_publicacion == 1)
                {
                    if($tipo == "Bienes")
                    {
                        echo '<h3 class="text-center">Ofertar un producto</h3>';
                    }
                    else{
                        //SERVICIOS
                        echo '<h3 class="text-center">Ofertar un servicio</h3>';
                    }
                }
                else
                {
                    // DEMANDA
                    if($tipo == "Bienes")
                    {
                        echo '<h3 class="text-center">Demandar un producto</h3>';
                    }
                    else{
                        //SERVICIOS
                        echo '<h3 class="text-center">Demandar un servicio</h3>';
                    }
                }
                ?>
            </div>

            <div class="jumbotron" style="background-color: #fff;display: none;" id="paso_1" >
                <h1 class="display-4">
                    Primero escribí el título de tu publicación
                </h1>
                <p class="lead">
                    Indicá producto, marca y modelo para que los compradores sepan qué vendés.
                </p>
                <hr class="my-4">

                <div class="row">
                    <div class="col-12">
                        <label for="titulo">Titulo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="titulo" value="Prueba publicación">
                    </div>
                </div>  

                <hr class="my-4 mt-5">

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-lg btn-primary float-right"  onclick="irPasoSiguiente()">
                            Continuar <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>  

            </div>


            <div class="jumbotron mt-3" style="background-color: #fff;display: none;" id="paso_2">
                <h1 class="display-4">
                    Descripción de tu publicación
                </h1>
                <p class="lead">
                    Ingresa una descripción de tu publicación.
                </p>
                <hr class="my-4">

                <div class="row mt-3">
                    <div class="col-12">
                        <label for="descripcion">Descripción <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="descripcion" rows="5">TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING TESTING</textarea>
                    </div>
                </div>

                <hr class="my-4 mt-5">

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-lg btn-primary" onclick="irPasoAnterior()">
                            <i class="fa fa-arrow-left"></i> Atrás
                        </button>

                        <button class="btn btn-lg btn-primary float-right"  onclick="irPasoSiguiente()">
                            Continuar <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div> 

            </div>



            <div class="jumbotron mt-3"  style="background-color: #fff;display: none;" id="paso_3">
                <h1 class="display-4">
                    Categoría y subcategoría
                </h1>
                <p class="lead">
                    Seleccioná en que categoría y subcategoría encaja tu publicación.
                </p>
                <hr class="my-4">

                <div class="row">
                    <div class="col-6">
                        <label for="id_categoria">Categoría <span class="text-danger">*</span></label>
                        <select class="form-control" id="id_categoria" style="width: 100% !important;">
                            <option value="">Seleccionar</option>
                            @foreach($categorias as $categoria_row)
                            <option value="{{$categoria_row->id}}">{{$categoria_row->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="id_subcategoria">Subcategoría <span class="text-danger">*</span></label>
                        <select class="form-control" id="id_subcategoria" disabled="true" style="width: 100% !important;">
                            <option value="">Seleccionar</option>
                        </select>
                    </div>
                </div>  

                <hr class="my-4 mt-5">

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-lg btn-primary" onclick="irPasoAnterior()">
                            <i class="fa fa-arrow-left"></i> Atrás
                        </button>

                        <button class="btn btn-lg btn-primary float-right"  onclick="irPasoSiguiente()">
                            Continuar <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>  

            </div>


            <div class="jumbotron mt-3"  style="background-color: #fff;display: none;" id="paso_4">
                <h1 class="display-4">
                    Completá la información de tu producto
                </h1>
                <p class="lead">
                    Especificando algunos atributos del mismo.
                </p>
                <hr class="my-4">

                <div class="row">

                    <div class="col-3">
                        <label for="marca">Marca <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="marca">
                    </div>

                    <div class="col-3">
                        <label for="modelo">Modelo</label>
                        <input type="text" class="form-control" id="modelo">
                    </div>

                    <div class="col-3">
                        <label for="version">Versión</label>
                        <input type="text" class="form-control" id="version">
                    </div>

                    <div class="col-3">
                        <label for="id_genero">Genero</label>
                        <select class="form-control" id="id_genero">
                            <option value=""></option>
                            @foreach($generos as $genero_row)
                            <option value="{{$genero_row->id}}">{{$genero_row->genero}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3" style="padding-right: 0px;">
                        <label for="colores">Colores</label><br>
                        <select class="form-control" id="colores" multiple="multiple" style="width: 100% !important;">
                            @foreach($colores as $color_row)
                            <option value="{{$color_row->id}}">{{$color_row->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>  

                <hr class="my-4 mt-5">

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-lg btn-primary" onclick="irPasoAnterior()">
                            <i class="fa fa-arrow-left"></i> Atrás
                        </button>

                        <button class="btn btn-lg btn-primary float-right"  onclick="irPasoSiguiente()">
                            Continuar <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div> 

            </div>


            <div class="jumbotron mt-3" style="background-color: #fff;display: none;" id="paso_5">
                <h1 class="display-4">
                    ¿Cuál es la condición de tu producto?
                </h1>
                <hr class="my-4">

                <div class="row">
                    <div class="col-12">
                        <label for="condicion">Condición <span class="text-danger">*</span></label>
                        <select class="form-control" id="condicion">
                            <option value="" selected>Seleccionar</option>
                            <option value="Nuevo">Nuevo</option>
                            <option value="Usado">Usado</option>
                        </select>
                    </div>
                </div>  

                <hr class="my-4 mt-5">

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-lg btn-primary" onclick="irPasoAnterior()">
                            <i class="fa fa-arrow-left"></i> Atrás
                        </button>

                        <button class="btn btn-lg btn-primary float-right"  onclick="irPasoSiguiente()">
                            Continuar <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>  

            </div>

            <div class="jumbotron mt-3" style="background-color: #fff;display: none;" id="paso_6">
                <h1 class="display-4">
                    Completá la información de tu producto
                </h1>
                <hr class="my-4">

                <div class="row">
                    <div class="col-3">
                        <label for="link_video_youtube">Link video youtube</label>
                        <input type="text" class="form-control" id="link_video_youtube">
                    </div>
                </div>
                
                <div class="row mt-3">
                    @for($i=1; $i<=5;$i++)
                    <div class="col-2">

                        <div>
                            <p class="text-center">
                            @if($i==1) Imagen principal @else Imagen {{$i}} @endif
                            </p>
                        </div>

                        <div class="dropzone" style="text-align:center;">
                            <img src="{{asset('/storage/imagenes/publicaciones/default.png')}}" alt="" id="preview_imagen_{{$i}}">
                        </div>

                        <div
                        class="dropzone"
                        id="dropzone_imagen_{{$i}}" style="display:none;">
                        </div>

                        <div style="padding-top: 10px;">
                            <button class="btn btn-block btn-primary" onclick="$('#dropzone_imagen_{{$i}}').click()">
                                <i class="fa fa-camera"></i> Cargar foto
                            </button>
                        </div>

                        <input type="hidden" name="imagen_{{$i}}" id="imagen_{{$i}}" value="default.png">
                    </div>
                    @endfor
                </div>  

                <hr class="my-4 mt-5">

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-lg btn-primary" onclick="irPasoAnterior()">
                            <i class="fa fa-arrow-left"></i> Atrás
                        </button>

                        <button class="btn btn-lg btn-primary float-right"  onclick="irPasoSiguiente()">
                            Continuar <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div> 

            </div>
            
            <div class="jumbotron mt-3"  style="background-color: #fff;display: none;" id="paso_7">
                <h1 class="display-4">
                    Precio
                </h1>
                <hr class="my-4">

                <div class="row mt-5">
                    <div class="col-12">
                        <h4 style="color: #000;">Precio</h4>
                        <p>Ingrese la cantidad a ofertar y el precio total</p>
                    </div>

                    <div class="col-3">
                        <label for="cantidad">Cantidad <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="cantidad" value="100">
                    </div>

                    <div class="col-3">
                        <label for="precio">Precio total <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="precio" value="200">
                    </div>

                    <div class="col-3">
                        <label for="cantidad_minima">Cantidad miníma por compra</label>
                        <input type="text" class="form-control" id="cantidad_minima">
                    </div>
                </div>

                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <h4 style="color: #000;">Rangos de precios</h4>
                        <p>Aquí puede crear ragos de precios ejemplo: de 1 a 10 unidades $100</p>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" onclick="abrir_modal_agregar_rango()">
                            <i class="fa fa-plus"></i> Agregar rango
                        </button>
                    </div>

                    <div class="col-12 mt-2">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                    <th>Precio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="cuerpo_tabla_rangos_precios">

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <h4 style="color: #000;">Medios de Pago</h4>
                        <p>Seleccione los medios de pago <span class="text-danger">*</span></p>
                    </div>

                    @foreach($medios_de_pago as $medios_de_pago_obj)
                    <div class="col-3">
                        <p><input type="checkbox" id="medio_de_pago_{{$medios_de_pago_obj->id}}"> {{$medios_de_pago_obj->medio_de_pago}}</p>
                    </div>
                    @endforeach
                </div>

                <hr class="my-4 mt-5">

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-lg btn-primary" onclick="irPasoAnterior()">
                            <i class="fa fa-arrow-left"></i> Atrás
                        </button>

                        <button class="btn btn-lg btn-primary float-right"  onclick="irPasoSiguiente()">
                            Continuar <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>  

            </div>

            <div class="jumbotron mt-3"  style="background-color: #fff;display: none;" id="paso_8">
                <h1 class="display-4">
                    Alcance de la publicación
                </h1>
                <p class="lead">
                    Si su publicación solo será para algunas provincias y/o localidades, puede especificarlo aquí.
                </p>
                <hr class="my-4">

                <div class="row">
                    <div class="col-6">
                        <label for="">Alcanze de provincias</label>
                        <a href="javascript:void()" class="list-group-item list-group-item-action">
                            <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkout_provincia" checked>
                            <label class="form-check-label" for="checkout_provincia">&nbsp;&nbsp;&nbsp;Seleccionar Todas</label>
                            </div>
                        </a>

                        <div class="list-group mt-3" style="height: 300px;overflow-y: scroll;">

                        @foreach($provincias as $provincia_row)

                        <a href="javascript:viewProvincia({{$provincia_row->id}})" class="list-group-item list-group-item-action">
                            <div class="form-check">
                            <input type="checkbox" class="form-check-input" data-id-provincia="{{$provincia_row->id}}" id="checkout_provincia_{{$provincia_row->id}}" checked>
                            <label class="form-check-label" >&nbsp;&nbsp;&nbsp;{{$provincia_row->provincia}}</label>
                            </div>
                        </a>
                        @endforeach

                        </div>

                    </div>

                    <div class="col-6">

                        <label for="id_ciudad_alcanze">Alcanze de ciudad</label>

                        <a href="javascript:void()" class="list-group-item list-group-item-action">
                            <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkout_localidad" checked>
                            <label class="form-check-label" for="checkout_localidad">&nbsp;&nbsp;&nbsp;Seleccionar Todas</label>
                            </div>
                        </a>

                        <div class="list-group mt-3" style="height: 300px;overflow-y: scroll;" id="listado_localidades">

                        @foreach($localidades as $localidad_row)

                        <a href="javascript:void()" class="list-group-item list-group-item-action">
                            <div class="form-check">
                            <input type="checkbox" class="form-check-input" data-id-provincia="{{$localidad_row->id_provincia}}" data-id-localidad="{{$localidad_row->id}}" id="checkout_localidad_{{$localidad_row->id}}" onclick="cambioCheckoutLocalidad({{$localidad_row->id}})" checked>
                            <label class="form-check-label" >&nbsp;&nbsp;&nbsp;{{$localidad_row->localidad}}</label>
                            </div>
                        </a>
                        @endforeach

                        </div>

                    </div>
                </div>

                <hr class="my-4 mt-5">

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-lg btn-primary" onclick="irPasoAnterior()">
                            <i class="fa fa-arrow-left"></i> Atrás
                        </button>

                        <button class="btn btn-lg btn-primary float-right"  onclick="irPasoSiguiente()">
                            Continuar <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>  

            </div>




            <div class="jumbotron mt-3"  style="background-color: #fff;display: none;" id="paso_9">
                <h1 class="display-4">
                    Completá la información de tu producto
                </h1>
                <hr class="my-4">

                <div class="row">
                    

                    <div class="col-3">
                        <label for="id_tipo_operacion">Tipo de operación <span class="text-danger">*</span></label>
                        <select class="form-control" id="id_tipo_operacion">
                            <option value="">Seleccionar</option>
                            @foreach($tipos_operaciones as $tipo_operacion_obj)
                            <option value="{{$tipo_operacion_obj->id}}">{{$tipo_operacion_obj->tipo_operacion}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3">
                        <label for="id_garantia">Garantía <span class="text-danger">*</span></label>
                        <select class="form-control" id="id_garantia">
                            <option value="">Seleccionar</option>
                            @foreach($garantias as $garantia_obj)
                            <option value="{{$garantia_obj->id}}">{{$garantia_obj->garantia}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <h4 style="color: #000;">Vencimiento</h4>
                        <p>Si su publicación tendrá una fecha de vencimiento, por favor ingresala</p>
                    </div>

                    <div class="col-2">
                        <label for="fecha_vencimiento">Fecha vencimiento</label>
                        <input type="text" class="form-control datepicker" id="fecha_vencimiento" readonly="true" style="background-color: #fff;" value="">
                    </div>

                </div>

                <hr class="my-4 mt-5">

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-lg btn-primary" onclick="irPasoAnterior()">
                            <i class="fa fa-arrow-left"></i> Atrás
                        </button>

                        <button class="btn btn-lg btn-primary float-right"  onclick="irPasoSiguiente()">
                            Continuar <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>  

            </div>


            <div class="jumbotron mt-3"   style="background-color: #fff;display: none;" id="paso_10">
                <h1 class="display-4">
                    Elegí el tipo de exposición
                </h1>
                <hr class="my-4">

                <div class="row justify-content-center">
                    
                    @foreach($tipos_exposiciones as $tipo_exposicion_row)

                    <?php
                    $clase_color = "";

                    if($tipo_exposicion_row->id == 2)
                    {
                        $clase_color = "tipo_exposicion_verde";
                    }
                    else if($tipo_exposicion_row->id == 3)
                    {
                        $clase_color = "tipo_exposicion_rojo";
                    }
                    ?>
                    <div class="col-md-3">
                        <article class="card_plan <?php echo $clase_color?>" id="carta_tipo_exposicion_{{$tipo_exposicion_row->id}}">
                            <div class="card_plan__title">Exposición {{$tipo_exposicion_row->tipo_exposicion}}</div>
                                <div class="card_plan__header">
                                    <div class="precio">
                                    <h2>
                                        <span class="moneda">$</span>{{$tipo_exposicion_row->precio}}
                                    </h2>
                                </div>
                                <div class="total">
                                    @if($tipo_exposicion_row->precio == 0)
                                        Gratuita
                                    @else
                                        Paga
                                    @endif
                                </div>
                            </div>

                            <div class="card_plan__content" style="text-align: center;">
                                <button class="btn btn-lg btn-primary" onclick="seleccionarTipoExposicion({{$tipo_exposicion_row->id}})" id="seleccionar_tipo_exposicion_{{$tipo_exposicion_row->id}}">
                                    Seleccionar
                                </button> 
                            </div>

                        </article>
                    </div>

                    @endforeach

                </div>

                <hr class="my-4 mt-5">

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-lg btn-primary" onclick="irPasoAnterior()">
                            <i class="fa fa-arrow-left"></i> Atrás
                        </button>
                    </div>
                </div> 

                <div class="row mt-5">
                    <div class="col-12" style="text-align: center;">
                        <button class="btn btn-lg btn-primary" onclick="publicar()">
                            <i class="fa fa-check"></i> Publicar
                        </button>
                    </div>
                </div>

            </div>

           

        </div>
    </div>
</div>

@endsection

@section("modals")

<div class="modal" tabindex="-1" role="dialog" id="modal_agregar_rango">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar rango</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <div class="row">
            <div class="col-6">
                <label for="cantidad_desde_agregar_rango">Cantidad desde:<span class="text-danger">*</span></label>
                <input type="text" id="cantidad_desde_agregar_rango" class="form-control">
            </div>
            <div class="col-6">
                <label for="cantidad_hasta_agregar_rango">Cantidad hasta:<span class="text-danger">*</span></label>
                <input type="text" id="cantidad_hasta_agregar_rango" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <label for="precio_agregar_rango">Precio:<span class="text-danger">*</span></label>
                <input type="text" id="precio_agregar_rango" class="form-control">
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Cerrar
        </button>
        <button type="button" class="btn btn-primary" onclick="agregar_rango()">
            <i class="fa fa-check"></i> Aceptar
        </button>
      </div>
    </div>
  </div>
</div>

@endsection

@section("js_code")

<script src="{{asset('/assets/plugins/dropzone/dropzone.js')}}"></script>

<script>

var listado_ids_medios_de_pagos = new Array();

@foreach($medios_de_pago as $medios_de_pago_obj)
listado_ids_medios_de_pagos.push({{$medios_de_pago_obj->id}});
@endforeach


var id_tipo_publicacion= {{$id_tipo_publicacion}};
var tipo = "{{$tipo}};";

var id_tipo_exposicion = null;

// LISTADO DE LAS PROVINCIAS DONDE ESTÁ LA PUBLICACION
var provincias = new Array();
var localidades = new Array();

var listado_localidades_viendo = new Array();

var todas_provincias = new Array();

@foreach($provincias as $provincia_row)
    provincias.push({{$provincia_row->id}});
    todas_provincias.push({{$provincia_row->id}});
@endforeach

@foreach($localidades as $localidad_row)
    listado_localidades_viendo.push({
        "id": {{$localidad_row->id}},
        "id_provincia": {{$localidad_row->id_provincia}},
    });
@endforeach

var paso_actual = 0;

function irPasoAnterior()
{
    $("[id*=paso_]").css("display","none");
    paso_actual--;
    $("#paso_"+paso_actual).css("display","block");
}

function irPasoSiguiente()
{
    var proximo_paso = paso_actual + 1;
    
    if(validar_paso(proximo_paso) === true)
    {
        paso_actual = proximo_paso;

        $("[id*=paso_]").css("display","none");
        $("#paso_"+paso_actual).css("display","block");
    }
}

function validar_paso(proximo_paso)
{
    var mensajes_errores = new Array();

    switch(proximo_paso)
    {
        case 1:
            return true;
        break;

        case 2:
            var titulo = $.trim($("#titulo").val());

            if(titulo.length < 15 || titulo.length > 60)
            {
                mensajes_errores.push("El titulo debe tener 15 caracteres como minimo y 60 como máximo");
            }
        break;

        case 3:

            var descripcion = $.trim($("#descripcion").val());

            if(descripcion.length < 50)
            {
                mensajes_errores.push("La descripción debe tener 50 caracteres como minimo");
            }

        break;

        case 4:

            var id_categoria = $.trim($("#id_categoria").val());
            var id_subcategoria = $.trim($("#id_subcategoria").val());

            if(id_categoria == "" || isNaN(id_categoria) || id_categoria == 0)
            {
                mensajes_errores.push("Seleccione una Categoría");
            }

            if(id_subcategoria == "" || isNaN(id_subcategoria) || id_subcategoria == 0)
            {
                mensajes_errores.push("Seleccione una Subcategoría");
            }
        break;

        case 5:
        
            var marca = $.trim($("#marca").val());

            if(marca.length < 3)
            {
                mensajes_errores.push("La marca debe tener como minimo 3 caracteres");
            }

        break;

        case 6:

            var condicion = $.trim($("#condicion").val());

            if(condicion == "")
            {
                mensajes_errores.push("Seleccione la condición");
            }

        break;

        case 7:
        break;

        case 8:

            var precio = parseInt($.trim($("#precio").val()));
            var cantidad = parseInt($.trim($("#cantidad").val()));

            if(isNaN(cantidad) || cantidad < 1)
            {
                mensajes_errores.push("Ingrese una cantidad válida");
            }

            if(isNaN(precio) || precio < 1)
            {
                mensajes_errores.push("Ingrese un precio válido");
            }

            var validacion_medios_de_pago = false;

            for(var i=0; i < listado_ids_medios_de_pagos.length;i++)
            {
                if($("#medio_de_pago_"+listado_ids_medios_de_pagos[i]).prop("checked") === true)
                {
                    validacion_medios_de_pago = true;
                    break;
                }
            }

            if(validacion_medios_de_pago == false)
            {
                mensajes_errores.push("Debe seleccionar un medio de pago como mínimo");
            }

        break;

        case 9:
        break;

        case 10:

            var id_tipo_operacion = $.trim($("#id_tipo_operacion").val());
            var id_garantia = $.trim($("#id_garantia").val());

            if(id_tipo_operacion == "")
            {
                mensajes_errores.push("Seleccione el tipo de operación");
            }

            if(id_garantia == "")
            {
                mensajes_errores.push("Seleccione la garantía");
            }

        break;
    }

    

    if(mensajes_errores.length > 0)
    {
        mostrar_mensajes_errores(mensajes_errores);
        return false;
    }
    else
    {
        return true;
    }
}


function seleccionarTipoExposicion(id_exposicion)
{
    $("[id*=carta_tipo_exposicion_]").removeClass("card-seleccionada");
    $("[id*=seleccionar_tipo_exposicion_]").removeAttr("disabled");

    $("#carta_tipo_exposicion_"+id_exposicion).addClass("card-seleccionada");
    $("#seleccionar_tipo_exposicion_"+id_exposicion).attr("disabled",true);

    id_tipo_exposicion = id_exposicion;
}

function sacarLocalidadesProvincia(id_provincia)
{
    var nuevo_arreglo_localidades = new Array();

    for(var i=0; i < localidades.length;i++)
    {
        if(localidades[i]["id_provincia"] != id_provincia)
        {
            nuevo_arreglo_localidades.push(localidades[i]);
        }
    }

    localidades = nuevo_arreglo_localidades;
}

function selecLocalidadesSelecDeProvincia(id_provincia)
{
    $("[id*=checkout_localidad_]").prop("checked",false);

    var cantidad_encontradas = 0;

    for(var i=0; i < localidades.length;i++)
    {
        if(localidades[i]["id_provincia"] == id_provincia)
        {
            $("#checkout_localidad_"+localidades[i]["id"]).prop("checked",true);
            cantidad_encontradas++;
        }
    }

    if(cantidad_encontradas == 0)
    {
        $("[id*=checkout_localidad_]").prop("checked",true);
    }
}

$("#checkout_provincia").change(function(){

    var checked = $(this).prop("checked");

    if(checked)
    {
        provincias = todas_provincias;
        $("[id*=checkout_provincia_]").prop("checked",true);
        $("[id*=checkout_localidad_]").prop("checked",true);
        $("#checkout_localidad").prop("checked",true);

        localidades = new Array();
    }
    else
    {
        provincias = new Array();

        $("[id*=checkout_provincia_]").prop("checked",false);
        $("[id*=checkout_localidad_]").prop("checked",false);
        $("#checkout_localidad").prop("checked",false);
    }
});

$("[id*=checkout_provincia_]").change(function(){

    var poner = $(this).prop("checked");
    var id_provincia = $(this).attr("data-id-provincia");

    $.ajax({
        url: "{{url('/get_localidades_provincia')}}",
        type: "POST",
        data: {
            id_provincia:id_provincia
        },
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        beforeSend: function(e)
        {
            abrir_loading();
        },
        success: function(data)
        {
            cerrar_loading();

            try
            {
                if(data["response"] == true)
                {

                    $("#listado_localidades").html("");

                    for(var i=0; i < data["data"]["localidades"].length;i++)
                    {

                        $("#listado_localidades").append(
                            '<a href="javascript:void()" class="list-group-item list-group-item-action">'+
                              '<div class="form-check">'+
                              '<input type="checkbox" class="form-check-input" data-id-provincia="'+data["data"]["localidades"][i]["id_provincia"]+'" data-id-localidad="'+data["data"]["localidades"][i]["id"]+'" id="checkout_localidad_'+data["data"]["localidades"][i]["id"]+'" '+(poner ? 'checked' : '')+' onclick="cambioCheckoutLocalidad('+data["data"]["localidades"][i]["id"]+')">'+
                              '<label class="form-check-label" >&nbsp;&nbsp;&nbsp;'+data["data"]["localidades"][i]["localidad"]+'</label>'+
                              '</div>'+
                            '</a>'
                        );
                    }

                    listado_localidades_viendo = data["data"]["localidades"];

                    var posicion_busqueda = buscar_posicion_provincia(id_provincia);

                    if(poner)
                    {
                        ponerProvincia(id_provincia);
                        sacarLocalidadesDeProvincia(id_provincia);
                    }
                    else
                    {
                        if(posicion_busqueda >= 0)
                        {
                            sacarProvincia(id_provincia);
                            sacarLocalidadesDeProvincia(id_provincia);
                        }
                    }

                    // SACO LAS LOCALIDADES YA QUE NO VAN O SON TODAS
                    sacarLocalidadesProvincia(id_provincia);

                    $("#checkout_localidad").prop("checked",poner);

                }
                else
                {
                    mostrar_mensajes_errores(data["messages_errors"]);
                    $(this).prop("checked",!poner);
                }
            }
            catch(e)
            {
                mostrar_mensajes_errores();
                $(this).prop("checked",!poner);
            }
        },
        error: function(e)
        {
            cerrar_loading();
            mostrar_mensajes_errores();
            $(this).prop("checked",!poner);
        }
    });
});

function cambioCheckoutLocalidad(id_localidad)
{
    var id_provincia = $("#checkout_localidad_"+id_localidad).attr("data-id-provincia");

    var checked = $("#checkout_localidad_"+id_localidad).prop("checked");

    var posicion_encontrada = -1;

    for(var i=0; i < localidades.length;i++)
    {
        if(localidades[i]["id"] == id_localidad)
        {
            posicion_encontrada = i;
            break;
        }
    }

    if(checked)
    {
        if(posicion_encontrada != -1)
        {
            delete localidades[i];
            clean_arreglo_localidades();

            /*
            localidades.push({
                "id":id_localidad,
                "id_provincia":id_provincia
            });
            */
        }
    }
    else
    {
        if(posicion_encontrada == -1)
        {
            localidades.push({
                "id":id_localidad,
                "id_provincia":id_provincia
            });
        }

        var cantidad_localidades_sacadas = 0;

        for(var i=0; i < localidades.length;i++)
        {
            if(localidades[i]["id_provincia"] == id_provincia)
            {
                for(var j=0; j < listado_localidades_viendo.length;j++)
                {
                    if(listado_localidades_viendo[j]["id"] == localidades[i]["id"])
                    {
                        cantidad_localidades_sacadas++;
                    }
                }
            }
        }

        // DESELECCIONO LA PROVINCIA
        if(cantidad_localidades_sacadas == listado_localidades_viendo.length)
        {
            sacarProvincia(id_provincia);
            $("#checkout_provincia_"+id_provincia).prop("checked",false);
            $("#checkout_localidad").prop("checked",false);
        }
        else
        {
            ponerProvincia(id_provincia);

            $("#checkout_provincia_"+id_provincia).prop("checked",true);

            if(cantidad_localidades_sacadas == 0)
            {
                $("#checkout_localidad").prop("checked",true);
            }
        }
    }
}

function sacarProvincia(id_provincia)
{
    var posicion = -1;

    for(var i=0; i < provincias.length;i++)
    {
        if(provincias[i] == id_provincia)
        {
            posicion = i;
            break;
        }
    }

    if(posicion != -1)
    {
        delete provincias[posicion];
        clean_arreglo_provincias();
    }
}

function ponerProvincia(id_provincia)
{
    var posicion = -1;

    for(var i=0; i < provincias.length;i++)
    {
        if(provincias[i] == id_provincia)
        {
            posicion = i;
            break;
        }
    }

    if(posicion == -1)
    {
        provincias.push(id_provincia);
    }
}

$("#checkout_localidad").change(function(){

    var checkeado = $(this).prop("checked");

    // obtengo la provincia que está viendo
    if(listado_localidades_viendo.length > 0)
    {
        var id_provincia = listado_localidades_viendo[0]["id_provincia"];

        for(var i=0; i < localidades.length;i++)
        {
            if(localidades[i]["id_provincia"] == id_provincia)
            {
                delete localidades[i];
            }
        }

        clean_arreglo_localidades();

        $("#checkout_provincia_"+id_provincia).prop("checked",checkeado);
        $("[id*=checkout_localidad_]").prop("checked",checkeado);
        ponerProvincia(id_provincia);
    }

});

function viewProvincia(id_provincia)
{
    $.ajax({
        url: "{{url('/get_localidades_provincia')}}",
        type: "POST",
        data: {
            id_provincia:id_provincia
        },
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        beforeSend: function(e)
        {
            abrir_loading();
        },
        success: function(data)
        {
            cerrar_loading();

            try
            {
                if(data["response"] == true)
                {

                    $("#listado_localidades").html("");

                    for(var i=0; i < data["data"]["localidades"].length;i++)
                    {

                        $("#listado_localidades").append(
                            '<a href="javascript:void()" class="list-group-item list-group-item-action">'+
                            '<div class="form-check">'+
                            '<input type="checkbox" class="form-check-input" data-id-provincia="'+data["data"]["localidades"][i]["id_provincia"]+'" data-id-localidad="'+data["data"]["localidades"][i]["id"]+'" id="checkout_localidad_'+data["data"]["localidades"][i]["id"]+'" onclick="cambioCheckoutLocalidad('+data["data"]["localidades"][i]["id"]+')">'+
                            '<label class="form-check-label" >&nbsp;&nbsp;&nbsp;'+data["data"]["localidades"][i]["localidad"]+'</label>'+
                            '</div>'+
                            '</a>'
                        );
                    }

                    listado_localidades_viendo = data["data"]["localidades"];

                    selecLocalidadesSelecDeProvincia(id_provincia);
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
        error: function(e)
        {
            cerrar_loading();
            mostrar_mensajes_errores();
        }
    });
}

function buscar_posicion_provincia(id_provincia)
{
    var posicion = -1;

    for(var i=0; i < provincias.length;i++)
    {
        if(provincias[i] == id_provincia)
        {
            posicion = i;
            break;
        }
    }

    return posicion;
}

function sacarLocalidadesDeProvincia(id_provincia)
{
    for(var i=0; i < localidades.length;i++)
    {
        if(localidades[i]["id_provincia"] == id_provincia)
        {
            delete localidades[i];
        }
    }

    clean_arreglo_localidades();
}

function clean_arreglo_provincias()
{
    var aux_copia = new Array();

    for(var i=0; i < provincias.length;i++)
    {
        if(provincias[i] != undefined)
        {
            aux_copia.push(provincias[i]);
        }
    }

    provincias = aux_copia;
}

function clean_arreglo_localidades()
{
    var aux_copia = new Array();

    for(var i=0; i < localidades.length;i++)
    {
        if(localidades[i] != undefined)
        {
            aux_copia.push(localidades[i]);
        }
    }

    localidades= aux_copia;
}

var rangos_precios = new Array();

var colores = new Array();

$(document).ready(function(){

    $("#id_categoria").select2();
    $("#id_subcategoria").select2();
    $("#id_provincia_alcanze").select2();
    $("#id_ciudad_alcanze").select2();

    $("#colores").select2({
      templateResult: function (data, container) {
          console.log($(data.element).attr("value")+"-"+$(data.element).text());

          var $result = $('<div class="ps-variant ps-variant--color color--'+($(data.element).attr("value"))+'" ><span class="ps-variant__tooltip"></span></div> <span>'+data.text+'</span>');
          return $result;
      }
    });

    irPasoSiguiente();
});

$("#id_categoria").change(function(){

    var id_categoria = parseInt($(this).val());

    if(!isNaN(id_categoria) || id_categoria > 0 || id_categoria != "")
    {
        $.ajax({
            url: "{{url('/publicaciones/subcategorias/get_subcategorias_de_categoria')}}",
            type: "POST",
            data: {
                id_categoria:id_categoria
            },
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            beforeSend: function(e)
            {
                abrir_loading();
            },
            success: function(data)
            {
                cerrar_loading();

                try
                {
                    $("#id_subcategoria").html('<option value="">Seleccionar</option>');

                    for(var i=0; i < data.length;i++)
                    {
                        $("#id_subcategoria").append('<option value="'+data[i]["id"]+'">'+data[i]["nombre"]+'</option>');
                    }

                    $("#id_subcategoria").val("");

                    $("#id_subcategoria").attr("disabled",false);
                    $("#id_subcategoria").trigger("change");
                }
                catch(e)
                {
                    mostrar_mensajes_errores();
                }
            },
            error: function(e)
            {
                cerrar_loading();
                mostrar_mensajes_errores();
            }
        });
    }
    else
    {
        $("#id_subcategoria").html('<option value="">Seleccionar</option>');
        $("#id_subcategoria").val("");
        $("#id_subcategoria").attr("disabled",true);
    }
});

$("#id_provincia_alcanze").change(function(){

    var id_provincia = $(this).val();

    if(!isNaN(id_provincia) || id_provincia > 0 || id_provincia != "")
    {
        $.ajax({
            url: "{{url('/get_localidades_provincia')}}",
            type: "POST",
            data: {
                id_provincia:id_provincia
            },
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            beforeSend: function(e)
            {
                abrir_loading();
            },
            success: function(data)
            {
                cerrar_loading();

                try
                {
                    if(data["response"] == true)
                    {
                        $("#id_ciudad_alcanze").html('<option value="">Todas</option>');

                        for(var i=0; i < data["data"]["localidades"].length;i++)
                        {
                            $("#id_ciudad_alcanze").append('<option value="'+data["data"]["localidades"][i]["id"]+'">'+data["data"]["localidades"][i]["localidad"]+'</option>');
                        }

                        $("#id_ciudad_alcanze").val("");

                        $("#id_ciudad_alcanze").attr("disabled",false);
                        $("#id_ciudad_alcanze").trigger("change");
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
            error: function(e)
            {
                cerrar_loading();
                mostrar_mensajes_errores();
            }
        });
    }
    else
    {
        $("#id_ciudad_alcanze").html('<option value="">Todas</option>');
        $("#id_ciudad_alcanze").val("");
        $("#id_ciudad_alcanze").attr("disabled",true);
    }

});

function abrir_modal_agregar_rango()
{
    $("#cantidad_desde_agregar_rango").val("");
    $("#cantidad_hasta_agregar_rango").val("");
    $("#precio_agregar_rango").val("");

    $("#modal_agregar_rango").modal("show");
}

function agregar_rango()
{
    var cantidad_desde = parseInt($("#cantidad_desde_agregar_rango").val());
    var cantidad_hasta = parseInt($("#cantidad_hasta_agregar_rango").val());
    var precio = parseFloat($("#precio_agregar_rango").val());

    var mensajes_errores = new Array();

    if(isNaN(cantidad_desde) || cantidad_desde == "" || cantidad_desde <= 0)
    {
        mensajes_errores.push("Ingrese un valor de cantidad desde correcto");
    }

    if(isNaN(cantidad_hasta) || cantidad_hasta == "" || cantidad_hasta <= 0)
    {
        mensajes_errores.push("Ingrese un valor de cantidad hasta correcto");
    }

    if(isNaN(precio) || precio == "" || precio <= 0)
    {
        mensajes_errores.push("Ingrese un valor de precio correcto");
    }

    if(mensajes_errores.length == 0)
    {
        if(cantidad_desde > cantidad_hasta)
        {
            mensajes_errores.push("La cantidad desde no puede ser mayor a la cantidad hasta");
        }
    }

    if(mensajes_errores.length == 0)
    {
        rangos_precios.push({
            cantidad_desde:cantidad_desde,
            cantidad_hasta:cantidad_hasta,
            precio:precio
        });

        $("#modal_agregar_rango").modal("hide");

        actualizar_tabla_rangos_precios();
    }
    else
    {
        mostrar_mensajes_errores(mensajes_errores);
    }
}

function actualizar_tabla_rangos_precios()
{
    $("#cuerpo_tabla_rangos_precios").html("");

    for(var i=0; i < rangos_precios.length;i++)
    {
        $("#cuerpo_tabla_rangos_precios").append(
            "<tr>"+
                "<td>"+rangos_precios[i]["cantidad_desde"]+"</td>"+
                "<td>"+rangos_precios[i]["cantidad_hasta"]+"</td>"+
                "<td>$ "+rangos_precios[i]["precio"]+"</td>"+
                "<td>"+
                    "<button class='btn btn-lg btn-danger' onclick='eliminar_rango_precio("+i+")'>"+
                        "<i class='fa fa-trash'></i>"+
                    "</button>"+
                "</td>"+
            "</tr>"
        );
    }
}

function eliminar_rango_precio(posicion_array)
{
    swal({
        title: "Eliminar rango",
        text: "¿Está seguro desea eliminar el rango seleccionado?",
        type: 'error',
        buttons:{
            confirm: {
                text : "Eliminar",
                className : "btn btn-danger",
            },
            cancel: {
                visible: true,
                text : "Cancelar",
                className: "btn btn-secondary",
            }
        }
    }).then((Delete) => {
        if (Delete) {

            delete rangos_precios[posicion_array];

            limpiar_arreglo_rangos();
            actualizar_tabla_rangos_precios();

        } else {
            swal.close();
        }
    });
}

function limpiar_arreglo_rangos()
{
    var nuevo_arreglo = new Array();

    for(var i=0; i < rangos_precios.length;i++)
    {
        if(rangos_precios[i] != undefined)
        {
            nuevo_arreglo.push(rangos_precios[i]);
        }
    }

    rangos_precios = nuevo_arreglo;
}

</script>

<script>

@for($i=1; $i <= 5;$i++)
$("#dropzone_imagen_{{$i}}").dropzone({
    autoProcessQueue: true,
    url: "{{url('/upload_imagen_publicacion')}}",
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

                        $("#preview_imagen_{{$i}}").attr("src","{{asset('/storage/imagenes/publicaciones')}}/"+file_name);
                        $("[name=imagen_{{$i}}]").val(file_name);
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

@endfor

function publicar()
{
    if(id_tipo_exposicion == null || id_tipo_exposicion < 1)
    {
        mostrar_mensajes_errores(["Seleccione el tipo de exposición"]);
    }
    else
    {
        var formdata = new FormData();

        formdata.append("titulo",$("#titulo").val());
        formdata.append("descripcion",$("#descripcion").val());
        formdata.append("cantidad",$("#cantidad").val());
        formdata.append("cantidad_minima",$("#cantidad_minima").val());
        formdata.append("precio",$("#precio").val());
        formdata.append("id_categoria",$("#id_categoria").val());
        formdata.append("id_subcategoria",$("#id_subcategoria").val());
        formdata.append("id_tipo_operacion",$("#id_tipo_operacion").val());
        formdata.append("id_tipo_exposicion",id_tipo_exposicion);
        formdata.append("id_garantia",$("#id_garantia").val());
        formdata.append("link_video_youtube",$("#link_video_youtube").val());
        formdata.append("modelo",$("#modelo").val());
        formdata.append("marca",$("#marca").val());
        formdata.append("version",$("#version").val());
        formdata.append("colores",$("#colores").val());
        formdata.append("id_genero",$("#id_genero").val());
        formdata.append("condicion",$("#condicion").val());
        formdata.append("tipo",$("#tipo").val());
        formdata.append("id_provincia_alcanze",$("#id_provincia_alcanze").val());
        formdata.append("id_ciudad_alcanze",$("#id_ciudad_alcanze").val());
        formdata.append("fecha_vencimiento",$("#fecha_vencimiento").val());
        formdata.append("id_tipo_publicacion",id_tipo_publicacion);
        formdata.append("tipo",tipo);


        formdata.append("imagen_1",$("#imagen_1").val());
        formdata.append("imagen_2",$("#imagen_2").val());
        formdata.append("imagen_3",$("#imagen_3").val());
        formdata.append("imagen_4",$("#imagen_4").val());
        formdata.append("imagen_5",$("#imagen_5").val());

        formdata.append("rangos_precios",JSON.stringify(rangos_precios));
        formdata.append("provincias",JSON.stringify(provincias));
        formdata.append("localidades",JSON.stringify(localidades));

        var medios_de_pagos = new Array();

        @foreach($medios_de_pago as $medios_de_pago_obj)

        if($("#medio_de_pago_{{$medios_de_pago_obj->id}}").prop("checked") === true)
        {
            medios_de_pagos.push({{$medios_de_pago_obj->id}});
        }
    
        @endforeach

        formdata.append("medios_de_pagos",JSON.stringify(medios_de_pagos));

        $.ajax({
            url: "{{url('/publicaciones/agregar_publicacion_oferta')}}",
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
                        if(id_tipo_exposicion == 1)
                        {
                            mostrar_mensajes_success("Publicado!","Se ha realizado su publicación correctamente!",data["data"]["url_publicacion"]);
                        }
                        else
                        {
                            mostrar_mensajes_success("Publicado!","Se ha realizado su publicación correctamente, te enviaremos a MercadoPago!","{{url('/mp/pagar')}}/"+data["data"]["id_publicacion"]);
                        }
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
}

</script>

@endsection
