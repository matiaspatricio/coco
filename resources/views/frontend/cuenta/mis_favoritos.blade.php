@extends('frontend.template.master')

@section('title', 'Mis Favoritos')

@section('contenido')

<div class="ps-page--my-account mb-3">
    <div class="ps-breadcrumb">
        <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Inicio</a></li>
            <li>Mis Favoritos</li>
        </ul>
        </div>
    </div>
    
    <div class="ps-my-account">
        <div class="container">
            
            <form action="" id="formulario_mi_cuenta">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">Mis Favoritos</h2>
                        <div class="card">
                            <div class="card-body">
                                
                                <div class="row mt-5 mb-5">

                                @foreach($favoritos_publicaciones as $favorito_publicacion)
                                <?php
                                $publicacion_obj = \App\Publicacion::find($favorito_publicacion->id_publicacion);
                                ?>
                                <div class="col-md-4 mt-3">
                                    <div class="ps-product">
                                        <div class="ps-product__thumbnail">
                                            <a href="{{$publicacion_obj->get_url()}}">
                                            <img src="{{ asset('/storage/imagenes/publicaciones/'.$publicacion_obj->imagen_principal) }}" alt=""/>
                                            </a>
                                        </div>
                                        <div class="ps-product__container">
                                            <a class="ps-product__title" href="{{$publicacion_obj->get_url()}}">
                                                {{$publicacion_obj->titulo}}
                                            </a>
                                            <p class="ps-product__price">
                                            @if($publicacion_obj->precio_desde != $publicacion_obj->precio_hasta)
                                                ${{number_format($publicacion_obj->precio_desde,2,",",".")}} – ${{number_format($publicacion_obj->precio_hasta,2,",",".")}}
                                            @else
                                                ${{number_format($publicacion_obj->precio_desde,2,",",".")}}
                                            @endif
                                            </p>
                                            <div class="ps-product__content hover">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                                </div>

                                <div class="row">
                                    <div class="col-md-12" style="text-align: center;">
                                        {{ $favoritos_publicaciones->links('frontend.template.default_pagination') }}
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section("js_code")

<script>
    
</script>

@endsection