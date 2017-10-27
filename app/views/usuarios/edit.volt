<!-- @start registro >
<                  -->
{{ content() }}

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

            {{ form.renderCheck('bloqueado') }}
            {#{ form.renderInput('confirmar') }#}
          <div class="form-group">
            {#{ form.render('csrf', ['value': security.getToken()]) }}
            {{ form.render('Registrar') }#}
            {{ submit_button("Guardar", "class": "btn btn-outline-success btn-block") }}
            <span class="help-block">{#{ form.mensajes('csrf') }#}</span>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
{{ partial('partials/jsFormValidation',['id':'usuario']) }}
<!--              >
< @end registro -->

