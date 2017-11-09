<!-- @start registro >
<                  -->
{{ content() }}

<div class="row">
  <div class="col-lg-3">
  </div>
  <div class="col-lg-6">
    <div class="card bg-light">
      <div class="card-header">
        Ingresa tus datos
      </div>
      <div class="card-body">
        <form class="container" id="registro" novalidate method="post">
            {{ form.render('nombre') }}
            {{ form.render('email') }}
            {{ form.render('password') }}
            {{ form.render('confirmar') }}
          <div class="form-group">
            {{ form.render('csrf', ['value': security.getToken()]) }}
            <span class="text-danger">{{ form.mensajes('csrf') }}</span>
          </div>
            {{ tags.submitSuccess('Registrar') }}
        </form>
      </div>
    </div>
  </div>
</div>
{{ partial('partials/jsFormValidation',['id':'registro']) }}
<!--              >
< @end registro -->

