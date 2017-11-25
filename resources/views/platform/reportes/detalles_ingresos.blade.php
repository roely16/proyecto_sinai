@extends('layouts.platform')

@section('title')

	Detalle de Ingresos

@endsection

@section('content')

	<div class="row">
		<div class="col l2">
			<br>
			<a href="{{  route('reportes.ver_modulo') }}" class="btn blue-grey darken-4"><i class="material-icons center">arrow_back</i></a>
		</div>
		<div class="col l10">
			<h5 class="right">Reporte de Ingresos - {{ $fecha_reporte }}</h5>
		</div>
	</div>

	<div class="row">
	    <div class="col s12">
		    <ul class="tabs tabs-fixed-width">
		    	<li class="tab col s3"><a class="active" href="#test1">Mensualidades y Anualidades</a></li>
		        <li class="tab col s3"><a href="#test2">Otros</a></li>
		    </ul>
	    </div>
	    <div id="test1" class="col s12">
	    	<div class="row">
				<div class="col l12">
					<table class="centered highlight">
						<thead>
							<tr>
								<th width="35%">Concepto</th>
								<th width="10%">Monto</th>
								<th width="25%">Alumno</th>
								<th width="10%">No. Recibo</th>
								<th width="20%">Fecha</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($pagos as $pago)

								<tr>
									<td>{{ $pago->concepto }}</td>
									<td>Q{{ $pago->monto }}</td>
									<td>{{ $pago->alumno->nombre}} {{ $pago->alumno->segundo_nombre}} {{ $pago->alumno->apellido}} {{ $pago->alumno->segundo_apellido}}</td>
									<td>A-{{ $pago->recibo_id}}</td>
									<td>{{ $pago->created_at }}</td>
								</tr>

							@endforeach
						</tbody>
					</table>
				</div>
			</div>
	    </div>
	    <div id="test2" class="col s12">
	    	<div class="row">
				<div class="col l12">
					<table class="centered highlight">
						<thead>
							<tr>
								<th width="35%">Concepto</th>
								<th width="10%">Monto</th>
								<th width="25%">Alumno</th>
								<th width="10%">No. Recibo</th>
								<th width="20%">Fecha</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($otros_pagos as $pago_)

								<tr>
									<td>{{ $pago_->concepto }}</td>
									<td>Q{{ $pago_->monto }}</td>
									<td>{{ $pago_->alumno->nombre}} {{ $pago_->alumno->segundo_nombre}} {{ $pago_->alumno->apellido}} {{ $pago_->alumno->segundo_apellido}}</td>
									<td>B-{{ $pago_->recibo_id}}</td>
									<td>{{ $pago_->created_at }}</td>
								</tr>

							@endforeach
						</tbody>
					</table>
				</div>
			</div>
	    </div>
  	</div>

	

@endsection