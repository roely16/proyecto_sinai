@extends('layouts.platform')

@section('title')

	Pagos

@endsection

@section('content')

<div class="row">
	<div class="col l12">
		<h3 class="center">Módulo de Pagos</h3>
	</div>
</div>

<div class="row">
	<div class="col l12">
		<form action="{{ route('pagos.buscar_alumno') }}" method="POST">
			{{ csrf_field() }}
			<div class="col l4 s8">
				<input type="text" name="buscar_alumno" id="buscar_alumno" value="{{ $termino_busqueda }}" placeholder="Ingrese el nombre del alumno" required>
			</div>
			<div class="col l4 s4">
				<button title="Buscar un alumno" class="btn waves-effect waves-light" type="submit" name="action">
					Buscar <i class="material-icons right">search</i>
				</button>
			</div>
		</form>
	</div>
</div>


@if ($busqueda)
	
	<div class="row">
		<div class="col l12">
			<table class="centered">
				<thead>
					<tr>
						<th>Nombre del Alumno</th>
						<th>Grado</th>
						<th>Nivel</th>
						<th>Sección</th>
						<th>Jornada</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					@if ($alumnos->count() > 0)
						@foreach ($alumnos as $alumno)
							@if ($alumno->grado_id != null)
								<tr>
									<td>{{ $alumno->nombre }} {{ $alumno->segundo_nombre }} {{ $alumno->apellido }} {{ $alumno->segundo_apellido }}</td>
									<td>{{ $alumno->grado->grado_pred->nombre }}</td>
									<td>{{ $alumno->grado->grado_pred->nivel->nombre }}</td>
									<td>{{ $alumno->grado->seccion }}</td>
									<td>{{ $alumno->grado->jornada->nombre }}</td>
									<td>
										<a href="{{ route('pagos.generar_pago', $alumno->id) }}" class="btn" title="Realizar Pagos">
											<i class="material-icons">payment</i>
										</a>
										<a href="{{ route('pagos.estado_cuenta', $alumno->id) }}" class="btn" title="Estado de Cuenta">
											<i class="material-icons">details</i>
										</a>
									</td>
								</tr>
							@else
								<tr>
									<td>{{ $alumno->nombre }} {{ $alumno->segundo_nombre }} {{ $alumno->apellido }} {{ $alumno->segundo_apellido }}</td>
									<td>No inscrito</td>
									<td>--</td>
									<td>--</td>
									<td>--</td>
									<td>--</td>
								</tr>
							@endif
						@endforeach
					@else
						<tr>
							<td>-- No se encontraron resultados --</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
@endif


@endsection