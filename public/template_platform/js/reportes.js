		$('#form_reporte_dia').submit(function(event){
			
			event.preventDefault()

			$.ajax({
				url: $('#form_reporte_dia').attr('action'),
				type: 'POST',
				data: $('#form_reporte_dia').serialize(),
				success: function(data) {
					
					var horas = ['07', '08', '09', '10', '11', '12', '13', '14', '15', '16']

					var total
					var gran_total 

					var totales = [];

					for (var i = 0; i < horas.length; i++) {
							
						if (data[horas[i]]) {
							
							total = 0

							for (var e = 0; e < data[horas[i]].length; e++) {

								total = total + data[horas[i]][e].total

							}	

							totales[i] = total	
						}else{
							totales[i] = 0
						}

					}

					var sum = totales.reduce(function(a, b) { return a + b; }, 0);

					$('#total_ingresos').text('Total de Ingresos: Q ' + sum);

					$("#div_total_ingresos").show();

					var grafica = document.getElementById('grafica');
					grafica.innerHTML = '&nbsp;';
					$('#grafica').append('<canvas id="myChart" width="1000" height="300"><canvas>');

					var ctx = document.getElementById("myChart").getContext('2d');

					var myChart = new Chart(ctx, {
			    		type: 'bar',
			    		data: {
					        labels: ['7:00', '8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'],
					        datasets: [{
					            label: 'Ingresos por Hora',
					            data: totales,
					            backgroundColor: [
					            	'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)'
					            ],
					            borderColor: [
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)'
					            ],
					            borderWidth: 1
					        }]
					    },
			    		options: {
					        scales: {
					            yAxes: [{
					                ticks: {
					                    beginAtZero:true
					                }
					            }]
					        }
					    }
					});
				}
			});
		})

		$('#form_reporte_mes').submit(function(event){
			event.preventDefault()

			$.ajax({
				url: $('#form_reporte_mes').attr('action'),
				type: 'POST',
				data: $('#form_reporte_mes').serialize(),
				success: function(data) {
					
					var dias = ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31']

					var totales = []	

					for (var i = 0; i < dias.length; i++) {
							
						if (data[dias[i]]) {
							
							total = 0

							for (var e = 0; e < data[dias[i]].length; e++) {

								total = total + data[dias[i]][e].total

							}	

							totales[i] = total	
						}else{
							totales[i] = 0
						}
					}

					var sum = totales.reduce(function(a, b) { return a + b; }, 0);

					$('#total_ingresos').text('Total de Ingresos: Q ' + sum);

					$("#div_total_ingresos").show();

					var grafica = document.getElementById('grafica');
					grafica.innerHTML = '&nbsp;';
					$('#grafica').append('<canvas id="myChart" width="1000" height="300"><canvas>');

					var ctx = document.getElementById("myChart").getContext('2d');

					var myChart = new Chart(ctx, {
			    		type: 'bar',
			    		data: {
					        labels: dias,
					        datasets: [{
					            label: 'Ingresos por Dia',
					            data: totales,
					            backgroundColor: [
					                
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)'
					                
					            ],
					            borderColor: [
					            	'rgba(54, 162, 235, 0.2)',
					            	'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(54, 162, 235, 0.2)'
					                
					            ],
					            borderWidth: 1
					        }]
					    },
			    		options: {
					        scales: {
					            yAxes: [{
					                ticks: {
					                    beginAtZero:true
					                }
					            }]
					        }
					    }
					});
				}
			});

		})
		