<!-- @start controladores/index -->
{{ content() }}

<div class="text-right py-3">
  {{ tags.btnCreateControlador() }}
</div>

{% for controlador in paginator.items   %}
{% if loop.first                    %}
<table class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Controlador</th>
      <th class="col-lg-auto">Acciones</th>
    </tr>
  </thead>
  <tbody>
{% endif                            %}
    <tr>
      <td>{{ controlador.id }}</td>
      <td>{{ controlador.controlador }}</td>
      <td>
        {{ tags.btnEdit('controladores/edit/'~controlador.id,'Editar controlador') }}
        {{ tags.btnDeleteControlador(controlador.id,controlador.controlador) }}
      </td>
    </tr>
{% if loop.last                     %}
  </tbody>
</table>
{% endif                            %}
{% else                             %}
No hay resultados
{% endfor                           %}
{{ partial('partials/deleteControladorModal') }}
<!-- @end controladores/index -->

