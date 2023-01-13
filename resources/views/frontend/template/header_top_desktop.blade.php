<header class="header header--1" data-sticky="true">
      <div class="header header--standard header--technology">
      <div class="header__top">
    <div class="container">
        <div class="header__left">
            <!--<p>CENTRO COMERCIAL <strong>para todos los pedidos superiores a $ 100</strong></p>-->
        </div>
        <div class="header__right">
        <ul class="header__top-links">
            <li>
            @if(session("ingreso_frontend") !== TRUE)
                <div class="ps-block--user-header">
                    <div class="ps-block__left"><i class="icon-user"></i></div>
                    <div class="ps-block__right"><a href="{{url('/ingresar')}}">Ingresar</a><a href="{{url('/registrarse')}}">Registrarse</a></div>
                </div>
            @else

            @endif
            </li>
        </ul>
        </div>
    </div>
    </div>
    <div class="header__content" >
    <div class="container">
        <div class="header__content-left">
            <a class="ps-logo" href="{{url('/')}}"><img src="{{ asset('assets/img/logo.png')}}" alt=""></a>
            <!--
            <div class="menu--product-categories">
                <div class="menu__toggle"><i class="icon-menu"></i></div>
                <div class="menu__content">
                <ul class="menu--dropdown">
                    <li><a href="#">New Arrivals</a>
                    </li>
                    <li><a href="#">Best Sellers</a>
                    </li>
                    <li><a href="#">Smartphone</a>
                    </li>
                    <li><a href="#">Tablets</a>
                    </li>
                    <li><a href="#">Laptops</a>
                    </li>
                    <li><a href="#">Sounds</a>
                    </li>
                    <li><a href="#">Technology Toys</a>
                    </li>
                    <li><a href="#">Accessories</a>
                    </li>
                </ul>
                </div>
            </div>-->
        </div>
        <div class="header__content-center">
          <form class="ps-form--quick-search" action="{{url('/buscar')}}" method="get">
              <div class="form-group--icon"><i class="icon-chevron-down"></i>
              <select class="form-control">
                  <option value="0">Todo</option>
                  <option value="1">Ofertas</option>
                  <option value="2">Demandas</option>
              </select>
              </div>
              <input class="form-control" type="text" name="texto" placeholder="Escribe lo que deseas buscar">
              <button>Buscar</button>
          </form>
        </div>
        
        <div class="header__content-right">
            <div class="header__actions">
                
                @if(session("ingreso_frontend") == TRUE)
                <?php
                $cantidad_favoritos = DB::table("favoritos_publicaciones")
                ->join("publicaciones","publicaciones.id","=","favoritos_publicaciones.id_publicacion")
                ->select("favoritos_publicaciones.*")
                ->where("publicaciones.id_estado_publicacion",2)
                ->where("favoritos_publicaciones.id_usuario",session("id"))
                ->count();
                ?>
                <a class="header__extra" href="{{url('/cuenta/mis_favoritos')}}">
                    <i class="icon-heart"></i><span><i id="cantidad_favoritos_menu_header">{{$cantidad_favoritos}}</i></span>
                </a>
                @endif
                
                
                <!--<div class="ps-cart--mini">
                
                <a class="header__extra" href="#"><i class="icon-bag2"></i><span><i>0</i></span></a>
                

                <div class="ps-cart__content">
                    <div class="ps-cart__items">
                        <div class="ps-product--cart-mobile">
                            <div class="ps-product__thumbnail"><a href="#"><img src="{{ asset('assets/img/products/clothing/7.jpg')}}" alt=""></a></div>
                            <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                            <p><strong>Sold by:</strong>  YOUNG SHOP</p><small>1 x $59.99</small>
                            </div>
                        </div>
                        <div class="ps-product--cart-mobile">
                            <div class="ps-product__thumbnail"><a href="#"><img src="{{ asset('assets/img/products/clothing/5.jpg')}}" alt=""></a></div>
                            <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html">Sleeve Linen Blend Caro Pane Shirt</a>
                            <p><strong>Sold by:</strong>  YOUNG SHOP</p><small>1 x $59.99</small>
                            </div>
                        </div>
                        </div>
                        <div class="ps-cart__footer">
                        <h3>Sub Total:<strong>$59.99</strong></h3>
                        <figure><a class="ps-btn" href="shopping-cart.html">View Cart</a><a class="ps-btn" href="checkout.html">Checkout</a></figure>
                        </div>
                    </div>
                </div>-->
                <div class="ps-block--user-header" style="margin: 0 10px;">
                    @if(session("ingreso_frontend") == TRUE)
                    <div class="ps-block__left">
                      <i class="icon-user"></i>
                    </div>
                    <div class="ps-block__right">
                      <a href="{{url('/cuenta/mi_cuenta')}}">Mi Cuenta</a>
                      <a href="{{url('/cerrar_sesion')}}">Cerrar Sesion</a>
                    </div>
                    @else
                    <div class="ps-block__left"><i class="icon-user"></i></div>
                    <div class="ps-block__right"><a href="{{url('/ingresar')}}">Ingresar</a><a href="{{url('/registrarse')}}">Registrarse</a></div>
                    @endif
                </div>
                <div  style="margin: 0 10px;">
                  <a href="{{url('/publicaciones/publicar')}}" class="btn btn-large btn-primary text-white" style="padding: 1rem 1rem;font-size: 1.2rem;">
                    Publicar
                  </a>
                </div>
            </div>
        </div>
    </div>
    </div>
      </div>
      <nav class="navigation" style="background-color: #0071df;" >
        <div class="ps-container">
          <div class="navigation__left" style="width: auto;">
            <div class="menu--product-categories">
              <div class="menu__toggle"><i class="icon-menu text-white"></i><span> <!--Shop by Department --></span></div>
              <div class="menu__content">
                <ul class="menu--dropdown">

                <?php

                $categorias = \App\Categoria::where("activa",1)->where("mostrar_en_menu",1)->orderBy("nombre")->get();

                foreach($categorias as $categoria_obj):

                    $subcategorias = $categoria_obj->get_subcategorias_activas_en_menu;
                    
                    
                    if(count($subcategorias) > 0)
                    { ?>
                        <li class="menu-item-has-children has-mega-menu">
                            <a href="{{url('/buscar?id_categoria='.$categoria_obj->id)}}"><i class="fa fa-circle"></i> {{$categoria_obj->nombre}}</a>
                            <div class="mega-menu">
                                <div class="mega-menu__column">
                                    <h4>Subcategorias<span class="sub-toggle"></span></h4>
                                    <ul class="mega-menu__list">
                                      @foreach($subcategorias as $subcategoria_row)
                                      <li><a href="{{url('/buscar?id_subcategoria='.$subcategoria_row->id)}}">{{$subcategoria_row->nombre}}</a></li>
                                      @endforeach
                                      <li><a href="{{url('/buscar?id_categoria='.$categoria_obj->id)}}">Todas</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        
                <?php
                    }
                    else
                    { ?>
                        <li><a href="{{url('/buscar?id_categoria='.$categoria_obj->id)}}"><i class="fa fa-circle"></i> {{$categoria_obj->nombre}}</a></li>
                <?php
                    }
                endforeach;
                ?>
                  <li><a href="{{url('/listado_de_categorias')}}"><i class="fa fa-circle"></i>Ver más categorías</a></li>
                </ul>
              </div>
            </div>
          </div>
          
          
          <div class="navigation__right">
            <ul class="menu">
                <?php

                $menu_frontend = \App\MenuFrontend::where("activo",1)->orderBy("orden","asc")->get();


                foreach($menu_frontend as $row_menu_frontend)
                {
                  echo 
                  '<li class="current-menu-item">
                      <a href="'.e($row_menu_frontend->enlace).'" '.($row_menu_frontend->misma_pestania == 0 ? "target='_blank'" : "" ).' style="font-weight: bold;">
                          <i class="fa fa-dot-circle"></i> '.e($row_menu_frontend->nombre).'
                      </a>
                  </li>';
                }


                ?>
            </ul>
            <!--
            <ul class="navigation__extra">
              <li><a href="#">Sell on Martfury</a></li>
              <li>
                <div class="ps-dropdown"><a href="#">US Dollar</a>
                  <ul class="ps-dropdown-menu">
                    <li><a href="#">Us Dollar</a></li>
                  </ul>
                </div>
              </li>
              <li>
                <div class="ps-dropdown language"><a href="#"><img src="img/flag/en.png" alt="">English</a>
                  <ul class="ps-dropdown-menu">
                    <li><a href="#"><img src="img/flag/germany.png" alt=""> Germany</a></li>
                  </ul>
                </div>
              </li>
            </ul>-->
          </div>

        </div>
      </nav>
    </header>