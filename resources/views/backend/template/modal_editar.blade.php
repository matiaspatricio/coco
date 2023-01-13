<div class="modal" tabindex="-1" role="dialog" id="modal_editar">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h3 class="text-white">Editar {{ $entidad }}</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" id="formulario_editar">
          <div class="row">
              {{ $inputs }}
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="editar()">
            <i class="fa fa-save"></i> Guardar Cambios
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fa fa-close"></i>Cancelar
        </button>
      </div>
    </div>
  </div>
</div>