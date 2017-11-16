<!-- @start deleteUserModal -->
<div class="modal fade" id="deleteControladorModal" tabindex="-1" role="dialog" 
    aria-labelledby="deleteControladorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          <span class="oi oi-trash text-danger"></span>
          <span id="caption">Borrar controlador ?</span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success" data-dismiss="modal">
          <span class="oi oi-action-undo"></span> Cancelar
        </button>
        <a href="{{ url('controladores/delete/') }}" id="confirmar" 
              class="btn btn-outline-danger" role="button">
          Confirmar
        </a>
      </div>
    </div>
  </div>
</div>
<!-- @end deleteUserModal -->
