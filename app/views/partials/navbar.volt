<!-- @start navbar > 
<                -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
<!-- Brand -->
    <a class="navbar-brand" href="#">Centinela</a>
<!-- Boton Colapsa -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" 
          data-target="#colapsa" aria-controls="colapsa" 
          aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
<!-- Items colapsables -->
    <div id="colapsa" class="navbar-collapse collapse">
<!-- Items izquierda <=====  -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Registro</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" 
                id="userMenu" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
            Usuario
          </a>
          <div class="dropdown-menu" aria-labelledby="userMenu">
            <a class="dropdown-item" href="#">Editar</a>
          </div>
        </li>
        {%for caption, arr_menu in menu %}
        {%  if arr_menu['hijos'] is defined %}
        {%    set arr_hijos = arr_menu['hijos'] %}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" 
                id="userMenu" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
            {{ caption }}
          </a>
          <div class="dropdown-menu" aria-labelledby="userMenu">
        {%  for arr_hijo in arr_hijos %}

            {{ link_to(arr_hijo[1],arr_hijo[0],"class": "dropdown-item") }}
        {%  endfor %}

          </div>
        </li>
        {%  else %}

        <li class="nav-item">
          {{ link_to(arr_menu['uri'], caption,"class":"nav-link") }}
        </li>
        {%  endif %}
        {%endfor%}
      </ul>
<!-- ====> Items derecha -->
{% if is_auth == true %}
{{ partial('partials/userMenu') }}
{% else %}
{{ partial('partials/formLogin')}}
{% endif%}
    </div>
  </div>
</nav>
<!--            >
< @end navbar -->
