@extends('layouts.platform')

@section('title')

	Estado de Cuenta

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
    <div class="col s12">
    	<ul class="tabs tabs-fixed-width">
        	<li class="tab col s3"><a class="active" href="#test1">Mensualidades y Anualidades</a></li>
        	<li class="tab col s3"><a href="#test2">Otros Pagos</a></li> 
      	</ul>
    </div>

    <div id="test1" class="col s12">
    	<div class="row">
			<div class="col l12 s12">
				<div class="card white">
					<div class="card-content black-text">
						<div class="row">
							<div class="col l12">
								<h5 class="center">Pagos Realizados</h5>
							</div>
							<div class="col l12">
								<table class="centered">
									<thead>
										<tr>
											<th width="40%">Concepto</th>
											<th width="10%">Monto</th>
											<th width="10%">Recibo</th>
											<th width="30%">Fecha</th>
											@if (Auth::user()->tipo_usuario_id == 1)
												<th width="10%">Acción</th>
											@endif
										</tr>
									</thead>
									<tbody>
										@if ($pagos->count() > 0)
											@foreach ($pagos as $pago)
												<tr>
													<td>{{ $pago->concepto }}</td>
													<td>Q {{ $pago->monto }}.00</td>
													<td>{{ $pago->recibo->serie}}-{{ $pago->recibo_id }}</td>
													<td>{{ $pago->created_at }}</td>
													@if (Auth::user()->tipo_usuario_id == 1)
														<td width="10%"><a onclick="return confirm('Seguro que desea eliminar el pago?')" href="{{ route('pagos.eliminar_pago', ['id' => $pago->id, 'id_alumno' => $alumno->id])}}" class="btn red" title="Eliminar Pago"><i class="material-icons center">delete</i></a>
														</td>
													@endif
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
						</div>				
					</div>
				</div>
			</div>	
		</div>
    </div>

    <div id="test2" class="col s12">
    	<div class="row">
			<div class="col l12 s12">
				<div class="card white">
					<div class="card-content black-text">
						<div class="row">
							<div class="col l12">
								<h5 class="center">Pagos Realizados</h5>
							</div>
							<div class="col l12">
								<table class="centered">
									<thead>
										<tr>
											<th width="40%">Concepto</th>
											<th width="10%">Monto</th>
											<th width="10%">Recibo</th>
											<th width="30%">Fecha</th>
											@if (Auth::user()->tipo_usuario_id == 1)
												<th width="10%">Acción</th>
											@endif
										</tr>
									</thead>
									<tbody>
										@if ($pagos_->count() > 0)
											@foreach ($pagos_ as $pago_)
												<tr>
													<td>{{ $pago_->concepto }}</td>
													<td>Q {{ $pago_->monto }}.00</td>
													<td>{{ $pago_->recibo->serie}}-{{ $pago_->recibo_id }}</td>
													<td>{{ $pago_->created_at }}</td>
													@if (Auth::user()->tipo_usuario_id == 1)
														<td width="10%">
															<a onclick="return confirm('Seguro que desea eliminar el pago?')" href="{{ route('pagos.eliminar_pago_otro', ['id' => $pago_->id, 'id_alumno' => $alumno->id])}}" class="btn red" title="Eliminar Pago"><i class="material-icons center">delete</i></a>
														</td>
													@endif
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
						</div>
					</div>
				</div>
			</div>	
		</div>	
    </div>
</div>
@endsection
