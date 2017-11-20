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
// Habilitar tooltips
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
// Modals
$('#deleteUserModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id = button.data('id') 
  var name = button.data('name')
  $('#caption').text('Borrar usuario ' + name)
  $('#confirmar').attr("href",'{{ url("usuarios/delete/") }}'+id)
})

$('#deleteControladorModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id = button.data('id') 
  var name = button.data('name')
  $('#caption').text('Borrar controlador ' + name)
  $('#confirmar').attr("href",'{{ url("controladores/delete/") }}'+id)
})

$('#deleteAccionModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id = button.data('id') 
  var name = button.data('name')
  $('#caption').text('Borrar acción ' + name)
  $('#confirmar').attr("href",'{{ url("acciones/delete/") }}'+id)
})

</script>

