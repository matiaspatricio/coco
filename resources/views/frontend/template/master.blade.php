<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
	  <meta name="csrf-token" content="<?php echo csrf_token() ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!--link(href="apple-touch-icon.png" rel="apple-touch-icon")-->
    <!--link(href="favicon.png" rel="icon" )-->
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>@yield('title') - {{Config("app.name")}}</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/Linearicons/Linearicons/Font/demo-files/demo.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap4/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl-carousel/assets/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/lightGallery-master/dist/css/lightgallery.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/technology.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom_css.css')}}">


    <link rel="stylesheet" href="{{ asset('/assets/plugins/datetimepicker/jquery.datetimepicker.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
	  @section("style")
    @show

  </head>
  <body>
	@include("frontend.template.header_top_desktop")
	
	@include("frontend.template.header_top_mobile")
	
	<!--

	COMENTADO POR EL MOMENTO HASTA SABER QUE ES

    <div class="ps-panel--sidebar" id="cart-mobile">
      <div class="ps-panel__header">
        <h3>Shopping Cart</h3>
      </div>
      <div class="navigation__content">
        <div class="ps-cart--mobile">
          <div class="ps-cart__content">
            <div class="ps-product--cart-mobile">
              <div class="ps-product__thumbnail"><a href="#"><img src="{{ asset('assets/img/products/clothing/7.jpg')}}" alt=""></a></div>
              <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                <p><strong>Sold by:</strong>  YOUNG SHOP</p><small>1 x $59.99</small>
              </div>
            </div>
          </div>
          <div class="ps-cart__footer">
            <h3>Sub Total:<strong>$59.99</strong></h3>
            <figure><a class="ps-btn" href="shopping-cart.html">View Cart</a><a class="ps-btn" href="checkout.html">Checkout</a></figure>
          </div>
        </div>
      </div>
	</div>
	-->
	
	@include("frontend.template.menu_mobile")
	
	<div>
	@section("contenido")

	@show
	</div>
      <footer class="ps-footer ps-footer--2 ps-footer--technology" >
        <div class="container">
          <div class="ps-footer__content">
            <div class="row">
              <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                <aside class="widget widget_footer">
                  <h4 class="widget-title">Enlaces rápidos</h4>
                  <ul class="ps-list--link">
                    <li><a href="{{url('/politica')}}">Política</a></li>
                    <li><a href="{{url('/terminos_y_condiciones')}}">Términos y condiciónes</a></li>
                    <li><a href="{{url('/envios')}}">Envíos</a></li>
                    <li><a href="{{url('/devoluciones')}}">Devoluciones</a></li>
                    <li><a href="{{url('/preguntas_frecuentes')}}">Preguntas Frecuentes</a></li>
                  </ul>
                </aside>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                <aside class="widget widget_footer">
                  <h4 class="widget-title">Empresa</h4>
                  <ul class="ps-list--link">
                    <li><a href="{{url('/sobre_nosotros')}}">Sobre nosotros</a></li>
                    <li><a href="{{url('/afiliate')}}">Afiliate</a></li>
                    <li><a href="{{url('/carrera')}}">Carrera</a></li>
                    <li><a href="{{url('/contacto')}}">Contacto</a></li>
                  </ul>
                </aside>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
                <aside class="widget widget_footer">
                  <h4 class="widget-title">Negocios</h4>
                  <ul class="ps-list--link">
                    <li><a href="{{url('/nuestra_prensa')}}">Nuestra prensa</a></li>
                    <li><a href="{{url('/revisa')}}">Revisa</a></li>
                    @if(session("ingreso_frontend") === true)
                    <li><a href="{{url('/cuenta/mi_cuenta')}}">Mi cuenta</a></li>
                    @endif
                    <li><a href="{{url('/tienda')}}">Tienda</a></li>
                  </ul>
                </aside>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 ">
                <aside class="widget widget_newletters widget_footer">
                  <h4 class="widget-title">Newsletter</h4>
                  <p>Regístrese ahora para recibir actualizaciones sobre promociones y cupones</p>
                  <form class="ps-form--newletter" action="#" method="post" id="formulario_newletter">
                    <div class="form-group--nest">
                      <input class="form-control" type="text" name="correo" placeholder="Correo">
                      <button class="ps-btn">Suscribir</button>
                    </div>
                    <ul class="ps-list--social">
                      <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                      <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                      <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                      <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                  </form>
                </aside>
              </div>
            </div>
          </div>
          <div class="ps-footer__copyright">
            <p>© {{Date("Y")}} {{Config("app.name")}}. Todos los Derechos Reservados</p>
            <p><span>Metodos de pago:</span><a href="#"><img src="{{ asset('assets/img/payment-method/1.jpg')}}" alt=""></a><a href="#"><img src="img/payment-method/2.jpg" alt=""></a><a href="#"><img src="img/payment-method/3.jpg" alt=""></a><a href="#"><img src="img/payment-method/4.jpg" alt=""></a><a href="#"><img src="img/payment-method/5.jpg" alt=""></a></p>
			</div>
        </div>
      </footer>
      
    </div>
    <div id="back2top"><i class="pe-7s-angle-up"></i></div>
    <div class="ps-site-overlay"></div>
    <div id="loader-wrapper">
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
    <div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
      <div class="ps-search__content">
        <form class="ps-form--primary-search" action="do_action" method="post">
          <input class="form-control" type="text" placeholder="Buscar">
          <button><i class="aroma-magnifying-glass"></i></button>
        </form>
      </div>
  </div>

  <!--include shared/cart-sidebar-->
  <!-- Plugins-->
  <script src="{{ asset('assets/plugins/jquery-1.12.4.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="{{ asset('assets/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap4/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/imagesloaded.pkgd.js') }}"></script>
  <script src="{{ asset('assets/plugins/masonry.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.matchHeight-min.js') }}"></script>
  <script src="{{ asset('assets/plugins/slick/slick/slick.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/slick-animation.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/lightGallery-master/dist/js/lightgallery-all.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/sticky-sidebar/dist/sticky-sidebar.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/gmap3.min.js') }}"></script>
  <!-- Custom scripts-->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxflHHc5FlDVI-J71pO7hM1QJNW1dRp4U&amp;region=GB"></script>
  
  
	<!-- Sweet Alert -->
  <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>

  <script src="{{ asset('/assets/js/moment.js') }}"></script>

	<script src="{{ asset('/assets/plugins/datetimepicker/jquery.datetimepicker.js') }}"></script>
  
  
  @section("modals")
  @show

  @include("frontend.template.my_loading_modal")
  @include("frontend.template.my_modals_sweet")
  
  <script>

  $("#formulario_newletter").submit(function(){

    var correo = $("#formulario_newletter [name=correo]").val();

    $.ajax({
      url : "{{url('/suscribirme')}}",
      type:"POST",
      data:{
        correo:correo
      },
      headers:
      {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function(data){
        abrir_loading();
      },
      success: function(data)
      {
        cerrar_loading();

        try{
          if(data["response"] == true)
          {
            mostrar_mensajes_success("Realizado!","Se ha agregado su correo correctamente");

            $("#formulario_newletter [name=correo]").val("");
          }
          else {
            mostrar_mensajes_errores(data["messages_errors"]);
          }
        }
        catch(e)
        {
          mostrar_mensajes_errores();
        }
      },
      error: function(data)
      {
        cerrar_loading();
        mostrar_mensajes_errores();
      }
    });

    return false;
  });

  $(document).ready(function(){

    $.datetimepicker.setLocale('es');

    $('.datepicker').datetimepicker({
        timepicker: false,
        closeOnDateSelect: true,
        format: 'd/m/Y',
        scrollMonth : false
    });

    $('.timepicker').datetimepicker({
        timepicker: true,
        datepicker:false,
        closeOnDateSelect: true,
        format: 'H:i',
    });

    $(".select2").select2();

  });
  </script>

	@section("js_code")
  @show
  
  </body>
</html>