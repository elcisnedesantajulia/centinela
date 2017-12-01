{{ content() }}

<div class="jumbotron my-3">
  <div class="col-sm-10 mx-auto">
    <h1>¡Bienvenido!</h1>

<p>Este es un sitio desarrollado con Phalcon Framework.</p>

  </div>
</div>

<div class="container">
  <hr />
  <div class="row">
    <div class="col-md-3 pl-0">

      <div class="card mb-3">
        <div class="card-header">
          <h2>Características</h2>
        </div>
        <div class="card-body">
          <p>
Centinela es un sitio de ejemplo desarrollado con el framework <a href="https://phalconphp.com/es/" target="blank">Phalcon</a> que tiene como objetivos: 
          </p>
<ul>
<li>Mostrar el potencial que tiene Phalcon Framework.</li>
<li>Ser el punto de partida de sitios web que impliquen administración de usuarios, perfiles y privilegios, desarrollo de <span title="Create/Read/Update/Delete" data-toggle="tooltip">CRUDs</span>.</li>
</ul>
<p>
  <a class="btn btn-secondary" href="https://github.com/elcisnedesantajulia/centinela" role="button" target="blank">Github</a>
  {{ link_to('index/instalacion','Instalación &raquo','role':'button','class':'btn btn-secondary') }}
</p>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h2>Usa este demo</h2>
        </div>
        <div class="card-body">
<p>
Prueba este Demo creando una cuenta {{ link_to('index/registro','aquí') }}.
</p>
<p>
Centinela es un proyecto de open source. No dudes en enviar tus comentarios, 
reportar bugs o sugerir alguna mejora o nueva funcionalidad a 
contacto@softle.com, así como enviar un Pull Request.
</p>

        </div>
      </div>

    </div>

    <div class="col-md-9 pr-0">
<p>Gracias a la versatilidad de 
<a href="https://getbootstrap.com/" target="blank">Bootstrap 4</a> y 
<a href="https://useiconic.com/open" target="blank">Open Iconic</a>, es fácil 
modificar el diseño de Centinela para adecuarlo a las necesidades de tu 
proyecto utilizando formularios, botones, navbars, íconos, popovers, etc, con un diseño visualmente atractivo.</p>

<p><img class="img-fluid mx-auto rounded d-block" src="{{url('img/home1.png')}}" ></p>

<p>Se pueden administrar los Controladores y Acciones (Modelo MVC), para posteriormente ser asignados como privilegios. Tiene implementado un paginador que muestra las páginas adjacentes.</p>

<p><img class="img-fluid mx-auto" src="{{url('img/home2.png')}}" ></p>

<p>Se pueden crear y administrar múltiples perfiles de usuario.</p>

<p><img class="img-fluid mx-auto" src="{{url('img/home3.png')}}" ></p>

<p>El sitio es responsivo para dispositivos móviles.</p>

<p><img class="img-fluid mx-auto rounded d-block" src="{{url('img/home4.png')}}" ></p>

    </div>
  </div>

</div> <!-- /container -->
