<!-- @start indexCuenta -->
{{ content() }}

<div class="text-right py-3">
  {{ tags.btnRegresar(index) }}
</div>

<div class="row">
  <div class="col-lg-3">
  </div>
  <div class="col-lg-6">
    <div class="card bg-light">
      <div class="card-header">
        {{ usuario.nombre }}
      </div>
      <div class="card-body">
        <table class="table table-hover">
          <tbody>
            <tr>
              <td>Email:</td>
              <td>{{ usuario.email }}</td>
            </tr>
            <tr>
              <td>Fecha de creación:</td>
              <td>{{ usuario.ctime }}</td>
            </tr>
            <tr>
              <td>Última modificación:</td>
              <td>{{ usuario.mtime }}</td>
            </tr>
        
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- @end indexCuenta -->

