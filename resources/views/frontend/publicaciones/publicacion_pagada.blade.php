@extends('frontend.template.master')

@section('title', 'Publicación pagada!')

@section('contenido')

<div class="ps-page--shop" id="shop-categories" style="padding-top: 50px;">
    <div class="container">
        
        <div class="ps-product-list ps-product-list--2" >
            <div class="ps-section__header">
                <h3>Publicación pagada!</h3>
            </div>
            <div class="ps-section__content">
                <div class="row">
                    <div class="col-md-12">
                        <p>La publicación ha sido pagada correctamente!</p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12" style="text-align: center;">
                        <h3>{{$publicacion_obj->titulo}}</h3>
                    </div>
                    <?php 
                    $imagenes = $publicacion_obj->get_imagenes;
                    ?>
                    @if(count($imagenes))
                    <div class="col-md-12" style="text-align: center;">
                        <a href="{{$publicacion_obj->get_url()}}"><img src="{{ asset('/storage/imagenes/publicaciones/'.$imagenes[0]->file_name) }}" alt="" width="200"></a>
                    </div>
                    @endif
                    <div class="col-md-12" style="text-align: center;">
                        <a href="{{$publicacion_obj->get_url()}}" class="btn btn-lg btn-primary">
                            Ver Publicación
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






@endsection

@section("js_code")

@endsection