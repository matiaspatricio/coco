<?php

// CRONJOBS

Route::group(["namespace"=>"Cron"],function(){
    Route::get('/cron/envio_mensajes_contacto', 'CronController@envio_mensajes_contacto');
    Route::get('/cron/envio_mensajes_reportes', 'CronController@envio_mensajes_reportes');
    Route::get('/cron/finalizar_publicaciones_vencidas', 'CronController@finalizar_publicaciones_vencidas');
});

// WEB FRONTEND

Route::group(["namespace"=>"Web"],function(){
    Route::get('/', 'Home\HomeController@index');

    // SISTEMA DE LOGIN
    Route::get('/ingresar', 'Login\LoginController@index');
    Route::post('/ingresar_post', 'Login\LoginController@ingresar_post');
    Route::get('/registrarse', 'Login\LoginController@registrarse');
    Route::post('/registrarse_post', 'Login\LoginController@registrarse_post');
    Route::get('/olvide_mis_datos', 'Login\LoginController@olvide_mis_datos');
    Route::post('/forgot_password', 'Login\LoginController@forgot_password');
    Route::get('/cerrar_sesion', 'Login\LoginController@cerrar_sesion');

    Route::get('/confirmar_correo','Login\LoginController@confirmar_correo');
    Route::get("/enviar_correo_activacion","Login\LoginController@enviar_correo_activacion");
    Route::post("/enviar_correo_activacion_post","Login\LoginController@enviar_correo_activacion_post");
    // FIN SISTEMA DE LOGIN

    // SISTEMA UPLOAD
    Route::post("/upload_foto_perfil","UploadFileController@upload_foto_perfil")->middleware("CheckFrontend");
    Route::post("/upload_imagen_publicacion","UploadFileController@upload_imagen_publicacion")->middleware("CheckFrontend");
    // FIN SISTEMA UPLOAD

    // SISTEMA NEWSLETTER
    Route::post("/suscribirme","Home\HomeController@suscribirme");

    // PAISES,PROVINCIAS,LOCALIDADES
    Route::post("/get_localidades_provincia","Home\HomeController@get_localidades_provincia");

    // TEST MERCADOLIBRE JS
    Route::get("/test_ml_js","Home\HomeController@test_ml_js");
    // TEST MERCADOLIBRE JS
    Route::get("/pago","Pagos\PagosController@index");

    // MERCADOPAGO
    Route::group(["prefix"=>"mp","middleware"=>["CheckFrontend"]],function(){
        Route::get("/crear_usuarios_de_prueba","MercadoPagoController@crear_usuarios_de_prueba");
        Route::get("/pagar/{id}","MercadoPagoController@pagar");
        Route::get("/pago_correcto","MercadoPagoController@pago_correcto");
        Route::get("/pago_pendiente","MercadoPagoController@pago_pendiente");
        Route::get("/notificacion_ipn","MercadoPagoController@notificacion_ipn");
    });
    // FINMERCADOPAGO

    Route::group(["namespace"=>"Cuenta","prefix"=>"cuenta","middleware"=>["CheckFrontend"]],function(){
        Route::get('/mi_cuenta', 'CuentaController@mi_cuenta')->middleware("CheckFrontend");
        Route::post('/guardar_datos_mi_cuenta', 'CuentaController@guardar_datos_mi_cuenta')->middleware("CheckFrontend");

        Route::get('/mis_favoritos', 'CuentaController@mis_favoritos')->middleware("CheckFrontend");
        Route::get('/mis_publicaciones', 'CuentaController@mis_publicaciones')->middleware("CheckFrontend");
    });

    Route::group(["namespace"=>"Contacto","prefix"=>"contacto"],function(){
        Route::get('/', 'ContactoController@index');
        Route::post('/enviar_mensaje', 'ContactoController@enviar_mensaje');
    });


    Route::group(["namespace"=>"Publicaciones","prefix"=>"publicaciones"],function(){
        Route::get('/ver/{titulo}/{id}', 'PublicacionesController@ver');

        Route::post("/agregar_pregunta","PublicacionesController@agregar_pregunta")->middleware("CheckFrontend");
        Route::post("/responder_pregunta","PublicacionesController@responder_pregunta")->middleware("CheckFrontend");

        Route::post('/get_pagination','PreguntasPublicacionesController@get_pagination');
        Route::post('/get_pagination_sin_responder','PreguntasPublicacionesController@get_pagination_sin_responder')->middleware("CheckFrontend");

        Route::post('agregar_a_favorito','PublicacionesController@agregar_a_favorito')->middleware("CheckFrontend");

        Route::get('/publicar/{id_tipo_publicacion?}/{tipo?}','PublicacionesController@publicar');
        Route::get('/necesitar_registrarte','PublicacionesController@necesitar_registrarte');

        Route::post('/agregar_publicacion_oferta','PublicacionesController@agregar_publicacion_oferta')->middleware("CheckFrontend");

        Route::group(["prefix"=>"subcategorias"],function(){

            Route::post('/search_por_categoria','SubCategoriasController@search_por_categoria');
            Route::post('/get_subcategorias_de_categoria','SubCategoriasController@get_subcategorias_de_categoria');

        });

    });

    Route::group(["namespace"=>"Reportes","prefix"=>"reportes"],function(){

        Route::post('/realizar_reporte','ReportesController@realizar_reporte')->middleware("CheckFrontend");
    });

    Route::group(["namespace"=>"Buscador","prefix"=>"buscar"],function(){
        Route::get('/', 'BuscadorController@index');
    });

    Route::get("/listado_de_categorias","Buscador\BuscadorController@listado_de_categorias");

    // ENLACES RÁPIDOS
    Route::get('/politica', 'EnlacesRapidosController@politica');
    Route::get('/terminos_y_condiciones', 'EnlacesRapidosController@terminos_y_condiciones');
    Route::get('/envios', 'EnlacesRapidosController@envios');
    Route::get('/devoluciones', 'EnlacesRapidosController@devoluciones');
    Route::get('/preguntas_frecuentes', 'EnlacesRapidosController@preguntas_frecuentes');

    // EMPRESA
    Route::get('/sobre_nosotros', 'EmpresaController@sobre_nosotros');
    Route::get('/afiliate', 'EmpresaController@afiliate');
    Route::get('/carrera', 'EmpresaController@carrera');

    // NEGOCIOS
    Route::get('/nuestra_prensa', 'NegociosController@nuestra_prensa');
    Route::get('/revisa', 'NegociosController@revisa');
    Route::get('/tienda', 'NegociosController@tienda');
});

