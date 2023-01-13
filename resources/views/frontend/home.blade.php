@extends('frontend.template.master')

@section('title', 'Inicio')


@section('contenido')

<div id="homepage-10">

    @component('frontend.template.slider_home',["slider_home"=>$slider_home])
    @endcomponent
	  
    <div class="ps-site-features">
    <div class="container">
        <div class="ps-block--site-features ps-block--site-features-2">
        <div class="ps-block__item">
            <div class="ps-block__left"><i class="icon-rocket"></i></div>
            <div class="ps-block__right">
            <h4>Entregas rápidas</h4>
            <p>Envios economicos en tus compras</p>
            </div>
        </div>
        <div class="ps-block__item">
            <div class="ps-block__left"><i class="icon-credit-card"></i></div>
            <div class="ps-block__right">
            <h4>Pago seguro</h4>
            <p>Pago 100% seguro</p>
            </div>
        </div>
        <div class="ps-block__item">
            <div class="ps-block__left"><i class="icon-bubbles"></i></div>
            <div class="ps-block__right">
            <h4>Soporte online</h4>
            <p>Dejanos tu inquietud</p>
            </div>
        </div>
        </div>
    </div>
    </div>

    @include('frontend.template.publicaciones_mas_vistas',["publicaciones_mas_vistas"=>$publicaciones_mas_vistas])

    @include('frontend.template.ultimas_publicaciones',["ultimas_publicaciones"=>$ultimas_publicaciones])
    
@endsection