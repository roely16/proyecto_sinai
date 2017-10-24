$('#limpiar_recibo').click(function(event){
	event.preventDefault()

	swal({
	  	title: 'Seguro que desea limpiar ?',
	  	text: "Toda la información del recibo sera eliminada!",
	  	type: 'warning',
	  	showCancelButton: true,
	  	confirmButtonColor: '#3085d6',
	  	cancelButtonColor: '#d33',
	  	confirmButtonText: 'Limpiar',
	  	cancelButtonText: 'Cancelar'
	}).then(function () {
  		//Limpiar la tabla 
  		$("#pagos tbody").empty()
  		$("#pagos tfoot").empty()

  		//Desaparecer botones de limpiar y procesar
  		$( "#botones_recibo" ).hide()
	})

})

$('#enviar_recibo').click(function(event){
	event.preventDefault()	
	swal({
  		title: 'Seguro que desea procesar el pago ?',
	  	text: "La informacion del pago sera registrada en la base de datos",
	  	type: 'warning',
	  	showCancelButton: true,
	  	confirmButtonColor: '#3085d6',
	  	cancelButtonColor: '#d33',
	  	confirmButtonText: 'Procesar',
	  	cancelButtonText: 'Cancelar',
		showLoaderOnConfirm: true,
		preConfirm: function () {
    		return new Promise(function (resolve, reject) {
    				
      			setTimeout(function() {

					$('#form_recibo').submit()

      				resolve()

      			}, 2000)
    		})
  		},
  		allowOutsideClick: false
	}).then(function (email) {

	  	swal({
	    	type: 'success',
	    	title: 'El pago se ha procesado exitosamente!',
	    	allowOutsideClick: false
	  	}).then(function(){

	  		location.reload()

	  	})
	})
})