@extends('frontend.template.master')

@section('title', 'Mis Publicaciones')

@section('contenido')

<div class="ps-page--my-account mb-3">
    <div class="ps-breadcrumb">
        <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Inicio</a></li>
            <li>Mis Publicaciones</li>
        </ul>
        </div>
    </div>
    
    <div class="ps-my-account">
        <div class="container">
            
            <form action="" id="formulario_mi_cuenta">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">Mis Publicaciones</h2>
                        <div class="card">
                            <div class="card-body">
                                
                                <div class="row mt-5 mb-5">

                                @foreach($mis_publicaciones as $publicacion_obj)
                                <div class="col-md-3 mt-3">
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
                                            <div>
                                                <button class="btn btn-block btn-primary">
                                                    <i class="fa fa-edit"></i> Editar
                                                </button>
                                                <button class="btn btn-block btn-danger">
                                                    <i class="fa fa-trash-o"></i> Eliminar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                                </div>

                                <div class="row">
                                    <div class="col-md-12" style="text-align: center;">
                                        {{ $mis_publicaciones->links('frontend.template.default_pagination') }}
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