<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" 
    content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Centinela</title>
    <link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" 
    integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" 
    crossorigin="anonymous">
    <link href="http://centinela.softle.com/c/css/centinela.css" rel="stylesheet">
<link rel="apple-touch-icon" sizes="180x180" href="/c/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/c/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/c/favicon/favicon-16x16.png">
<link rel="manifest" href="/c/favicon/manifest.json">
<link rel="mask-icon" href="/c/favicon/safari-pinned-tab.svg" color="#5bbad5">
  </head>
  <body>
    <header>
{{ partial('partials/navbar', ['menu': menu]) }}
    </header>
    <main role="main" class="container">
      <h3>[{{ dispatcher.getControllerName() }}] => [{{ dispatcher.getActionName() }}]</h3>
      {{ content() }}
    </main>
    <footer class="footer">
      <div class="container">
        <span class="text-muted">Softle 2017</span>
      </div>
    </footer>
    <!-- Optional JavaScript here-->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" 
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
     integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" 
    crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" 
    integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" 
    crossorigin="anonymous"></script>
  </body>
</html>
