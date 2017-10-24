$("#eliminar").click(function(event) {
	event.preventDefault()

	swal({
		title: 'Eliminación',
		text: "¿Seguro que desea eliminar el registro?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, eliminarlo',
		cancelButtonText: 'Cancelar'
	}).then(function() {

		//Eliminacion de registro
		$.ajax({
			url: $("#eliminar").attr('href'),
			type: 'GET',
			success: function(data) {
				console.log(data)
				swal({
					title: 'Eliminación exitosa!',
					text: 'El registro ha sido eliminado.',
					type: 'success'
				}).then(function(){
					//window.location.replace("/plataforma/alumnos")
				})

			}

		})

	})

})
