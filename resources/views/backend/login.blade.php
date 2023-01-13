<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="<?php echo csrf_token() ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ingreso Backend | {{ Config("app.name") }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/adminlte3/dist/css/adminlte.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('/adminlte3/plugins/iCheck/square/blue.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="{{ url('/plugins/sweet-alert2/sweetalert2.min.css') }}">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Ingreso Backend</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingresá tus datos para entrar al sistema</p>

      <form action="#" method="post" id="formulario_ingreso" class="mb-3">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Correo" name="correo">
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Contraseña" name="password">
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-3">
        <a href="#">Olvide mi contraseña</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ url('/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ url('/adminlte3/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ url('/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>

<script>

  function mostrar_mensajes_success(titulo,descripcion,redirigir)
  {
    swal({
        title: titulo,
        text: descripcion,
        type: 'success',
        showCancelButton: false,
        confirmButtonClass: 'btn btn-success',
        allowOutsideClick: false,
    }).then(function() {
        if(redirigir != null)
        {
            window.location.href = redirigir;
        }
    });
  }

  function mostrar_mensajes_errores(mensajes = null)
  {

    var html_mensajes = "<p>Si el error sigue ocurriendo contactese con nosotros</p>";

    if(mensajes != null)
    {
      html_mensajes="";

      for(var i=0; i < mensajes.length;i++)
      {
        html_mensajes = mensajes[i];
      }
    }

    swal({
        title: 'Ha ocurrido un error',
        text: html_mensajes,
        type: 'error',
        showCancelButton: false,
        confirmButtonClass: 'btn btn-success',
        //cancelButtonClass: 'btn btn-danger m-l-10',
        confirmButtonText: 'Aceptar'
    });
  } 

  function abrir_loading()
  {

  }

  function cerrar_loading()
  {

  }

  
  $("#formulario_ingreso").submit(function(){


    var correo = $("#formulario_ingreso [name=correo]").val();
    var password = $("#formulario_ingreso [name=password]").val();

    $.ajax({
      url: "{{url('/backend/ingresar')}}",
      type: "POST",
      data: {
        correo:correo,
        password:password
      },
      headers:
      {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },

      beforeSend: function(e)
      {
        abrir_loading();
      },
      success: function(data)
      {
        cerrar_loading();

        try
        {
          if(data["response"] == true)
          {
            location.href="{{url('/backend/desktop')}}";
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
      error: function(e)
      {
        mostrar_mensajes_errores();
        cerrar_loading();
      }
    });

    return false;

  });
</script>
</body>
</html>
