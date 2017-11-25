@extends('layouts.platform')

@section('title')
  Detalle Alumno
@endsection

@section('content')
  <div class="row">
	 <div class="col l1">
		<br>
		<a href="{{ route('encargado.mis_alumnos') }}" class="btn blue-grey darken-4">
		  <i class="material-icons center" >arrow_back</i>
		</a>
	 </div>
	 <div class="col l11">
	 	<h5 class="right">Alumno: {{ $alumno->nombre }} {{ $alumno->segundo_nombre}} {{ $alumno->apellido}} {{ $alumno->segundo_apellido}} Grado: {{ $alumno->grado->grado_pred->nombre }} {{ $alumno->grado->grado_pred->nivel->nombre }} / Sección {{ $alumno->grado->seccion }} / Jornada {{ $alumno->grado->jornada->nombre }}</h5>
	 </div>
  </div>

  <div class="row">
	 <div class="col l12">
		<div class="card white">
		  <div class="card-content black-text">
			 <h5 class="center">Reportes</h5>
			 <div class="row">
			 	<table class="centered">
			 		<thead>
			 			<tr>
			 				<th style="width: 25%;">Asunto</th>
			 				<th style="width: 25%;">Mensaje</th>
			 				<th style="width: 25%;">De</th>
			 				<th style="width: 25%;">Fecha</th>
			 			</tr>
			 		</thead>
			 		<tbody>
			 			@foreach ($reportes as $reporte)

							<tr>
								<td>{{ $reporte->asunto }}</td>
								<td>{{ $reporte->mensaje }}</td>
								<td >
									@if ($reporte->empleado->tipo_empleado_id == 1 || $reporte->empleado->tipo_empleado_id == 2)
										Dirección: {{ $reporte->empleado->nombre }} {{ $reporte->empleado->apellido}}
									
									@endif
								</td>
								<td >{{ $reporte->created_at }}</td>
							</tr>

			 			@endforeach
			 		</tbody>
			 	</table>
			 </div>
		  </div>
		</div>
	 </div>
  </div>

  <div class="row">
	 <div class="col l12">
		<div class="card white">
		  <div class="card-content black-text">
			 <h5 class="center">Estado de Cuenta</h5>
			 <div class="row">
		    <div class="col s12">
		      <ul class="tabs tabs-fixed-width">
		        	<li class="tab col s3"><a class="active" href="#test1">Pagos realizados - Mensualidades</a></li>
		        	<li class="tab col s3"><a href="#test2">Pagos realizados - Otros</a></li>
		        	<li class="tab col s3"><a href="#test3">Pagos pendientes</a></li>

		      </ul>
		   </div>
		   <div id="test1" class="col s12">
		   		<table class="centered">
					<thead>
						<tr>
							<th>Concepto</th>
							<th>Monto</th>
							<th>Fecha</th>
						</tr>
					</thead>
					<tbody>
						@if ($pagos_realizados->count() > 0)
							@foreach ($pagos_realizados as $pago)
								<tr>
									<td width="40%">{{ $pago->concepto }}</td>
									<td width="20%">Q {{ $pago->monto }}.00</td>
									<td width="40%">{{ $pago->created_at }}</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td>-- Aun no se han registrado pagos --</td>
							</tr>
						@endif
					</tbody>
				</table>
		   </div>

		   <div id="test2" class="col s12">
		   		<table class="centered">
					<thead>
						<tr>
							<th>Concepto</th>
							<th>Monto</th>
							<th>Fecha</th>
						</tr>
					</thead>
					<tbody>
						@if ($otros_pagos->count() > 0)
							@foreach ($otros_pagos as $otro_pago)
								<tr>
									<td width="40%">{{ $otro_pago->concepto }}</td>
									<td width="20%">Q {{ $otro_pago->monto }}.00</td>
									<td width="40%">{{ $otro_pago->created_at }}</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td>-- Aun no se han registrado pagos --</td>
							</tr>
						@endif
					</tbody>
				</table>
		   </div>

		   <div id="test3" class="col s12">
		   		<div class="row">
		   			<h5 class="center">Mensualidades</h5>
		   			<table class="centered">
			   			<thead>
			   				<tr>
			   					<th style="width: 75%;">Concepto</th>
			   					<th style="width: 25%;">Monto</th>
			   				</tr>
			   			</thead>
			   			<tbody>
			   				@foreach ($mensualidades as $mensualidad)

								<tr>
									<td>Mensualidad de {{ $mensualidad->nombre }}</td>
									<td>Q {{ $mensualidad->monto}}</td>
								</tr>
						
			   				@endforeach
			   			</tbody>
		   			</table>
		   		</div>
		   		<div class="row">
		   			<h5 class="center">Pagos Especiales</h5>
		   			<table class="centered">
			   			<thead>
			   				<tr>
			   					<th style="width: 75%;">Concepto</th>
			   					<th style="width: 25%;">Monto</th>
			   				</tr>
			   			</thead>
			   			<tbody>
			   				@foreach ($pagos_anuales as $anualidad)

								<tr>
									<td>{{ $anualidad->nombre }}</td>
									<td>Q {{ $anualidad->monto}}</td>
								</tr>
						
			   				@endforeach
			   			</tbody>
		   			</table>

		   		</div>
		   </div>
		  	</div>
		  </div>
		</div>
	 </div>
  </div>
@endsection