// WEB BACKEND
Route::get('/backend', 'Backend\Login\LoginController@index');
Route::get('/backend/recuperar_datos', 'Backend\Login\LoginController@recuperar_datos');
Route::post("/backend/forgot_password","Backend\Login\LoginController@forgot_password");
Route::get('/backend/cerrar_sesion', 'Backend\Login\LoginController@cerrar_sesion');
Route::post('/backend/ingresar','Backend\Login\LoginController@ingresar');

Route::group(["namespace"=>"Backend","prefix"=>"backend","middleware"=>"CheckBackend"],function(){

    // UPLOADS
    Route::post("/upload_foto_perfil","UploadFileController@upload_foto_perfil");
    Route::post("/upload_imagen_categoria","UploadFileController@upload_imagen_categoria");
    Route::post("/upload_imagen_subcategoria","UploadFileController@upload_imagen_subcategoria");
    Route::post("/upload_imagen_slider","UploadFileController@upload_imagen_slider");
    Route::post("/upload_image_galery","UploadFileController@upload_image_galery");

    Route::group(["prefix"=>"perfil"],function(){
        Route::get("/mi_perfil","PerfilController@index");
        Route::post("/guardar_perfil","PerfilController@guardar_perfil");
    });

    Route::group(["namespace"=>"Desktop","prefix"=>"desktop"],function(){
        Route::get("/","DesktopController@index");
    });

    Route::group(["namespace"=>"Usuarios","prefix"=>"usuarios"],function(){

        Route::get("/","UsuariosController@index");
        Route::get("/nuevo","UsuariosController@nuevo");
        Route::get("/editar/{id}","UsuariosController@editar");

        Route::post("/get_listado_dt","UsuariosController@get_listado_dt");
        Route::post("/store","UsuariosController@store");
        Route::post("/update","UsuariosController@update");
        Route::post("/delete","UsuariosController@delete");
    });

    Route::group(["namespace"=>"UsuariosFrontend","prefix"=>"usuarios_frontend"],function(){

        Route::get("/","UsuariosFrontendController@index");
        Route::get("/nuevo","UsuariosFrontendController@nuevo");
        Route::get("/editar/{id}","UsuariosFrontendController@editar");

        Route::post("/get_listado_dt","UsuariosFrontendController@get_listado_dt");
        Route::post("/store","UsuariosFrontendController@store");
        Route::post("/update","UsuariosFrontendController@update");
        Route::post("/delete","UsuariosFrontendController@delete");
    });

    Route::group(["namespace"=>"Roles","prefix"=>"roles"],function(){
        Route::get("/","RolesController@index");
        Route::post("/get_listado_dt","RolesController@get_listado_dt");
        Route::post("/get","RolesController@get");
        Route::post("/store","RolesController@store");
        Route::post("/update","RolesController@update");
        Route::post("/delete","RolesController@delete");
    });

    // PUBLICACIONES

    Route::group(["namespace"=>"Publicaciones","prefix"=>"publicaciones"],function(){

        Route::get("/","PublicacionesController@index");
        Route::get("/editar/{id}","PublicacionesController@editar");

        Route::post("/get_listado_dt","PublicacionesController@get_listado_dt");
        Route::post("/update","PublicacionesController@update");
        //Route::post("/delete","PublicacionesController@delete");

        Route::group(["prefix"=>"categorias"],function(){
            Route::get("/","CategoriasController@index");
            Route::post("/get_listado_dt","CategoriasController@get_listado_dt");
            Route::post("/get","CategoriasController@get");
            Route::post("/store","CategoriasController@store");
            Route::post("/update","CategoriasController@update");
            Route::post("/delete","CategoriasController@delete");

            Route::group(["prefix"=>"subcategorias"],function(){
                Route::get("/{id_categoria}","SubcategoriasController@index");
                Route::post("/get_listado_dt","SubcategoriasController@get_listado_dt");
                Route::post("/get","SubcategoriasController@get");
                Route::post("/store","SubcategoriasController@store");
                Route::post("/update","SubcategoriasController@update");
                Route::post("/delete","SubcategoriasController@delete");
            });
        });

        Route::group(["prefix"=>"reportes"],function(){
            Route::get("/","ReportesPublicacionesController@index");
            Route::post("/get_listado_dt","ReportesPublicacionesController@get_listado_dt");
            Route::post("/get","ReportesPublicacionesController@get");
            Route::post("/update","ReportesPublicacionesController@update");
        });

        Route::group(["prefix"=>"colores"],function(){
            Route::get("/","ColoresPublicacionesController@index");
            Route::post("/get_listado_dt","ColoresPublicacionesController@get_listado_dt");
            Route::post("/get","ColoresPublicacionesController@get");
            Route::post("/store","ColoresPublicacionesController@store");
            Route::post("/update","ColoresPublicacionesController@update");
            Route::post("/delete","ColoresPublicacionesController@delete");
        });

        Route::group(["prefix"=>"talles"],function(){
            Route::get("/","TallesController@index");
            Route::post("/get_listado_dt","TallesController@get_listado_dt");
            Route::post("/get","TallesController@get");
            Route::post("/store","TallesController@store");
            Route::post("/update","TallesController@update");
            Route::post("/delete","TallesController@delete");
        });
    });



    Route::group(["namespace"=>"Newsletters","prefix"=>"newsletters"],function(){
        Route::get("/","NewslettersController@index");
        Route::post("/get_listado_dt","NewslettersController@get_listado_dt");
        Route::post("/delete","NewslettersController@delete");

        Route::group(["prefix"=>"envios"],function(){
            Route::get("/","EnviosNewslettersController@index");
            Route::post("/get_listado_dt","EnviosNewslettersController@get_listado_dt");
            Route::get("/nuevo","EnviosNewslettersController@nuevo");
            Route::get("/editar/{id}","EnviosNewslettersController@editar");
            Route::post("/get","EnviosNewslettersController@get");
            Route::post("/store","EnviosNewslettersController@store");
            Route::post("/update","EnviosNewslettersController@update");
            Route::post("/delete","EnviosNewslettersController@delete");

            Route::post("/enviar_envio","EnviosNewslettersController@enviar_envio");
        });
    });

    Route::group(["namespace"=>"MensajesContacto","prefix"=>"mensajes_contacto"],function(){

        Route::get("/","MensajesContactoController@index");
        //Route::get("/ver/{id}","MensajesContactoController@ver");

        Route::post("/get_listado_dt","MensajesContactoController@get_listado_dt");
        Route::post("/get","MensajesContactoController@get");
    });

    Route::group(["namespace"=>"Configuracion","prefix"=>"configuraciones"],function(){
        Route::get("/","ConfiguracionController@index");
        Route::get("/editar/{id}","ConfiguracionController@editar");

        Route::post("/get_listado_dt","ConfiguracionController@get_listado_dt");
        Route::post("/update","ConfiguracionController@update");
    });

    Route::group(["namespace"=>"Configuracion","prefix"=>"mercadopago"],function(){
        Route::get("/","MercadoPagoController@index");
        Route::post("/update","MercadoPagoController@update");
    });

    Route::group(["namespace"=>"Configuracion","prefix"=>"slider_home"],function(){
        Route::get("/","SliderHomeController@index");
        Route::post("/get_listado_dt","SliderHomeController@get_listado_dt");
        Route::post("/get","SliderHomeController@get");
        Route::post("/store","SliderHomeController@store");
        Route::post("/update","SliderHomeController@update");
        Route::post("/delete","SliderHomeController@delete");
    });
   
    Route::group(["namespace"=>"Configuracion","prefix"=>"menu_frontend"],function(){
        Route::get("/","MenuFrontendController@index");
        Route::post("/get_listado_dt","MenuFrontendController@get_listado_dt");
        Route::post("/get","MenuFrontendController@get");
        Route::post("/store","MenuFrontendController@store");
        Route::post("/update","MenuFrontendController@update");
        Route::post("/delete","MenuFrontendController@delete");

        Route::post("/mover_arriba","MenuFrontendController@mover_arriba");
        Route::post("/mover_abajo","MenuFrontendController@mover_abajo");
    });
});
