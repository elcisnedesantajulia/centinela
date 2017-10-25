<!-- @start formLogin >
<                   -->
  <form class="form-inline" method="post" action="{{ url("sesion/login") }}" >
    <input class="form-control mr-sm-2" type="email" placeholder="email" 
          aria-label="email" id="email" name="email"/>
    <input class="form-control mr-sm-2" type="password" placeholder="Password" 
          aria-label="password" id="password" name="password"/>
    <input type="hidden" id="csrf" name="csrf" value="{{security.getToken()}}" />
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" >
        Ingresar
    </button>
  </form>
<!--               > 
< @end formLogin -->
