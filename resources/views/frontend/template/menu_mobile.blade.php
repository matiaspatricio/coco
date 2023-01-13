<div class="ps-panel--sidebar" id="navigation-mobile">
    <div class="ps-panel__header">
    <h3>Menu</h3>
    </div>
    <div class="ps-panel__content">
        <ul class="menu--mobile">
            <?php

            $categorias = \App\Categoria::where("activa",1)->get();

            foreach($categorias as $categoria_obj):

                $subcategorias = $categoria_obj->get_subcategorias_activas_en_menu;
                
                
                if(count($subcategorias) > 0)
                { ?>
                    <li class="menu-item-has-children has-mega-menu">
                        <a href="{{url('/buscar?id_categoria='.$categoria_obj->id)}}">{{$categoria_obj->nombre}}</a><span class="sub-toggle"></span>
                        <div class="mega-menu">
                            <div class="mega-menu__column">
                                @foreach($subcategorias as $subcategoria_row)
                                <h4><a href="{{url('/buscar?id_subcategoria='.$subcategoria_row->id)}}">{{$subcategoria_row->nombre}}</a></h4>
                                @endforeach
                                <h4><a href="{{url('/buscar?id_categoria='.$categoria_obj->id)}}">Todas</a></h4>
                            </div>
                        </div>
                    </li>

            <?php
                }
                else
                { ?>
                    <li><a href="{{url('/buscar?id_categoria='.$categoria_obj->id)}}">{{$categoria_obj->nombre}}</a></li>
            <?php
                }

            endforeach;
            ?>
        </ul>
    </div>
</div>
<div class="navigation--list">
    <div class="navigation__content"><a class="navigation__item" href="{{url('/')}}">
        <i class="icon-home"></i><span> Inicio</span></a>
        <a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile">
            <i class="icon-menu"></i><span> Menu</span>
        </a>
        <a class="navigation__item ps-toggle--sidebar" href="#search-sidebar">
            <i class="icon-magnifier"></i><span> Buscar</span>
        </a>

        <?php
        $url_mi_cuenta = url('/ingresar');

        if(session("ingreso_frontend") == true){
            $url_mi_cuenta = url('/cuenta/mi_cuenta');
        }
        ?>
        <a class="navigation__item" href="{{$url_mi_cuenta}}">
            <i class="icon-user"></i><span> Mi Cuenta</span>
        </a>

    </div>
</div>
<div class="ps-panel--sidebar" id="search-sidebar">
    <div class="ps-panel__header">
    <form class="ps-form--search-mobile" action="{{url('/buscar')}}" method="get">
        <div class="form-group--nest">
        <input class="form-control" type="text" placeholder="Buscar...">
        <button><i class="icon-magnifier"></i></button>
        </div>
    </form>
    </div>
    <div class="navigation__content"></div>
</div>