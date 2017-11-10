<!-- @start usuarios/index >
<                        -->
{{ content() }}

<div class="text-right py-3">
  {{ tags.btnCreatePerfil() }}
</div>

{% for perfil in paginator.items   %}
{% if loop.first                    %}
<table class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Caption</th>
      <th>Activo</th>
      <th class="col-lg-auto">Acciones</th>
    </tr>
  </thead>
  <tbody>
{% endif                            %}
    <tr {{ perfil.activo == 0 ? 'class="table-danger"' : '' }}>
      <td>{{ perfil.id }}</td>
      <td>{{ perfil.nombre }}</td>
      <td>{{ perfil.caption }}</td>
      <td>{{ perfil.activo == 1 ? 'Sí' : 'No' }}</td> 
      <td>
        {{ tags.btnEdit('perfiles/edit/'~perfil.id,'Editar perfil') }}
      </td>
    </tr>
{% if loop.last                     %}
  </tbody>
</table>
{% endif                            %}
{% else                             %}
No hay resultados
{% endfor                           %}
<!--                    >
< @end usuarios/index -->

