<!-- @start navbar > 
<                -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
<!-- Brand -->
    {{ link_to('index/index','<img src="/c/favicon/favicon-32x32.png" width="28" height="28" alt="Logo Centinela"> Centinela',"class":"navbar-brand") }}

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
        {%for caption, element in menu         %}
        {%  if element is type('array')     %}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" 
                id="userMenu" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
            {{ caption }}
          </a>
          <div class="dropdown-menu" aria-labelledby="userMenu">
        {%  for caption,uri in element           %}
            {{ link_to(uri,caption,"class": "dropdown-item") }}
        {%  endfor                              %}
          </div>
        </li>
        {%  else                                %}
        <li class="nav-item">
          {{ link_to(element, caption,"class":"nav-link") }}
        </li>
        {%  endif                               %}
        {%endfor                                %}
      </ul>
<!-- ====> Items derecha -->
{%if( perfil != 'visita' )          %}
{{ partial('partials/userMenu')     }}
{%else                              %}
{%  if is_registro is not defined   %}
{{ partial('partials/formLogin')    }}
{%  endif                           %}
{%endif                             %}
    </div>
  </div>
</nav>
<!--            >
< @end navbar -->
