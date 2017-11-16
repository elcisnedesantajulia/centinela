<!-- @start perfilesCreate -->
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
        Crear nuevo perfil
      </div>
      <div class="card-body">
        <form class="container" id="perfil" novalidate method="post" autocomplete="off">
          {{ form.render('nombre') }}
          {{ form.render('caption') }}
          {{ tags.submitSuccess('Crear perfil') }}
        </form>
      </div>
    </div>
  </div>
</div>
{{ partial('partials/jsFormValidation',['id':'perfil']) }}
<!-- @end perfilesCreate -->
