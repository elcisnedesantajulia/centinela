<!-- @start userMenu >
<                  -->
  <ul class="navbar-nav">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" 
            id="userMenu" data-toggle="dropdown" 
            aria-haspopup="true" aria-expanded="false">
        {{ tags.icon('person') ~ ' ' ~auth.getNombre() }}
      </a>
      <div class="dropdown-menu" aria-labelledby="userMenu">
        {{ link_to('index/cuenta', tags.icon('clipboard') ~ ' Mi cuenta', 
            "class":"dropdown-item") }}
        {{ link_to('index/password', tags.icon('key') ~ ' Cambiar password', 
            "class":"dropdown-item") }}
        {{ link_to('index/logout', tags.logout() ~' Cerrar sesión', 
            "class":"dropdown-item") }}
      </div>
    </li>
  </ul>
<!--             >
< @end userMenu-->
