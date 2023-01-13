@extends('frontend.template.master')

@section('title', 'Seleccionar tipo de publicación')

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

    <div class="container" id="contenedor_pregunta_2">

      <div class="jumbotron">
        <h1 class="display-4">¿Va a @if($id_tipo_publicacion == "demanda") demandar @else ofertar @endif un <strong>producto</strong> o un <strong>servicio</strong>?</h1>
        <hr class="my-4">
        <div class="row justify-content-center">
            <div class="col-md-3" style="text-align: center">
              <div class="card" style="padding-left: 15px;padding-right: 15px;">
                <img src="{{asset('/assets/img/publicaciones/tipo_producto.svg')}}" class="card-img-top" alt="">
                <div class="card-body">
                  <h5 class="card-title">Producto</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="{{url('/publicaciones/publicar/'.$nombre_tipo_publicacion.'/bienes')}}" class="btn btn-primary">Seleccionar</a>
                </div>
              </div>

            </div>
            <div class="col-md-3" style="text-align: center">

                <div class="card" style="padding-left: 15px;padding-right: 15px;">
                  <img src="{{asset('/assets/img/publicaciones/tipo_servicio.svg')}}" class="card-img-top" alt="">
                  <div class="card-body">
                    <h5 class="card-title">Servicio</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="{{url('/publicaciones/publicar/'.$nombre_tipo_publicacion.'/servicios')}}" class="btn btn-primary">Seleccionar</a>
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

@endsection
