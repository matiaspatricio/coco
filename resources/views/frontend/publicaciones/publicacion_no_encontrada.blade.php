@extends('frontend.template.master')

@section('title', 'Publicación no encontrada')

@section("style")

@endsection

@section('contenido')
<div class="ps-breadcrumb">
    <div class="ps-container">
    <ul class="breadcrumb">
        <li><a href="{{url('/')}}">Inicio</a></li>
        <li>Publicación no encontrada</li>
    </ul>
    </div>
</div>

<div class="ps-page--shop" id="shop-categories" style="padding-top: 50px;">

    <div class="container" id="contenedor_pregunta_1" style="display: block;">

      <div class="jumbotron">
        <h1 class="display-4">Publicación no encontrada</h1>
        <hr class="my-4">
        <div class="row justify-content-center">
            <div class="col-md-6" style="text-align: center;">
                <h4 class="display-4">Lo sentimos, la publicación a la que desea acceder ya no se encuentra disponible</h4>
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
