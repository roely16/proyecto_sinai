@extends('layouts.platform')

@section('title')
	Grados
@endsection

@section('content')


	<div class="row">
		<div class="col l1">
			<br>
			<a href="/plataforma/administracion" class="btn blue-grey darken-4" ><i class="material-icons center">arrow_back</i></a>
		</div>
		<div class="col l10">
			<h3 class="center">Módulo de Grados</h3>
		</div>
	</div>
	<div class="row">

		<div class="col l6 s12">
			<form action="{{ route('platform.grados_cursos.buscar_grado') }}" method="POST">
				{{ csrf_field() }}
				<div class="row">
					<div class="col l8 s7">
						<input type="text" name="nombre_buscar" value="" placeholder="Ingrese el nombre del grado" required>
					</div>
					<div class="col l4 s5">
						<button class="btn waves-effect waves-light" type="submit" name="action">
							Buscar <i class="material-icons right">search</i>
						</button>
					</div>
				</div>
			</form>
		</div>

			<div class="col l2 s6">
				@if($busqueda)
					<a href="{{ route('grados_cursos.index') }}" class="btn waves-effect waves-light">Ver todos</a>
				@endif
			</div>
		<div class="col l4 s12">
			<div class="row">
				<div class="col offset-l6">
					<a class="waves-effect waves-light btn modal-trigger" name="nuevo_colaborador" href="#modal_nuevo_grado">Nuevo
						<i class="material-icons right">add_circle</i>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col l12 s12">
			<table class="centered">
				<thead>
					<tr>
						<th>Ciclo</th>
						<th>Nombre</th>
						<th>Nivel</th>
						<th>Sección</th>
						<th>Jornada</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					@foreach($grados as $grado)
						<tr>
							<td>{{ $grado->ciclo_escolar }}</td>
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
								<a class="waves-effect waves-light btn" title="Ver Detalles" href="{{ route('grados_cursos.show', $grado->id) }}"><i class="material-icons">details</i>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="row center">
		{{ $grados->links() }}
	</div>

@endsection

@section('extras')
<div class="modal modal-fixed-footer" id="modal_nuevo_grado">
	<div class="modal-content">
		<h4>Nuevo Grado</h4>
		<div class="row">
			<form class="" action="{{ route('grados_cursos.store') }}" method="POST">
				{{ csrf_field() }}
				<input type="hidden" name="sede_id" id="sede_id" value="{{ Auth::user()->empleado->sede_id }}">
				<div class=" col l12">

					<label for="id_label_single">
  						Click para seleccionar el grado

					<select name="grado_pred_id" class="js-example-basic-single js-states form-control browser-default" style="width: 100%" id="id_label_single" required>
  							<option value="" disabled selected>Seleccione un grado</option>
  							@foreach ($grados_nivel as $nivel)
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

				</div>
					
				<div class="row"></div>
			
				<div class="input-field col l6">
					<input value="" type="text" name="seccion" id="seccion" value="" placeholder="" required>
					<label for="">Sección</label>
				</div>

				<div class="input-field col l6">
					<select class="" name="maestro_id" id="maestro_id">
						<option value="" selected disabled>-- Ninguno --</option>
						@foreach($maestros as $maestro)
							<option value="{{ $maestro->id }}">{{ $maestro->nombre }} {{ $maestro->apellido }}</option>
						@endforeach
					</select>
					<label for="">Catedratico Guía</label>
				</div>
				<div class="input-field col l6">
					<input type="text" name="ciclo_escolar" id="ciclo_escolar" placeholder="" value="" required>
					<label for="">Ciclo Escolar</label>
				</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" name="enviar" class="modal-action waves-effect waves-green btn-flat ">Guardar</a>
	</div>
	</form>
</div>
@endsection
