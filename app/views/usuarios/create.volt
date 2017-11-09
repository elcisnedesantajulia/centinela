<!-- @start usuariosCreate >
<                        -->
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
        Crear nuevo usuario
      </div>
      <div class="card-body">
        <form class="container" id="usuario" novalidate method="post" autocomplete="off">
          {{ form.render('nombre') }}
          {{ form.render('email') }}
          {{ form.render('password') }}
          {{ form.render('confirmar') }} 
          {{ form.render('perfilId') }}
          {{ tags.submitSuccess('Crear usuario') }}
        </form>
      </div>
    </div>
  </div>
</div>
{{ partial('partials/jsFormValidation',['id':'usuario']) }}

<!--                    >
< @end usuariosCreate -->
