<header class="header header--mobile" data-sticky="true" style="background-color: #0071df">
    <div class="header__top">
    <div class="header__left">
        <p>Bienvenido a {{Config("app.name")}} tienda de compras en línea!</p>
    </div>
    <div class="header__right">
        <ul class="navigation__extra">
        <li><a href="#">Sell on Martfury</a></li>
        <li><a href="#">Tract your order</a></li>
        <li>
            <div class="ps-dropdown"><a href="#">US Dollar</a>
            <ul class="ps-dropdown-menu">
                <li><a href="#">Us Dollar</a></li>
                <li><a href="#">Euro</a></li>
            </ul>
            </div>
        </li>
        <li>
            <div class="ps-dropdown language"><a href="#"><img src="{{ asset('assets/img/flag/en.png')}}" alt="">English</a>
            <ul class="ps-dropdown-menu">
                <li><a href="#"><img src="img/flag/germany.png" alt=""> Germany</a></li>
                <li><a href="#"><img src="img/flag/fr.png" alt=""> France</a></li>
            </ul>
            </div>
        </li>
        </ul>
    </div>
    </div>
    <div class="navigation--mobile pt-5">
        <div class="navigation__left">
            <a class="ps-logo" href="{{url('/')}}"><img src="{{ asset('assets/img/logo_light.png')}}" alt=""></a>
        </div>
        <div class="navigation__right">
            <div class="header__actions">
                <!--
                <div class="ps-cart--mini">
                    <a class="header__extra" href="#"><i class="icon-bag2"></i><span><i>0</i></span></a>
                    <div class="ps-cart__content">
                        <div class="ps-cart__items">
                            <div class="ps-product--cart-mobile">
                                <div class="ps-product__thumbnail">
                                    <a href="#"><img src="{{ asset('assets/img/products/clothing/7.jpg')}}" alt=""></a>
                                </div>
                                <div class="ps-product__content">
                                    <a class="ps-product__remove" href="#"><i class="icon-cross"></i></a>
                                    <a href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                                    <p><strong>Sold by:</strong>  YOUNG SHOP</p><small>1 x $59.99</small>
                                </div>
                            </div>
                            <div class="ps-product--cart-mobile">
                                <div class="ps-product__thumbnail">
                                    <a href="#"><img src="{{ asset('assets/img/products/clothing/5.jpg')}}" alt=""></a>
                                </div>
                                <div class="ps-product__content">
                                    <a class="ps-product__remove" href="#"><i class="icon-cross"></i></a
                                    ><a href="product-default.html">Sleeve Linen Blend Caro Pane Shirt</a>
                                    <p><strong>Sold by:</strong>  YOUNG SHOP</p><small>1 x $59.99</small>
                                </div>
                            </div>
                        </div>
                        <div class="ps-cart__footer">
                            <h3>Sub Total:<strong>$59.99</strong></h3>
                            <figure>
                                <a class="ps-btn" href="shopping-cart.html">View Cart</a>
                                <a class="ps-btn" href="checkout.html">Checkout</a>
                            </figure>
                        </div>
                    </div>
                </div>
                -->
                <?php
                $url_mi_cuenta = url('/ingresar');

                if(session("ingreso_frontend") == true){
                    $url_mi_cuenta = url('/cuenta/mi_cuenta');
                }
                ?>
                <a href="{{$url_mi_cuenta}}">
                    <div class="ps-block--user-header">
                        
                        <div class="ps-block__left"><i class="icon-user"></i></div>
                        <div class="ps-block__right"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="ps-search--mobile">
    <form class="ps-form--search-mobile" action="index.html" method="get">
        <div class="form-group--nest">
        <input class="form-control" type="text" placeholder="Buscar">
        <button><i class="icon-magnifier"></i></button>
        </div>
    </form>
    </div>
</header>