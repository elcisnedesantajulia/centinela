<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" 
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
    integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" 
crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" 
    integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" 
    crossorigin="anonymous"></script>
<script>
// Mabilitar tooltips
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
// Modals
$('#deleteUserModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // El botón que lanzó el modal
  var userid = button.data('userid') 
  var username = button.data('username')
  $('#caption').text('Borrar usuario ' + username)
  $('#confirmar').attr("href",'{{ url("usuarios/delete/") }}'+userid)
})

$('#deleteControladorModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // El botón que lanzó el modal
  var controladorid = button.data('controladorid') 
  var controladorname = button.data('controladorname')
  $('#caption').text('Borrar controlador ' + controladorname)
  $('#confirmar').attr("href",'{{ url("controladores/delete/") }}'+controladorid)
})

</script>

