@extends('frontend.template.master')

@section('title', 'Contacto')

@section('contenido')
<div class="ps-contact-form">
    <div class="container">
        <form class="ps-form--contact-us" action="#" method="post" id="formulario_contacto">
        <h3>Contáctese con nosotros</h3>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Nombre *" name="nombre">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Apellido *" name="apellido">
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Asunto *" name="asunto">
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Correo *" name="correo">
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <div class="form-group">
                    <textarea class="form-control" rows="5" placeholder="Mensaje *" name="mensaje"></textarea>
                </div>
            </div>
        </div>
        <div class="form-group submit">
            <button class="ps-btn">Enviar Mensaje</button>
        </div>
        </form>
    </div>
    </div>
@endsection

@section("js_code")

<script>
    
$("#formulario_contacto").submit(function(){

    var formdata = new FormData();

    formdata.append("nombre",$("#formulario_contacto [name=nombre]").val());
    formdata.append("apellido",$("#formulario_contacto [name=apellido]").val());
    formdata.append("correo",$("#formulario_contacto [name=correo]").val());
    formdata.append("asunto",$("#formulario_contacto [name=asunto]").val());
    formdata.append("mensaje",$("#formulario_contacto [name=mensaje]").val());

    $.ajax({
        url: "{{url('/contacto/enviar_mensaje')}}",
        type: "POST",
        contentType: false,
        cache: false,
        processData:false,
        data: formdata,
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function(event){
            abrir_loading();
        },
        success: function(data)
        {
            cerrar_loading();

            try{

                if(data["response"])
                {
                    $("#formulario_contacto [name=nombre]").val("");
                    $("#formulario_contacto [name=apellido]").val("");
                    $("#formulario_contacto [name=correo]").val("");
                    $("#formulario_contacto [name=asunto]").val("");
                    $("#formulario_contacto [name=mensaje]").val("");

                    mostrar_mensajes_success("Enviado!","Mensaje enviado correctamente, nos pondremos en contacto contigo");
                }
                else
                {
                    mostrar_mensajes_errores(data["messages_errors"]);
                }
            }
            catch(e)
            {
                mostrar_mensajes_errores();
            }
        },
        error: function(error){
            cerrar_loading();
            mostrar_mensajes_errores();
        },
    });

    return false;
});
</script>

@endsection