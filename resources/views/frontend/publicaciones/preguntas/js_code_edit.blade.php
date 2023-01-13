<script type="text/javascript">

$("#formulario_editar").submit(function(){
  editar();
  return false;
});

function editar()
{
  var d = $("#formulario_editar");
  formdata = new FormData();

  formdata.append("id",id_trabajando);

  for (var i = 0; i < (d.find('input[type=file]').length); i++) {
    formdata.append((d.find('input[type="file"]').eq(i).attr("name")),((d.find('input[type="file"]:eq('+i+')')[0]).files[0]));
  }

  for (var i = 0; i < (d.find('input').not('input[type=file]').not('input[type=submit]').length); i++) {
      formdata.append( (d.find('input').not('input[type=file]').not('input[type=submit]').eq(i).attr("name")),(d.find('input').not('input[type=file]').not('input[type=submit]').eq(i).val()) );
  }

  for (var i = 0; i < (d.find('select').not('select[type=file]').not('select[type=submit]').length); i++) {
      formdata.append( (d.find('select').not('select[type=file]').not('select[type=submit]').eq(i).attr("name")),(d.find('select').not('select[type=file]').not('select[type=submit]').eq(i).val()) );
  }

  formdata.append("observacion",$("#observacion_edit").val());

  $.ajax({
      url: "{{$link_controlador}}update",
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

          try
          {
            if(data["response"] == true)
            {

              @if($is_ajax === true)

                $("#modal_editar").modal("hide");

                mostrar_mensajes_success(
                    "{{$abm_messages['success_edit']['title']}}",
                    "{{$abm_messages['success_edit']['description']}}"
                );

                cargar_pagina(page);

              @else

              mostrar_mensajes_success(
                  "{{$abm_messages['success_edit']['title']}}",
                  "{{$abm_messages['success_edit']['description']}}",
                  "{{$link_controlador}}"
              );

              @endif
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
  }

</script>
