<div class="ps-deal-of-day">
    <div class="container">

        <div class="ps-section__header">
            <div class="ps-block--countdown-deal">
                <div class="ps-block__left">
                <h3>Últimas Publicaciones</h3>
                </div>
            </div>
            <!--<a href="shop-default.html">Ver Todo</a>-->
        </div>

        <div class="ps-section__content">

            <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                
                @foreach($ultimas_publicaciones as $ultima_publicacion_obj)
                <div class="ps-product ps-product--inner">
                    <div class="ps-product__thumbnail">
                        <a href="{{$ultima_publicacion_obj->get_url()}}">
                            <img src="{{ asset('/storage/imagenes/publicaciones/'.$ultima_publicacion_obj->imagen_principal)}}" alt="">
                        </a>
                    </div>
                    <div class="ps-product__container">
                        <p class="ps-product__price sale">
                            @if($ultima_publicacion_obj->precio_desde == $ultima_publicacion_obj->precio_hasta)
                            ${{$ultima_publicacion_obj->precio_desde}}
                            @else
                            ${{$ultima_publicacion_obj->precio_desde}} -  ${{$ultima_publicacion_obj->precio_desde}}
                            @endif
                        </p>
                        <div class="ps-product__content">
                            <a class="ps-product__title" href="{{$ultima_publicacion_obj->get_url()}}">
                                {{$ultima_publicacion_obj->titulo}}
                            </a>
                        </div>
                    </div>
                </div> 
                @endforeach

            </div>
        </div>
    </div>
</div>