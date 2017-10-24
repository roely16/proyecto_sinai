$(".reset").click(function(event) {
  event.preventDefault()

  swal({
    title: "Restablecer contraseña",
    text: "¿Seguro que desea restablecer la contraseña del usuario?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Restablecer',
    cancelButtonText: 'Cancelar'
  }).then((willDelete) => {
    if (willDelete) {

      $.ajax({
        url: $(this).attr('href'),
        type: 'GET',
        success: function(data) {
          console.log(data)
          swal(
            'Correcto!',
            'La clave se ha restablecido con éxito',
            'success'
          )
        }
      })
    } else {
    }
  })
})
