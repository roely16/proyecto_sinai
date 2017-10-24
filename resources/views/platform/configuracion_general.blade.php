@extends('layouts.platform')

@section('title')
	Cursos
@endsection

@section('content')

	<div class="row">
		<div class="col l1">
			<br>
			<a href="/plataforma/administracion" class="btn blue-grey darken-4" ><i class="material-icons center">arrow_back</i></a>
		</div>
		<div class="col l10">
			<h3 class="center">Módulo de Cursos</h3>
		</div>
	</div>

	<div class="row">
		<div class="col l12">
			<form method="POST" action="{{ route('cursos_pred.mostrar_cursos') }}">
					{{ csrf_field() }}
					<div class="row">
						<div class="col l6 s6">
							<div class="input-field">
								<select class="" name="grado_id" id="grado_id" required>
									<option value="" disabled selected>Seleccione una opción</option>
									@foreach($niveles as $nivel)
										<optgroup label="{{ $nivel->nombre }}">
											@foreach ($nivel->grados as $grado)
												@if ($grado->jornada_id == 1)
													<option value="{{ $grado->id }}">{{ $grado->nombre }} - Matutina</option>
												@elseif($grado->jornada_id == 2)
													<option value="{{ $grado->id }}">{{ $grado->nombre }} - Fin de Semana</option>
												@elseif($grado->jornada_id == 3)
													<option value="{{ $grado->id }}">{{ $grado->nombre }} - Vespertina</option>
												@endif
											@endforeach
										</optgroup>
									@endforeach
								</select>
								<label for="">Grados</label>
							</div>
						</div>
						<div class="col l4 s6">
							<br>
							<button class="btn waves-effect waves-light" type="submit" name="button">Ver Cursos</button>
						</div>
					</div>
				</form>
		</div>				
	</div>


@if($cursos_lista)
	
	<div class="row">
					<div class="col l4 offset-l9 offset-s6">
						<a href="#modal_agregar_curso" class="btn waves-effect waves-light modal-trigger">Nuevo Curso
							<i class="material-icons right">add_circle</i>
						</a>
					</div>
				</div>

	<div class="row">
					<div class="col l12 s12">
						<table class="centered">
							<thead>
								<tr>
									<th>Curso</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>
								@if($cursos)
									@foreach($cursos as $curso)
									<tr>
										<td>{{ $curso->nombre }}</td>
										<td>
											<a id="eliminar" href="{{ route('cursos_pred.destroy', $curso->id) }}" class="eliminar btn red darken-4">
												<i class="material-icons center">delete</i>
											</a>
										</td>
									</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
				</div>
@endif

@endsection

@section('extras')
<div id="modal_agregar_curso" class="modal">
	<form method="POST" action="{{ route('cursos_pred.guardar_curso') }}" id="form_agregar_curso">
		{{ csrf_field() }}
		<div class="modal-content">
			<h4>Nuevo Curso</h4>
			@if($grado)
				<input type="hidden" name="grado_id" id="grado_id" value="{{ $grado_ }}">
			@endif
			<div class="input-field l12 s12">
				<input type="text" name="nombre" id="nombre" value="">
				<label for="">Nombre del curso</label>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">Guardar</button>
		</div>
	</form>
</div>

@endsection

@section('scripts_final')
	<script src="{{ asset('template_platform/js/eliminar.js') }}"></script>
@endsection
