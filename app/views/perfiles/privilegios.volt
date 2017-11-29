<!-- @start perfiles/privilegios >
<                        -->
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
        Editar privilegios de {{ perfil.caption }}
      </div>
      <div class="card-body">

{%for controlador in controladores        %}
{%  if loop.first                         %}
<form method="post">
{%  endif                                 %}
{%  if controlador.acciones is not empty  %}
{%    for accion in controlador.acciones  %}
{%      if loop.first                       %}
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>{{ controlador.getCaption() }}</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
{%      endif                               %}
{%      if accion.publica                   %}
          <span class="oi oi-circle-check text-success"></span>
          {{ accion.caption }}<br />
{%      else                                %}
{%        set checked = (privilegiosAcciones[accion.id] is defined) ? true : false %}
{{        tags.checkPrivilegio(accion.id,accion.caption,checked) }}
{%      endif%}
{%      if loop.last                        %}
      </td>
    </tr>
  </tbody>
</table>
{%      endif                               %}
{%    endfor %}
{%  endif                                 %}
{%  if loop.last                          %}
  {{ tags.submitSuccess('Guardar') }}
</form>
{%  endif                                 %}
{%endfor                                  %}

      </div>
    </div>
  </div>
</div>

<!--                    >
< @end perfiles/privilegios -->

