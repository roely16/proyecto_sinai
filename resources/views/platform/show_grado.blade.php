@extends('layouts.platform') @section('title') Cursos @endsection @section('content')
<div class="row">
	<div class="col l12 s12">
		<div class="card white">
			<div class="card-content black-text">

				<div class="row">
					<div class="col l1 s7">
						<!-- Boton de regresar -->
						<br>
						<a href="{{  route('grados_cursos.index') }}" class="btn blue-grey darken-4"><i class="material-icons center">arrow_back</i></a>
					</div>
					<div class="col l8">
						<h4 class="center">Detalles del Grado</h4>
					</div>
					<div class="col l3">
						<br>
						<a class="waves-effect waves-light btn modal-trigger" id="maestro_guia" href="{{ route('curso.asignar_maestro_guia') }}">Maestro Guía
							<i class="material-icons right">class</i>
						</a>
					</div>
				</div>

				<div class="row">
					<form id="form_edit" method="PUT" action="{{ route('grados_cursos.update', $grado) }}">
						{{ csrf_field() }}

						<input type="hidden" name="grado_pred_id" id="grado_pred_id" value="{{ $grado->grado_pred->id }}">

						<div class="input-field col l3">
							<input class="edit" type="text" name="nombre" id="nombre" value="{{ $grado->grado_pred->nombre }}" readonly required>
							<label for="nombre">Nombre</label>
						</div>

						<div class="input-field col l3">
							<input type="text" value="{{ $grado->grado_pred->nivel->nombre }}" readonly>
							<label for="">Nivel</label>
						</div>

						<div class="input-field col l3">
							<input type="text" value="{{ $grado->jornada->nombre }}" readonly>
							<label for="">Jornada</label>
						</div>

						<div class="input-field col l1">
							<input class="edit" type="text" name="seccion" id="seccion" value="{{ $grado->seccion }}" readonly required>
							<label for="nombre">Sección</label>
						</div>

						<div class="input-field col l2">
							<input class="edit" type="text" name="ciclo_escolar" id="ciclo_escolar" value="{{ $grado->ciclo_escolar }}" readonly required>
							<label for="nombre">Ciclo Escolar</label>
						</div>
						<div class="input-field col l3">
							<input type="text" placeholder="" value="{{ $numero_alumnos }}" readonly>
							<label for="">Número de Alumnos</label>
						</div>
						<div class="input-field col l3">
							@if ($grado->maestro_id != NULL)
								<input type="text" placeholder="" value="{{ $grado->maestro->nombre }} {{ $grado->maestro->apellido }}" readonly>
							@else
								<input type="text" value="Sin Asignar" readonly>
							
							@endif
							<label for="">Maestro Guía</label>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12 l12">
		<div class="card white">
			<div class="card-content black-text">
				<div class="row">
					<div class="col l3">
						<p class="flow-text">Cursos</p>
					</div>
					@if($grado->grado_pred->nivel_id == 1 || $grado->grado_pred->nivel_id == 2)
						<div class="col l4 offset-l5">
							<a class="waves-effect waves-light btn modal-trigger" id="maestro_grado" name="nuevo_colaborador" href="{{ route('curso.asignar_maestro') }}">Maestro de Grado
								<i class="material-icons right">class</i>
							</a>
						</div>
					@endif

				</div>
				<div class="row">
					<div class="col l12 s12">
						<table class="centered">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Catedratico</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>
								@foreach($cursos as $curso)
								<tr>
									<td>{{ $curso->curso_pred->nombre }}</td>
									<td>
										@if($curso->maestro)
											{{ $curso->maestro->nombre }} {{ $curso->maestro->apellido }}
										@else
											Sin Asignar
										@endif

									</td>
									<td>
										<a id="maestro_curso" id_curso="{{ $curso->id }}" class="maestro_curso waves-effect waves-light btn modal-trigger" href="{{ route('curso.asignar_maestro_curso') }}" title="Asignar Maestro">
											<i class="material-icons">assignment_ind</i>
										</a>
									</td>
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

@endsection @section('extras')

<div class="modal modal-fixed-footer" id="modal_asigna_maestro">
	<div class="modal-content">
		<h4>Asignación de Maestro</h4>
		<div class="row">
			<form method="POST" id="form_asignar_maestro">
				{{ csrf_field() }}
				<input type="hidden" name="grado_id" id="grado_id" value="{{ $grado->id }}">
				<div class=" col l12">
					
					<label for="id_label_single">
  						Click para seleccionar el nombre de un maestro
 
  						<select name="maestro_id" class="js-example-basic-single js-states form-control browser-default" style="width: 100%" id="id_label_single">
							@foreach($maestros as $maestro)
								<option value="{{ $maestro->id }}">{{ $maestro->nombre }} {{ $maestro->apellido }}</option>
							@endforeach
  						</select>
					</label>
				</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" name="enviar" class="modal-action waves-effect waves-green btn-flat">Asignar</button>
	</div>
	</form>
</div>

@endsection @section('scripts_final')
	
	<script src="{{ asset('template_platform/js/asignar_maestro.js') }}"></script>

	<script>
		$('#maestro_guia').click(function(event){
			event.preventDefault()
			$('#form_asignar_maestro').attr('action', $(this).attr('href'))

			$('#modal_asigna_maestro').modal('open')
		})

		$('#maestro_grado').click(function(event){
			event.preventDefault()
			$('#form_asignar_maestro').attr('action', $(this).attr('href'))

			$('#modal_asigna_maestro').modal('open')
		})

		$('.maestro_curso').click(function(event){
			event.preventDefault()
			$('#form_asignar_maestro').attr('action', $(this).attr('href'))

			const curso_id = $(this).attr('id_curso')

			$("<input type='hidden' value="+curso_id+" />")
     		.attr("id", "curso_id")
     		.attr("name", "curso_id")
     		.appendTo("#form_asignar_maestro")

			//alert($(this).attr('id_curso'))


			$('#modal_asigna_maestro').modal('open')
		})
	</script>

@endsection
