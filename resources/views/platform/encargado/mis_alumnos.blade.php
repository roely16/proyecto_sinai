@extends('layouts.platform')

@section('title')
	Alumnos
@endsection

@section('content')
<div class="row">

</div>

@foreach ($alumnos as $alumno)

	<div class="row">
		<div class="col l12">
			<div class="card horizontal">
				<div class="card-image">
					<img  width="200" height="200" alt="" src="{{ asset('template_platform/img/icon_student.png') }}">
				</div>
				<div class="card-stacked">
					<div class="card-content">
						<div class="input-field col l6">
							<input type="text" name="" value="{{ $alumno->alumno->nombre }} {{ $alumno->alumno->segundo_nombre }} {{ $alumno->alumno->apellido }} {{ $alumno->alumno->segundo_apellido }}" placeholder="" readonly>
							<label for="">Nombre Completo</label>
						</div>
						<div class="input-field col l6">
							@if ($alumno->alumno->grado)
								<input type="text" name="" value="{{ $alumno->alumno->grado->grado_pred->nombre }} - {{ $alumno->alumno->grado->grado_pred->nivel->nombre }} / Sección {{ $alumno->alumno->grado->seccion }} / Jornada {{ $alumno->alumno->grado->jornada->nombre }}" placeholder="" readonly>
							@else
								<input type="text" value="No Inscrito">
							@endif
							
							<label for="">Grado</label>
						</div>
						<div class="input-field col l4">
							<input type="text" name="" value="{{ $alumno->alumno->telefono }}" placeholder="" readonly>
							<label for="">Telefono</label>
						</div>
						<div class="input-field col l6">
							<input type="text" name="" value="{{ $alumno->alumno->direccion }}" placeholder="" readonly>
							<label for="">Direccion</label>
						</div>
						<div class="input-field col l2">
							<input type="text" name="" value="{{ $alumno->alumno->edad }}" placeholder="" readonly>
							<label for="">Edad</label>
						</div>
						
					</div>
					<div class="card-action">
						<a href="{{ route('encargado.detalle_alumno', $alumno->alumno_id) }}">Ver Detalles</a>
					</div>
				</div>
			</div>
		</div>
	</div>

@endforeach

@endsection
