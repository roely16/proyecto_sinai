@extends('layouts.platform')

@section('title')

	Generar Pago

@endsection

@section('content')

<div class="row">
	<div class="col l12 s12">
		<div class="card white">
			<div class="card-content black-text">
				<div class="row">
					<div class="col l1">
						<br>
						<a href="javascript:history.back();" class="btn blue-grey darken-4"><i class="material-icons center">arrow_back</i></a>
					</div>
					<div class="col l10">
						<h5 class="center">Datos del Alumno</h5>
					</div>
					<div class="input-field col l4">
						<input type="text" value="{{ $alumno->nombre }} {{ $alumno->segundo_nombre }} {{ $alumno->apellido }} {{ $alumno->segundo_apellido }}" placeholder="" readonly>
						<label for="">Nombre Completo</label>
					</div>
					<div class="input-field col l6">
						<input type="text" value="{{ $alumno->grado->grado_pred->nombre }} {{ $alumno->grado->grado_pred->nivel->nombre }} / Sección {{ $alumno->grado->seccion }} / Jornada {{ $alumno->grado->jornada->nombre }}" placeholder="" readonly>
						<label for="">Grado</label>
					</div>
					<div class="input-field col l2">
						<input type="text" value="{{ $alumno->grado->ciclo_escolar }}" placeholder="" readonly>
						<label for="">Ciclo Escolar</label>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>



<div class="row">
	<div class="col l12">
		<div class="card white">
			<div class="card-content black-text">
				<div class="row">
			    <div class="col s12">
			    	<ul class="tabs tabs-fixed-width">
				        <li class="tab col s3"><a class="active" href="#test1">Mensualidades e Inscripción</a></li>
				        <li class="tab col s3"><a href="#test2">Otros</a></li>

			      	</ul>
			    </div>
				    <div id="test1" class="col l12">
				    	<br>
				    	<div class="row">
				    		<div class="col l4">
				    			<br>
				    			<div class="row">
									<div class="col l12">
										<a class="waves-effect waves-light btn modal-trigger" href="#modal_mensualidades" id="mensualidad" >Mensualidades</a>
									</div>
								</div>
								<div class="row">
									<div class="col l12">
										<a class="waves-effect waves-light btn modal-trigger" href="#modal_especiales" id="especial">Pagos Anuales</a>
									</div>
								</div>
				    		</div>

				    		<div class="col l8">
				    			<form action="{{ route('pagos.procesar_pago') }}" method="POST" id="form_recibo">
									{{ csrf_field() }}
									<input type="hidden" name="alumno_id" value="{{ $alumno->id }}">
									<input type="hidden" name="ciclo_escolar" value="{{ $alumno->grado->ciclo_escolar }}" placeholder="" readonly>
									<div class="col l12">
										<div class="card white hoverable">
											<div class="card-content black-text">
												<div class="row">
													<table class="highlight" id="pagos" name="recibo">
														<thead>
															<tr>
																<th>Concepto</th>
																<th>Monto</th>
															</tr>
														</thead>
														<tbody name="recibo_pagos">
															
														</tbody>
														<tfoot style="text-align:center" name="recibo_total">
															
														</tfoot>
													</table>
												</div>
												<div class="row" id="botones_recibo" style="display:none">
													<div class="col l6 offset-l6">
														<a href="#" id="limpiar_recibo" class="btn red darken-4">Limpiar</a>
														<a id="enviar_recibo" class="btn blue darken-4">Procesar</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
				    		</div>
				    	</div>
				    </div>

				    <div id="test2" class="col s12">
				    	<div class="row">
							<br>
							<div class="row">
								
								<div class="col l4">
									<br>
									<br>
									<div class="col l12">
										<a class="waves-effect waves-light btn modal-trigger" href="#modal_otros" id="otro">Otros Pagos</a>
									</div>
								</div>

								<div class="col l8">
									<form action="{{ route('pagos.procesar_pago_otro') }}" method="POST" id="form_recibo2">
										{{ csrf_field() }}
										<input type="hidden" name="alumno_id" value="{{ $alumno->id }}">
										<input type="hidden" name="ciclo_escolar" value="{{ $alumno->grado->ciclo_escolar }}" placeholder="" readonly>
										<div class="col l12">
											<div class="card white hoverable">
												<div class="card-content black-text">
													<div class="row">
														<table class="highlight" id="pagos2" name="recibo">
															<thead>
																<tr>
																	<th>Concepto</th>
																	<th>Monto</th>
																</tr>
															</thead>
															<tbody name="recibo_pagos">
																
															</tbody>
															<tfoot style="text-align:center" name="recibo_total">
																
															</tfoot>
														</table>
													</div>
													<div class="row" id="botones_recibo2" style="display:none">
														<div class="col l6 offset-l6">
															<a href="#" id="limpiar_recibo2" class="btn red darken-4">Limpiar</a>
															<a id="enviar_recibo2" class="btn blue darken-4">Procesar</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
				    </div>
  				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('extras')

<!-- Modal para pagos mensuales -->
<div id="modal_mensualidades" class="modal">
	<div class="modal-content">
    	<h4>Mensualidad</h4>
    	<div class="row">
    		<div class="input-field col l12">
    			<select id="mes">
    				@foreach ($mensualidades as $mensualidad)
						<option value="{{ $mensualidad->id }}" mes="{{ $mensualidad->nombre }}" monto="{{ $mensualidad->monto }}">{{ $mensualidad->nombre }} - Q. {{ $mensualidad->monto }}
						</option>
    				@endforeach
    			</select>
    			<label for="">Mes</label>
    		</div>

    	</div>
    </div>
    <div class="modal-footer">
      	<a id="agregar_mensualidad" href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agregar</a>
    </div>
</div>

<!-- Modal para pagos especiales -->
<div id="modal_especiales" class="modal">
	<div class="modal-content">
    	<h4>Pago Anual</h4>
    	<div class="row">
    		<div class="input-field col l12">
    			<select id="concepto_anualidad">
					@if ($pagos_anuales == "")
						<option value="">No tiene pagos pendientes</option>
					@else
						@foreach ($pagos_anuales as $pago_anual)
							<option value="{{ $pago_anual->id }}" concepto="{{ $pago_anual->nombre }}" monto="{{ $pago_anual->monto }}">{{ $pago_anual->nombre }} - Q. {{ $pago_anual->monto }}</option>
						@endforeach	
					@endif
							
    			</select>
    			<label for="">Tipo de Pago</label>
    		</div>
    	</div>
    </div>
    <div class="modal-footer">
      	<a id="agregar_pago_anual" href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agregar</a>
    </div>
</div>

<!-- Modal para otros pagos -->
<div id="modal_otros" class="modal">
	<div class="modal-content">
    	<h4>Otros</h4>
    	<div class="row">
    		<div class="input-field col l9">
	    		<input type="text" placeholder="" id="concepto_pago">
	    		<label for="">Concepto</label>
	    	</div>
	    	<div class="input-field col l3">
	    		<input type="text" placeholder="" id="monto_pago">
	    		<label for="">Monto</label>
	    	</div>
    	</div>
    </div>
    <div class="modal-footer">
      	<a id="agregar_otro_pago" href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agregar</a>
    </div>
</div>


@endsection

@section('scripts_final')

	<script src="{{ asset('template_platform/js/pago_mensualidad.js') }}"></script>
	<script src="{{ asset('template_platform/js/pago_otro.js') }}"></script>
	<script src="{{ asset('template_platform/js/pago_especial.js') }}"></script>
	<script src="{{ asset('template_platform/js/limpiar_procesar_pago.js') }}"></script>

@endsection