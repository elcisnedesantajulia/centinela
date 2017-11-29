<!-- @start accionesCreate -->
{{ content() }}

<div class="text-right py-3">
  {{ tags.btnRegresar(index) }}
  {{ tags.btnCreateControlador() }}
</div>

<div class="row">
  <div class="col-lg-3">
  </div>
  <div class="col-lg-6">
    <div class="card bg-light">
      <div class="card-header">
        Crear nueva acción
      </div>
      <div class="card-body">
        <form class="container" id="accion" novalidate method="post" autocomplete="off">
          {{ form.render('accion') }}
          {{ form.render('controladorId') }}
          {{ form.render('caption') }}
          {{ form.render('publica') }}
          {{ tags.submitSuccess('Crear acción') }}
        </form>
      </div>
    </div>
  </div>
</div>
{{ partial('partials/jsFormValidation',['id':'accion']) }}

<!-- @end accionesCreate -->
