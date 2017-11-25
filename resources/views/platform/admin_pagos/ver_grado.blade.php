@extends('layouts.platform')

@section('title')

	Ver Grado

@endsection

@section('content')

	<div class="row">
		<div class="col l1">
			<br>
			<a href="{{ route('admin_pagos.ver_modulo') }}" class="btn blue-grey darken-4" ><i class="material-icons center">arrow_back</i></a>
		</div>
		<div class="col l10">
			<h5 class="center">Editar Pagos - {{ $grado->nombre }} {{ $grado->nivel->nombre }} / Jornada {{ $grado->jornada->nombre }}</h5>
		</div>
		<div class="col l5">
			
		</div>
	</div>

	<div class="row">
		<div class="row">
		    <div class="col s12">
		    	<ul class="tabs tabs-fixed-width">
			        <li class="tab col s3"><a class="active" href="#test1">Pagos Mensuales</a></li>
			        <li class="tab col s3"><a href="#test2">Pagos Anuales</a></li>
		      	</ul>
		    </div>
			

		    <div id="test1" class="col s12">
		    	<div class="row">
					<div class="col l3 right">
						<br>
						<a href="#modal_nuevo_pago" class="btn modal-trigger">Nuevo Pago<i class="material-icons right">add_circle</i>
						</a>
					</div>
				</div>
		    	<div class="row">
		    		<table class="highlight centered">
			    		<thead>
			    			<tr>
			    				<th>Concepto</th>
			    				<th>Monto Q.</th>
			    				<th>Acción</th>
			    			</tr>
			    		</thead>
			    		<tbody>
			    			@foreach ($mensualidades as $mensualidad)
			    				<tr>
			    					<td style="width: 50%">{{ $mensualidad->nombre }}</td>
			    					<td style="width: 30%">
			    						<input class="edit" type="text" value="{{ $mensualidad->monto }}" style="text-align: center" readonly>
			    					</td>
			    					<td>
			    						<a id="boton_editar" title="Editar Pago" href="{{ route('admin_pagos.cambir_valor_pago', $mensualidad->id) }}" class="editar btn blue darken-4 "><i class="material-icons icon_edit">edit</i></a>
			    					</td>
			    				</tr>
			    			@endforeach
			    		</tbody>
			    	</table>
		    	</div>
		    </div>
		    <div id="test2" class="col s12">
				<div class="row">
					<div class="col l3 right">
						<br>
						<a href="#modal_nuevo_pago_anual" class="btn modal-trigger">Nuevo Pago<i class="material-icons right">add_circle</i>
						</a>
					</div>
		    		<table class="highlight centered">
			    		<thead>
			    			<tr>
			    				<th>Concepto</th>
			    				<th>Monto</th>
			    				<th>Acción</th>
			    			</tr>
			    		</thead>
			    		<tbody>
			    			@foreach ($anualidades as $anualidad)
			    				<tr>
			    					<td style="width: 50%">{{ $anualidad->nombre }}</td>
			    					<td style="width: 30%">
			    						<input class="edit" type="text" value="{{ $anualidad->monto }}" style="text-align: center" readonly>
			    					</td>
			    					<td>
			    						<a id="boton_editar" title="Editar Pago" href="{{ route('admin_pagos.cambir_valor_pago', $anualidad->id) }}" class="editar btn blue darken-4 "><i class="material-icons icon_edit">edit</i></a>
			    					</td>
			    				</tr>
			    			@endforeach
			    		</tbody>
			    	</table>
		    	</div>
		    </div>
	  	</div>
	</div>

@endsection

@section('extras')
	<div id="modal_nuevo_pago" class="modal">
		<form action="{{ route('admin_pagos.nuevo_pago')}}" method="POST">
			{{ csrf_field() }}
			<input type="hidden" value="{{ $grado->id}}" name="grado_pred_id">
		    <div class="modal-content">
		    	<h4 class="center">Agregar Nuevo Pago Mensual</h4>
		    	<div class="row">
		    		<div class="input-field col l8">
		    			<input type="text" name="nombre" placeholder="" required>
		    			<label for="">Concepto</label>
		    		</div>
		    		<div class="input-field col l4">
		    			<input type="text" name="monto" placeholder="" required>
		    			<label for="">Monto Q.</label>
		    		</div>
		    	</div>
		    </div>
		    <div class="modal-footer">
		      	<button type="submit" class="modal-action waves-effect waves-green btn-flat">Agregar</button>
		    </div>
	    </form>
  	</div>

  	<div id="modal_nuevo_pago_anual" class="modal">
  		<form action="{{ route('admin_pagos.nuevo_pago_anual') }}" method="POST">
  			{{ csrf_field() }}
  			<input type="hidden" value="{{ $grado->id}}" name="grado_pred_id">
		    <div class="modal-content">
		    	<h4 class="center">Agregar Nuevo Pago Anual</h4>
		    	<div class="row">
		    		<div class="input-field col l8">
		    			<input type="text" name="nombre" placeholder="">
		    			<label for="">Concepto</label>
		    		</div>
		    		<div class="input-field col l4">
		    			<input type="text" name="monto" placeholder="">
		    			<label for="">Monto Q.</label>
		    		</div>
		    	</div>
		    </div>
		    <div class="modal-footer">
		      	<button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">Agregar</button>
		    </div>
	    </form>
  	</div>
@endsection

@section('scripts_final')
	<script>
	$(".editar").click(function(event) {
		event.preventDefault()

		const td = $(this).parent()
		const input = td.prev().children(1) 
		const icon = $(this).children()

		if (icon.text() == 'save') {

			//Restaura el boton de editar
			$(this).removeClass("btn green darken-1").addClass("btn blue darken-4")
			$(icon).text('edit')

			console.log()

			
			//Envio del formulario para Actualizar
			$.ajax({
				url: $(this).attr('href') + '/' + input.val(),
				type: 'GET',
				success: function(data) {
					console.log(data);

					//Mostrar mensaje de cambios guardados
					/*
					swal({
						title: 'Actualización Exitosa',
						text: 'Todos los cambios han sido guardados',
						type: 'success',
						timer: 2000,
						showConfirmButton: true
					})
					*/

				}
			});
			
			//Deshabilitar los input
			enabled_disabled(input)
			

		} else {
			
			//Habilita los input
			enabled_disabled(input)

			//Mostrar mensaje de habilitacion
			/*
			swal({
				title: 'Edición Activada',
				text: 'Puede modificar el valor del pago',
				type: 'info',
				timer: 2000,
				showConfirmButton: true
			})
			*/
			

			//Cambia el boton editar por el de guardar
			$(this).removeClass("btn blue darken-4").addClass("btn green darken-1")
			icon.text('save')
		}


	})

	

	function enabled_disabled(input) {
		if (input.attr('readonly')) {
			input.removeAttr('readonly');
		} else {
			input.prop('readonly', true);
		}
		
	}


	</script>
@endsection




