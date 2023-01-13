@extends('frontend.template.master')

@section('title', 'Publicar')

@section("style")

<link rel="stylesheet" href="{{asset('/assets/plugins/dropzone/dropzone.min.css')}}">    

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
       
        
        <div class="ps-product-list ps-product-list--2" >
            <div class="ps-section__header">
                <h3>Ingresar</h3>
            </div>
            <div class="ps-section__content">
                <div class="row">
                    <div class="col-md-12">
                        <p>Para poder realizar una publicación necesita tener una cuenta, si ya tiene una puede <a href="{{url('/ingresar')}}"><strong>iniciar sesion</strong></a>, sino puede <a href="{{url('/registrarse')}}"><strong>crear una cuenta</strong></a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection

@section("js_code")


<script>
</script>

@endsection