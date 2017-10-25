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
            {{ form.renderInput('nombre') }}
            {{ form.renderInput('email') }}
            {{ form.renderInput('password') }}
            {{ form.renderInput('confirmar') }}
          <div class="form-group">
            {{ form.render('csrf', ['value': security.getToken()]) }}
            {{ form.render('Registrar') }}
            <span class="help-block">{{ form.mensajes('csrf') }}</span>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';

  window.addEventListener('load', function() {
    var form = document.getElementById('registro');
    form.addEventListener('submit', function(event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  }, false);
})();
</script>
<!--              >
< @end registro -->

