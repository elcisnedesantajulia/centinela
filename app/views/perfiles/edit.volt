<!-- @start perfilesEdit >
<                      -->
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
        Editar perfil {{ perfil.nombre }}
      </div>
      <div class="card-body">
        <form class="container" id="perfil" novalidate method="post">
          {{ form.render('nombre') }}
          {{ form.render('caption') }}
          {{ form.render('activo') }}
          {{ tags.submitSuccess('Guardar cambios') }}
        </form>
      </div>
    </div>
  </div>
</div>
{{ partial('partials/jsFormValidation',['id':'perfil']) }}
<!--                  >
< @end perfilesEdit -->

