<!DOCTYPE html>
<html>
{{ partial('partials/headHtml') }}
  <body>
    <header>
{{ partial('partials/navbar') }}
    </header>
    <main role="main" class="container">
      <!--h3>[{{ dispatcher.getControllerName() }}] => [{{ dispatcher.getActionName() }}]</h3-->
      {{ content() }}
    </main>
{{ partial('partials/footer') }}
{{ partial('partials/scriptsJs') }}
  </body>
</html>
