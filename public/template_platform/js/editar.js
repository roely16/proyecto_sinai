	$(".editar").click(function(event) {
		event.preventDefault()

		if ($(".icon_edit").text() == 'save') {

			//Restaura el boton de editar
			$("#boton_editar").removeClass("btn green darken-1").addClass("btn blue darken-4")
			$(".icon_edit").text('edit')

			//Envio del formulario para Actualizar
			$.ajax({
				url: $('#form_edit').attr('action'),
				type: 'PUT',
				data: $('#form_edit').serialize(),
				success: function(data) {
					console.log(data);

					//Mostrar mensaje de cambios guardados
					swal({
						title: 'Actualización Exitosa',
						text: 'Todos los cambios han sido guardados',
						type: 'success',
						timer: 2000,
						showConfirmButton: true
					})

				}
			});

			//Deshabilitar los input
			enabled_disabled()

		} else {
			//Habilita los input
			enabled_disabled()

			//Mostrar mensaje de habilitacion
			swal({
				title: 'Edición Activada',
				text: 'Puede modificar los campos',
				type: 'info',
				timer: 2000,
				showConfirmButton: true
			})

			//Cambia el boton editar por el de guardar
			$("#boton_editar").removeClass("btn blue darken-4").addClass("btn green darken-1")
			$(".icon_edit").text('save')
		}

	})

	function enabled_disabled() {
		$('.edit').each(function() {
			if ($(this).attr('readonly')) {
				$(this).removeAttr('readonly');
			} else {
				$(this).prop('readonly', true);
			}
		});
	}
