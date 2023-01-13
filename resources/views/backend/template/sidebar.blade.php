<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('storage/imagenes/usuarios/'.session('foto_perfil')) }}" class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{session("nombre")}}
                            <span class="user-level">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="{{url('/backend/perfil/mi_perfil')}}">
                                    <span class="link-collapse">Mi Perfil</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/backend/cerrar_sesion')}}">
                                    <span class="link-collapse">Cerrar Sesion</span>
                                </a>
                            </li>
                            <!--<li>
                                <a href="#settings">
                                    <span class="link-collapse">Configuración</span>
                                </a>
                            </li>-->
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a href="{{url('/backend/desktop')}}">
                        <i class="fas fa-home"></i>
                        <p>Escritorio</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">MENU DE NAVEGACIÓN</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#opciones_menu_usuarios">
                        <i class="fas fa-users"></i>
                        <p>Usuarios</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="opciones_menu_usuarios">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{url('/backend/usuarios')}}">
                                    <span class="sub-item">Listado</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/backend/usuarios/nuevo')}}">
                                    <span class="sub-item">Nuevo</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#opciones_menu_usuarios_frontend">
                        <i class="fas fa-users"></i>
                        <p>Usuarios Frontend</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="opciones_menu_usuarios_frontend">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{url('/backend/usuarios_frontend')}}">
                                    <span class="sub-item">Listado</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/backend/usuarios_frontend/nuevo')}}">
                                    <span class="sub-item">Nuevo</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#opciones_menu_publicaciones">
                        <i class="fas fa-list"></i>
                        <p>Publicaciones</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="opciones_menu_publicaciones">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{url('/backend/publicaciones')}}">
                                    <span class="sub-item">Listado</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/backend/publicaciones/categorias')}}">
                                    <span class="sub-item">Categorías</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/backend/publicaciones/reportes')}}">
                                    <span class="sub-item">Reportes</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/backend/publicaciones/colores')}}">
                                    <span class="sub-item">Colores</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/backend/publicaciones/talles')}}">
                                    <span class="sub-item">Talles</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#opciones_menu_frontend">
                        <i class="fas fa-list"></i>
                        <p>Frontend</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="opciones_menu_frontend">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{url('/backend/slider_home')}}">
                                    <span class="sub-item">Slider</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/backend/menu_frontend')}}">
                                    <span class="sub-item">Menu</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#opciones_menu_newletters">
                        <i class="fas fa-list"></i>
                        <p>Newletters</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="opciones_menu_newletters">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{url('/backend/newsletters')}}">
                                    <span class="sub-item">Correos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/backend/newsletters/envios')}}">
                                    <span class="sub-item">Envios</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{url('/backend/mensajes_contacto')}}">
                        <i class="fas fa-envelope"></i>
                        <p>Mensajes Contacto</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#opciones_menu_configuraciones">
                        <i class="fas fa-cogs"></i>
                        <p>Configuraciones</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="opciones_menu_configuraciones">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{url('/backend/configuraciones')}}">
                                    <span class="sub-item">Variables</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/backend/mercadopago')}}">
                                    <span class="sub-item">Mercado Pago</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{url('/backend/cerrar_sesion')}}" class="text-danger">
                        <span class="btn-label mr-2">
                            <i class="fa fa-power-off text-danger"></i>
                        </span>
                        Cerrar Sesion
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
