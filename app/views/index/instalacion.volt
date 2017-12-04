{{ content() }}

<div class="text-right py-3">
  {{ tags.btnRegresar(index) }}
</div>

<div class="container">
  <div class="row">

    <div class="col-md-8 pl-0">
<h3>Requisitos</h3>
<p>Necesitarás al menos:</p>
<p>
<ul>
<li><code>PHP 5.5</code></li>
<li><code>MySQL 5.1.5</code></li>
<li>Apache WEB Server con <code>mod_rewrite enabled</code> y <code>AllowOverride Options</code> (o <code>All</code>) en tu <code>httpd.conf</code>.</li>
<li>La más reciente extensión de <a href="https://github.com/phalcon/cphalcon" target="blank">Phalcon Framework</a></li>
<li><code>Git</code></li>
</ul>
</p>

<hr />

<h3>Instalación</h3>
<p>
<ol>
<li>Clona el repositorio Git</li>
<code>git clone https://github.com/elcisnedesantajulia/centinela.git</code>
<br /><br />
<li>Crea la base de datos del proyecto e inicializa con el schema:</li>
<code>echo 'CREATE DATABASE centinela' | mysql -u root<br />
cat schemas/centinela.sql | mysql -u root centinela</code>
<br /><br />
<li>Configura la base de datos en <code>app/config/config.php</code></li>
Reemplaza estas líneas por las correctas en tu proyecto:
<pre><code>
        'host'        =&gt; 'localhost',
        'username'    =&gt; 'phalcon',
        'password'    =&gt; 'config.dev',
        'dbname'      =&gt; 'centinela',
</code></pre>
También puedes sobreescribir la configuración creando el archivo 
<code>app/config/config.dev.php</code>, el cual es ignorado por Git.
<br /><br />
<li>Configura el directorio raíz de tu proyecto en <code>app/config/config.php</code></li>
<pre><code>
        'baseUri'     =&gt; '/c/',
</code></pre>
<li>Da permisos recursivos de escritura al directorio cache</li>
<code>chmod -R 777 cache</code>

<li>Para terminar, crea una cuenta.</li>
Crea un cuenta en tu sitio recién instalado y dale permisos de Super Usuario (<code>perfilId</code> = 1 en tabla <code>usuarios</code>).

</ol>
</p>

    </div>

    <div class="col-md-4 pr-0">

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


  </div>

</div> <!-- /container -->
