$('#agregar_otro_pago').click(function(event){
	event.preventDefault()

	const otro = $('#concepto_pago_otro').val()
	const monto = $('#monto_pago_otro').val()

	$("#pagos2").find('tbody')
		.append($('<tr>')
			.append($('<td>')
				.append(otro)
			)
			.append($('<td>')
				.append(monto)
			)
		)

	$("#pagos2").find('tbody')
		.append($('<tr style="display:none;">')
			.append($('<td>')
				.append('<input type="hidden" value="'+ otro +'"  name="concepto_otro[]" readonly>')
			)
			.append($('<td>')
				.append('<input type="hidden" value="'+ monto +'" name="monto_otro[]" readonly>')
			)
		)

		$( "#botones_recibo2" ).show()

	if ($('#fila_total2').length == 0) {
		
		console.log('no existe la fila de total, colocarla y los botones de procesar y limpiar')
		
		$("#pagos2").find('tfoot')
			.append($('<tr id="fila_total2">')
				.append($('<td>')
					.append('<input type="hidden" value="'+ monto +'" id="total2" name="total" readonly>')
					.append('<b>Total a pagar</b>')
				)
				.append($('<td id="monto_total2">')
					.append($('#monto_pago_otro').val())
				)
		);

	}else{

		//Sumar el monto total mas el nuevo agregado
		$monto_total2 = parseInt($('#monto_total2').text()) + parseInt(monto)

		//Actualizar el monto
		$('#monto_total2').text($monto_total2)
		$('#total2').val($monto_total2)

	}

})

