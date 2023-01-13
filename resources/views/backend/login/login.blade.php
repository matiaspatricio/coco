<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="csrf-token" content="<?php echo csrf_token() ?>">
	<title>Ingreso Backend | {{ Config("app.name") }}</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('/admin/login/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/admin/login/css/my-login.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/sweet-alert2/sweetalert2.min.css') }}">
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper" style="margin-top: 20px;">
					<div class="" style="padding-left: 50px;padding-right: 50px;text-align:center">
						<img src="{{asset('/assets/img/logo.png')}}" class="img-fluid">
					</div>
					<div class="card fat" style="margin-top: 20px;">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							<form method="POST" id="formulario_ingreso">
							 
								<div class="form-group">
									<label for="correo">Correo</label>

									<input id="text" type="correo" class="form-control" name="correo" value="" required autofocus>
								</div>

								<div class="form-group">
									<label for="password">Contraseña
										<a href="{{url('/backend/recuperar_datos')}}" class="float-right">
											Olvidaste tu Contraseña?
										</a>
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								</div>


								<div class="form-group" style="margin-top: 40px;">
									<button type="submit" class="btn btn-primary btn-block">
										Login
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; {{ Config("app.name") }} {{Date("Y")}}
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('/admin/login/js/jquery.min.js')}}"></script>
	<!-- Bootstrap 4 -->
	<script src="{{ asset('/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('/admin/login/js/my-login.js')}}"></script>
	<script src="{{ asset('/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>

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