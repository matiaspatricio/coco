<div class="ps-deal-of-day">
    <div class="container">

        <div class="ps-section__header">
            <div class="ps-block--countdown-deal">
                <div class="ps-block__left">
                <h3>Publicaciones más vistas</h3>
                </div>
            </div>
            <!--<a href="shop-default.html">Ver Todo</a>-->
        </div>

        <div class="ps-section__content">

            <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                
                @foreach($publicaciones_mas_vistas as $publicacion_mas_vista_obj)
                <div class="ps-product ps-product--inner">
                    <div class="ps-product__thumbnail">
                        <a href="{{$publicacion_mas_vista_obj->get_url()}}">
                            <img src="{{ asset('/storage/imagenes/publicaciones/'.$publicacion_mas_vista_obj->imagen_principal)}}" alt="">
                        </a>
                    </div>
                    <div class="ps-product__container">
                        <p class="ps-product__price sale">
                            @if($publicacion_mas_vista_obj->precio_desde == $publicacion_mas_vista_obj->precio_hasta)
                            ${{$publicacion_mas_vista_obj->precio_desde}}
                            @else
                            ${{$publicacion_mas_vista_obj->precio_desde}} -  ${{$publicacion_mas_vista_obj->precio_desde}}
                            @endif
                        </p>
                        <div class="ps-product__content">
                            <a class="ps-product__title" href="{{$publicacion_mas_vista_obj->get_url()}}">
                                {{$publicacion_mas_vista_obj->titulo}}
                            </a>
                        </div>
                    </div>
                </div> 
                @endforeach
            </div>
        </div>
    </div>
</div>