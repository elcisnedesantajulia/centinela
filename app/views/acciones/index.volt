<!-- @start acciones/index -->
{{ content() }}

<div class="text-right py-3">
  {{ tags.btnCreateControlador() }}
  {{ tags.btnCreateAccion() }}
</div>

{% for accion in paginator.items   %}
{% if loop.first                    %}
<table class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Controlador</th>
      <th>Acción</th>
      <th>Descripción</th>
      <th>Pública</th>
      <th class="col-lg-auto"></th>
    </tr>
  </thead>
  <tbody>
{% endif                            %}
    <tr>
      <td>{{ accion.id }}</td>
      <td>{{ accion.controlador.controlador }}</td>
      <td>
        {{ link_to(accion.getPath(),accion.accion,'title':accion.getPath()) }}
      </td>
      <td>{{ accion.caption }}</td>
      <td>{{ tags.boolLock(!accion.publica) }}</td>
      <td>
        {{ tags.btnEdit('acciones/edit/'~accion.id,'Editar accion') }}
        {{ tags.btnDeleteAccion(accion.id,accion.getPath()) }}
      </td>
    </tr>
{% if loop.last                     %}
  </tbody>
</table>
{% endif                            %}
{% else                             %}
No hay resultados
{% endfor                           %}
{{ partial('partials/deleteAccionModal') }}
<!-- @end acciones/index -->

