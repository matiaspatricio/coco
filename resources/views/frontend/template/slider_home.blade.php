@if($slider_home)
<div class="ps-home-banner">
    <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on" data-owl-animate-in="fadeIn" data-owl-animate-out="fadeOut">
        
        <?php
        // FIX FOR PLUGIN
        if(count($slider_home) == 1)
        {
            $slider_home[] = $slider_home[0];
        }

        ?>

        @foreach($slider_home as $slider_home_row)
        <div class="ps-banner--technology" data-background="{{asset('/storage/imagenes/slider_home/'.$slider_home_row->imagen)}}">
            <img src="{{asset('/storage/imagenes/slider_home/'.$slider_home_row->imagen)}}" alt="">
            <div class="ps-banner__content">
                <h4>{{$slider_home_row->small_title}}</h4>
                <h3>{{$slider_home_row->title}}</h3>
                
                @if(trim($slider_home_row->link_button) != "" && filter_var($slider_home_row->link_button, FILTER_VALIDATE_URL))
                    <a class="ps-btn" href="{{$slider_home_row->link_button}}">Ver</a>
                @endif
                
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif