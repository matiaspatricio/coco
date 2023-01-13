@extends('frontend.template.master')

@section('title', 'Publicar')

@section("style")

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

    <div class="container" id="contenedor_pregunta_1" style="display: block;">

      <div class="jumbotron">
        <h1 class="display-4">¿Que tipo de publicación va a realizar?</h1>
        <p class="lead">
          Selecciona que tipo de publicación vas a realizar, puede ser una <strong>oferta (quieres vender algo)</strong> o una <strong>demanda (estás buscando comprar algo al mejor precio/calidad)</strong>
        </p>
        <hr class="my-4">
        <div class="row justify-content-center">
            <div class="col-md-3" style="text-align: center;">
                <div class="ps-block--category">
                    <img src="{{asset('/assets/img/publicaciones/oferta.svg')}}" alt="">
                    <p>Oferta</p>

                </div>
                <a class="btn btn-primary btn-lg" href="{{url('/publicaciones/publicar/oferta')}}" role="button">Seleccionar</a>
            </div>
            <div class="col-md-3" style="text-align: center;">
                <div class="ps-block--category">
                    <img src="{{asset('/assets/img/publicaciones/demanda.svg')}}" alt="">
                    <p>Demanda</p>
                </div>
                <a class="btn btn-primary btn-lg" href="{{url('/publicaciones/publicar/demanda')}}" role="button">Seleccionar</a>
            </div>
        </div>

      </div>
    </div>




</div>

@endsection

@section("modals")

@endsection

@section("js_code")

@endsection
