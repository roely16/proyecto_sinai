$(".inscribir").click(function(event){
	event.preventDefault()

	const href = $(this).attr('href')

	swal({
		title: 'Inscripción',
		text: "¿Seguro que desea desea inscribir al alumno en este grado?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, inscribirlo',
		cancelButtonText: 'Cancelar'
	}).then(function() {

		//Eliminacion de registro
		$.ajax({
			url: href,
			type: 'GET',
			success: function(data) {
				console.log(data)

				if (data == 'reinscripcion') {

					swal({
						title: 'Reinscripción exitosa!',
						text: 'El Alumno a sido reinscrito exitosamente',
						type: 'success'
					}).then(function(){

						//Redirigir
						$(location).attr('href','/plataforma/administracion/alumnos');
					})

				}else{

					swal({
						title: 'Inscripción exitosa!',

						html:   '<b>Usuario: </b> ' + data.usuario + '<br>' +
	    						'<b>Contraseña: </b>' + data.usuario,

						type: 'success'
					}).then(function(){

						//Redirigir
						$(location).attr('href','/plataforma/administracion/alumnos');
					})

				}
			}
		})

	})

})