@extends('layouts.platform')

@section('title')
	Estudiantes
@endsection

@section('content')
<div class="row">
	<div class="col l12">
		<h3 class="center">Módulo de Estudiantes</h3>
	</div>
</div>

<div class="row">

	<div class="col l12 s12">
		<div class="row">

			<form method="POST" action="{{ route('alumnos.buscar_alumno') }}">
				{{ csrf_field() }}
				<div class="col l4 s8">
					<input type="text" name="buscar_alumno" id="buscar_alumno" placeholder="Ingrese el nombre del alumno" required>
				</div>
				<div class="col l4 s4">
					<button title="Buscar un alumno" class="btn waves-effect waves-light" type="submit" name="action">
						Buscar <i class="material-icons right">search</i>
					</button>
				</div>
			</form>

			<div class="col l2 s6">
				@if($busqueda)
					<a href="{{ route('alumnos.index') }}" class="btn waves-effect waves-light">Ver todos</a>
				@endif
			</div>
			<div class="col l2 s6">
				<a class="waves-effect waves-light btn modal-trigger" name="#modal1" href="#modal1">Nuevo
					<i class="material-icons right">person_add</i>
				</a>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12 l12">
		<table class="centered">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Grado</th>
					<th>Nivel</th>
					<th>Sección</th>
					<th>Jornada</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($alumnos as $alumno)
					<tr>
						<td>{{ $alumno->nombre }} {{ $alumno->segundo_nombre }} {{ $alumno->apellido }} {{ $alumno->segundo_apellido }}</td>
						@if($alumno->grado)
						<td>{{ $alumno->grado->grado_pred->nombre }}</td>
						<td>
							{{ $alumno->grado->grado_pred->nivel->nombre }}
						</td>
						<td>{{ $alumno->grado->seccion }}</td>
						<td>{{ $alumno->grado->jornada->nombre }}</td>
						@else
							<td>--</td>
							<td>--</td>
							<td>--</td>
							<td>--</td>
						@endif
						<td>
							@if ($alumno->grado_id == null)
								<a class="btn" href="{{ route('platform.alumnos.inscribir', $alumno->id) }}" title="Inscribir">
									<i class=" small material-icons ">assignment_ind</i>
								</a>
							@else
								<a class="btn" href="{{ route('platform.alumnos.inscribir', $alumno->id) }}" title="Reinscribir">
									<i class="small material-icons ">mode_edit</i>
								</a>
							@endif
							{{-- Si el alumno no esta inscrito mostrar --}}
							<a class="btn" href="{{ route('alumnos.show', $alumno->id) }}" title="Ver Detalles">
								<i class="material-icons">details</i>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="row center">
	{{ $alumnos->links() }}
</div>

@endsection

@section('extras')
<!-- Modal -->
<div id="modal1" class="modal">
			<div class="modal-content">
				<h4>Nuevo Estudiante</h4>
				<form action="{{ route('alumnos.store') }}" method="POST" id="form-alumno">
					{{ csrf_field() }}
					<input type="hidden" name="sede_id" value="{{ Auth::user()->empleado->sede_id }}">
					<div class="row">
						<div class="input-field col l6 s12">
							<input type="text" name="nombre" id="nombre" placeholder="" required>
							<label for="nombre">Primer Nombre *</label>
						</div>
						<div class="input-field col l6 s12">
							<input type="text" name="segundo_nombre" id="nombre" placeholder="">
							<label for="nombre">Segundo Nombre</label>
						</div>
						<div class="input-field col l6 s12">
							<input type="text" name="apellido" id="apellido" placeholder="" required>
							<label for="apellido">Primer Apellido *</label>
						</div>
						<div class="input-field col l6 s12">
							<input type="text" name="segundo_apellido" id="apellido" placeholder="">
							<label for="apellido">Segundo Apellido</label>
						</div>
						<div class="input-field col l2 s12">
							<input type="text" name="edad" id="edad" placeholder="" value="">
							<label for="edad">Edad</label>
						</div>
						<div class="input-field col l4 s12">
							<input type="text" name="telefono" id="telefono" placeholder="" value="">
							<label for="">Telefono</label>
						</div>
						<div class="input-field col l6 s12">
							<input type="text" name="direccion" id="direccion" placeholder="" value="">
							<label for="">Dirección</label>
						</div>
					</div>
					<div class="row">
						<p>* Campos Obligatorios</p>
					</div>
				<div class="modal-footer">
					<button type="submit" name="enviar" class="modal-action waves-effect waves-green btn-flat ">Guardar</button>
				</div>
				</form>
			</div>
</div>
@endsection
