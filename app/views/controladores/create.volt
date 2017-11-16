<!-- @start controladoresCreate -->
{{ content() }}

<div class="text-right py-3">
  {{ tags.btnRegresar(back) }}
</div>

<div class="row">
  <div class="col-lg-3">
  </div>
  <div class="col-lg-6">
    <div class="card bg-light">
      <div class="card-header">
        Crear nuevo controlador
      </div>
      <div class="card-body">
        <form class="container" id="controlador" novalidate method="post" autocomplete="off">
          {{ form.render('controlador') }}
          {{ tags.submitSuccess('Crear controlador') }}
        </form>
      </div>
    </div>
  </div>
</div>
{{ partial('partials/jsFormValidation',['id':'controlador']) }}

<!-- @end controladoresCreate -->
