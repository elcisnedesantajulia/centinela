<!-- @start usuarios/index >
<                        -->
{{ content() }}

<div class="text-right py-3">
  {{ tags.btnCreateUser() }}
</div>

{% for usuario in paginator.items   %}
{% if loop.first                    %}
<table class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Email</th>
      <th>Perfil</th>
      <th>Bloqueado</th>
      <th class="col-lg-auto">Acciones</th>
    </tr>
  </thead>
  <tbody>
{% endif                            %}
    <tr {{ usuario.bloqueado == 1 ? 'class="table-danger"' : '' }}>
      <td>{{ usuario.id }}</td>
      <td>{{ usuario.nombre }}</td>
      <td>{{ usuario.email }}</td>
      <td>{{ usuario.perfil.caption }}</td>
      <td>{{ usuario.bloqueado == 1 ? 'Sí' : 'No' }}</td> 
      <td>
        {{ tags.btnEdit('usuarios/edit/'~usuario.id,'Editar usuario') }}
        {{ tags.btnDeleteUser(usuario.id,usuario.nombre) }}
        {{ tags.btnPassword('usuarios/password/'~usuario.id,'Cambiar password') }}
      </td>
    </tr>
{% if loop.last                     %}
  </tbody>
</table>
{% endif                            %}
{% else                             %}
No hay resultados
{% endfor                           %}
{{ partial('partials/deleteUserModal') }}
<!--                    >
< @end usuarios/index -->

