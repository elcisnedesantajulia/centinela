<!-- @start usuariosEdit >
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
        Editar usuario {{ usuario.nombre }}
      </div>
      <div class="card-body">
        <form class="container" id="usuario" novalidate method="post">
          {{ form.render('nombre') }}
          {{ form.render('email') }}
          {{ form.render('perfilId') }}
          {{ form.render('bloqueado') }}
          {{ tags.submitSuccess('Guardar cambios') }}
        </form>
      </div>
    </div>
  </div>
</div>
{{ partial('partials/jsFormValidation',['id':'usuario']) }}
<!--                  >
< @end usuariosEdit -->

