<div class="modal" tabindex="-1" role="dialog" id="modal_loading" data-backdrop="false" data-keyboard="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cargando</h5>
      </div>
      <div class="modal-body" style="text-align: center;">
            <div class="row">
                <div class="col-md-12">
                    <img src="{{ asset('/assets/img/loading.gif') }}" class="img-responsive">
                </div>
                <div class="col-md-12">
                    <p>Cargando por favor espere</p>
                </div>
            </div>
      </div>
    </div>
  </div>
</div>


<script>
	function abrir_loading()
	{
		$("#modal_loading").modal("show");
	}

	function cerrar_loading()
	{
		$("#modal_loading").modal("hide");
	}
</script>