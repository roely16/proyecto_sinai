$('#agregar_mora').click(function(event){
	event.preventDefault()

	const otro = $('#concepto_pago').val()
	const monto = $('#monto_pago').val()

	$("#pagos").find('tbody')
		.append($('<tr>')
			.append($('<td>')
				.append(otro)
			)
			.append($('<td>')
				.append(monto)
			)
		)

	$("#pagos").find('tbody')
		.append($('<tr style="display:none;">')
			.append($('<td>')
				.append('<input type="hidden" value="'+ otro +'"  name="concepto_otro[]" readonly>')
			)
			.append($('<td>')
				.append('<input type="hidden" value="'+ monto +'" name="monto_otro[]" readonly>')
			)
		)

		$( "#botones_recibo" ).show()

	if ($('#fila_total').length == 0) {
		
		console.log('no existe la fila de total, colocarla y los botones de procesar y limpiar')
		
		$("#pagos").find('tfoot')
			.append($('<tr id="fila_total">')
				.append($('<td>')
					.append('<input type="hidden" value="'+monto+'" id="total" name="total" readonly>')
					.append('<b>Total a pagar</b>')
				)
				.append($('<td id="monto_total">')
					.append($('#monto_pago').val())
				)
		);

	}else{

		//Sumar el monto total mas el nuevo agregado
		$monto_total = parseInt($('#monto_total').text()) + parseInt(monto)

		//Actualizar el monto
		$('#monto_total').text($monto_total)
		$('#total').val($monto_total)

	}

})

