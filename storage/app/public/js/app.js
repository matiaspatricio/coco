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