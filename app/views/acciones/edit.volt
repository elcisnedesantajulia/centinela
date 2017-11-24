<!-- @start accionesEdit -->
{{ content() }}

<div class="text-right py-3">
  {{ tags.btnRegresar(index) }}
</div>

<div class="row">
  <div class="col-lg-3">
  </div>
  <div class="col-lg-6">
    <div class="card bg-light">
      <div class="card-header">
        Editar acción {{ accion.accion }}
      </div>
      <div class="card-body">
        <form class="container" id="accion" novalidate method="post">
          {{ form.render('accion') }}
          {{ form.render('controladorId') }}
          {{ form.render('caption') }}
          {{ tags.submitSuccess('Guardar cambios') }}
        </form>
      </div>
    </div>
  </div>
</div>
{{ partial('partials/jsFormValidation',['id':'accion']) }}
<!-- @end accionesEdit -->

