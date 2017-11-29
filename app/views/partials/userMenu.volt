<!-- @start userMenu >
<                  -->
  <ul class="navbar-nav">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" 
            id="userMenu" data-toggle="dropdown" 
            aria-haspopup="true" aria-expanded="false">
        {{ auth.getNombre() }}
      </a>
      <div class="dropdown-menu" aria-labelledby="userMenu">
        {{ link_to('index/logout', 'Cerrar sesión', "class":"dropdown-item") }}
      </div>
    </li>
  </ul>
<!--             >
< @end userMenu-->
