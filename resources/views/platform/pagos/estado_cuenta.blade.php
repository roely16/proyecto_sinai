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
									<th>Concepto</th>
									<th>Monto</th>
									<th>Recibo</th>
									<th>Fecha</th>
								</tr>
							</thead>
							<tbody>
								@if ($pagos->count() > 0)
									@foreach ($pagos as $pago)
										<tr>
											<td>{{ $pago->concepto }}</td>
											<td>Q {{ $pago->monto }}.00</td>
											<td>No. {{ $pago->recibo_id }}</td>
											<td>{{ $pago->created_at }}</td>
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

				<div class="row center">
					{{ $pagos->links() }}
				</div>
			</div>
		</div>
	</div>	
</div>


@endsection