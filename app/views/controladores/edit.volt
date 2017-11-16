<!-- @start controladoresEdit -->
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
        Editar controlador {{ controlador.controlador }}
      </div>
      <div class="card-body">
        <form class="container" id="controlador" novalidate method="post">
          {{ form.render('controlador') }}
          {{ tags.submitSuccess('Guardar cambios') }}
        </form>
      </div>
    </div>
  </div>
</div>
{{ partial('partials/jsFormValidation',['id':'controlador']) }}
<!-- @end controladoresEdit -->

