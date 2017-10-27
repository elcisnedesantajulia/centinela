<!-- @start usuarios/index >
<                        -->
{{ content() }}

{#
<div class="card bg-light mb-2">
  <div class="card-body">
    <form class="form-inline" method="post">
      <span class="mb-2 mr-sm-2 mb-sm-0">Filtrar resultados</span>
        {{ form.renderInput('nombre') }}
        {{ form.renderInput('email') }}
      <div class="form-group">
        {{ form.render('perfilId',['class':'form-control mb-2 mr-sm-2 mb-sm-0']) }}
      </div>
      <div class="form-group">
        {{ submit_button("Buscar", "class": "btn btn-outline-success btn-block") }}
      </div>
    </form>
  </div>
</div>
#}

{% for usuario in paginator.items   %}
{% if loop.first                    %}
<table class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Email</th>
      <th>Perfil</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
{% endif                            %}
    <tr>
      <td>{{ usuario.id }}</td>
      <td>{{ usuario.nombre }}</td>
      <td>{{ usuario.email }}</td>
      <td>{{ usuario.perfil.caption }}</td>
      <td>
        {{ tags.btnEdit('usuarios/edit/'~usuario.id,'Editar usuario') }}
        {{ tags.btnDelete('usuarios/delete/'~usuario.id,'Borrar usuario') }}
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
<!--                    >
< @end usuarios/index -->

