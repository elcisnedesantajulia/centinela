<!-- @start userMenu >
<                  -->
  <ul class="navbar-nav">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" 
            id="userMenu" data-toggle="dropdown" 
            aria-haspopup="true" aria-expanded="false">
        Usuario
      </a>
      <div class="dropdown-menu" aria-labelledby="userMenu">
        <a class="dropdown-item" href="#">Editar</a>
        {{ link_to('session/logout', 'Inicia sesion', "class":"dropdown-item") }}
      </div>
    </li>
  </ul>
<!--             >
< @end userMenu-->
