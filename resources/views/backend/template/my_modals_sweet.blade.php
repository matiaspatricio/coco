<script>

	function mostrar_mensajes_errores(mensajes = null){

        var html_content = "<p>Lo sentimos, ha ocurrido un error</p>";

		if(mensajes != null)
		{
            html_content = "";
    
			for(var i=0; i < mensajes.length;i++)
			{
                html_content+="<p>"+mensajes[i]+"</p>";
			}
		}

        var span = document.createElement("span");
        span.innerHTML = html_content;

        swal({
            title: "Ha ocurrido un error", 
            content: span,
            confirmButtonText: "V redu", 
            allowOutsideClick: "true" 
        });
	}

	function mostrar_mensajes_success(title,descripcion,redirect = null)
	{
		swal({
            title: title,
            text: descripcion,
            type: 'success',
            buttons : {
                confirm: {
                    className : 'btn btn-success'
                }
            }
        }).then(
            function() {
                if(redirect != null)
                {
                    location.href=redirect;
                }
            }
        );
	}
</script>