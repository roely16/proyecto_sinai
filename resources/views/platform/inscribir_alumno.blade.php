@extends('layouts.platform')

@section('title')

	Inscribir Alumno

@endsection

@section('content')

	<div class="row">
		<div class="col l12 s12">
			<div class="card white">
				<div class="card-content black-text">
					<div class="row">
						<div class="row">
							<div class="col l1 s7">
								<br>
								<a href="{{ route('alumnos.index') }}" class="btn blue-grey darken-4"><i class="material-icons center">arrow_back</i></a>
							</div>
							<div class="col l10">
								<h5 class="center">Datos del Alumno</h5>	
							</div>	
						</div>
						
						<div class="row">
							
						
						<div class="input-field col l3 s12">
							<input type="text" name="" value="{{ $alumno->nombre }} {{ $alumno->segundo_nombre }} {{ $alumno->apellido }} {{ $alumno->segundo_apellido }}" placeholder="" readonly>
							<label>Nombre Completo</label>
						</div>
						<div class="input-field col l2 s12">
							<input type="text" name="" value="{{ $alumno->edad }}" placeholder="" readonly>
							<label>Edad</label>
						</div>
						<div class="input-field col l2 s12">
							<input type="text" name="" value="{{ $alumno->telefono }}" placeholder="" readonly>
							<label>Telefono</label>
						</div>
						<div class="input-field col l5 s12">
							<input type="text" name="" value="{{ $alumno->direccion }}" placeholder="" readonly>
							<label>Direccion</label>
						</div>
						<div class="input-field col l6">
							@if ($alumno->grado_id == null)
								<input type="text" placeholder="" value="No inscrito" readonly>	
							@else
								<input type="text" placeholder="" value="{{ $alumno->grado->grado_pred->nombre }} - {{ $alumno->grado->grado_pred->nivel->nombre }} / Sección {{ $alumno->grado->seccion }} / Jornada {{ $alumno->grado->jornada->nombre }}" readonly>
							@endif
							<label for="">Grado</label>
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

						@if ($alumno->grado_id == null)
							<h5 class="center">Inscripcion</h5>
						@else
							<h5 class="center">Reinscripcion</h5>
						@endif

						
						<form method="POST" id="inscribir_alumno" name="inscribir_alumno" action="{{ route('platform.alumnos.buscar_grados_ciclo') }}">
							{{ csrf_field() }}
							<input type="hidden" name="alumno_id" id="alumno_id" value="{{ $alumno->id }}">
							<div class="input-field col l4 s10">
								<input type="text" name="ciclo" id="ciclo" value="{{ $ciclo }}" placeholder required>
								<label>Ciclo Escolar</label>
							</div>
							<div class="col l8">
								<br>
								<button type="submit" href="" class="btn">Buscar Grados
									<i class="material-icons right">search</i>
								</button>
							</div>
						</form>
					</div>

					@if ($busqueda_grados == true)
						{{-- expr --}}
					
					<div class="row">
						<table class="centered">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Nivel</th>
									<th>Seccion</th>
									<th>Jornada</th>
								</tr>
							</thead>
							<tbody>
								@foreach($grados as $grado)
									<tr>
										<td>{{ $grado->nombre }}</td>
										<td>
											@if ($grado->nivel_id == 1)
												Preprimaria
											@elseif ($grado->nivel_id == 2)
												Primaria
											@elseif ($grado->nivel_id == 3)
												Básico
											@elseif ($grado->nivel_id == 4)
												Diversificado
											@endif
										</td>
										<td>{{ $grado->seccion }}</td>
										<td>
											@if($grado->jornada_id == 1)
												Matutina
											@elseif($grado->jornada_id == 2)
												Fin de Semana
											@endif
										</td>
										<td>
											@if ($alumno->grado_id == null)
												<a id="inscribir" name="inscribir" class="inscribir waves-effect waves-light btn" href="{{ route('platform.alumnos.asignar_grado', [$grado->id, $alumno->id]) }}">	Inscribir
												</a>
											@else
												<a id="inscribir" name="inscribir" class="inscribir waves-effect waves-light btn" href="{{ route('platform.alumnos.asignar_grado', [$grado->id, $alumno->id]) }}">
													Reinscribir
												</a>
											@endif
											
										</td>
									</tr>
								@endforeach	
							</tbody>
						</table>

						

					</div>
					@endif

				</div>
			</div>
		</div>
	</div>
	
@endsection

@section('scripts_final')
	<script src="{{ asset('template_platform/js/inscribir_reinscribir.js') }}"></script>
@endsection