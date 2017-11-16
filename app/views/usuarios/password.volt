<!-- @start usuariosPassword -->
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
        Cambiar password para {{ usuario.nombre }}
      </div>
      <div class="card-body">
        <form class="container" id="usuario" novalidate method="post">
          {{ form.render('password') }}
          {{ form.render('confirmar') }}
          {{ tags.submitSuccess('Guardar cambios') }}
        </form>
      </div>
    </div>
  </div>
</div>
{{ partial('partials/jsFormValidation',['id':'usuario']) }}
<!-- @end usuariosPassword -->

