@extends('frontend.template.master')

@section('title', 'Listado de categorías')

@section('contenido')

<div class="ps-page--shop" id="shop-categories" style="padding-top: 50px;">
    <div class="container">
       
        @foreach($categorias as $categoria_row)
        <div class="ps-product-list ps-product-list--2" >
            <div class="ps-section__header">
                <h3>{{$categoria_row->nombre}}</h3>
            </div>
            <div class="ps-section__content">
                <?php
                
                $subcategorias = $categoria_row->get_subcategorias_activas;
                ?>

                <div class="row">
                    @foreach($subcategorias as $subcategoria_row)
                        <div class="col-md-3">
                            <a href="{{url('/buscar?id_subcategoria='.$subcategoria_row->id)}}">{{$subcategoria_row->nombre}}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>






@endsection

@section("js_code")

@endsection