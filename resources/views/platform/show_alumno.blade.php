@extends('layouts.platform')

@section('title')
	Detalle Alumno
@endsection

@section('content')
	<div class="row">
		<div class="col l12 s12">
			<div class="card white">
				<div class="card-content black-text">
					<div class="row">

						<div class="col l1">
							<br>
							<a href="{{ route('alumnos.index') }}" class="btn blue-grey darken-4"><i class="material-icons">arrow_back</i></a>
						</div>

						<div class="col l9">
							<h5 class="center">Detalles del Alumno</h5>
						</div>

						<div class="">
							<br>
							<a id="boton_editar" title="Modificar Datos" href="#" class="editar btn blue darken-4"><i class="material-icons center icon_edit">edit</i></a>
							@if (Auth::user()->tipo_usuario_id == 1)

								<a href="{{ route('platform.alumnos.destroy', $alumno->id) }}" title="Eliminar Alumno" id="eliminar" class="eliminar btn red darken-4"><i class="material-icons center">delete</i></a>
								
							@endif
							
						</div>

					</div>
					<div class="row">
						<form id="form_edit" action="{{ route('alumnos.update', $alumno) }}" method="PUT">
							{{ csrf_field() }}
							<div class="input-field col l3 s12">
								<input class="edit" type="text" name="nombre" id="nombre" value="{{ $alumno->nombre }}" placeholder="" readonly required>
								<label for="">Primer Nombre</label>
							</div>
							<div class="input-field col l3 s12">
								<input class="edit" type="text" name="segundo_nombre" id="segundo_nombre" value="{{ $alumno->segundo_nombre }}" placeholder="" readonly required>
								<label for="">Segundo Nombre</label>
							</div>
							<div class="input-field col l3 s12">
								<input class="edit" type="text" name="apellido" id="apellido" value="{{ $alumno->apellido }}" placeholder="" readonly required>
								<label for="">Primer Apellido</label>
							</div>
							<div class="input-field col l3 s12">
								<input class="edit" type="text" name="segundo_apellido" id="segundo_apellido" value="{{ $alumno->segundo_apellido }}" placeholder="" readonly required>
								<label for="">Segundo Apellido</label>
							</div>
							<div class="input-field col l3 s12">
								<input class="edit" type="text" name="edad" id="edad" value="{{ $alumno->edad }}" placeholder="" readonly>
								<label for="">Edad</label>
							</div>
							<div class="input-field col l3 s12">
								<input class="edit" type="text" name="telefono" id="telefono" value="{{ $alumno->telefono }}" placeholder="" readonly>
								<label for="">Telefono</label>
							</div>
							<div class="input-field col l6 s12">
								<input class="edit" type="text" name="direccion" id="direccion" value="{{ $alumno->direccion }}" placeholder="" readonly>
								<label for="">Dirección</label>
							</div>
							
							<div class="input-field col l6 s12">
								@if ($alumno->grado_id != null)
									<input type="text" name="" placeholder="" value="{{ $alumno->grado->grado_pred->nombre }} - {{ $alumno->grado->grado_pred->nivel->nombre }} / Sección {{ $alumno->grado->seccion }} / Jornada {{ $alumno->grado->jornada->nombre }}" placeholder="" readonly>	
								@else
									<input type="text" placeholder="" value="No Inscrito" readonly>
								@endif

								<label for="">Grado</label>
							</div>
						</form>
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
						<div class="col l6 s6">
							<h5>Encargados</h5>
						</div>
						<div class="col l6 s6">
							<a href="#modal_encargado" class="waves-effect waves-light btn modal-trigger right">Encargado
								<i class="material-icons right">add_circle</i>
							</a>
						</div>
					</div>

					@if($encargados)
					<div class="row">
							<table class="centered">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Telefono</th>
										<th>Dirección</th>
										<th>Email</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									@foreach($encargados as $encargado)
										<tr>
											<td>{{ $encargado->encargado->nombre }} {{ $encargado->encargado->segundo_nombre }} {{ $encargado->encargado->apellido }} {{ $encargado->encargado->segundo_apellido }}</td>
											<td>{{ $encargado->encargado->telefono }}</td>
											<td>{{ $encargado->encargado->direccion }}</td>
											<td>{{ $encargado->encargado->email }}</td>
											<td>
												<a href="{{ route('encargados.ver_encargado', ['id_alumno' => $alumno->id,'id_encargado' => $encargado->encargado->id]) }}" title="Ver Detalles" class="btn"><i class="material-icons">details</i></a>
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

@section('extras')
<div id="modal_encargado" class="modal modal-fixed-footer">

	<ul class="tabs tabs-fixed-width black-text">
		<li class="tab col l6"><a class="active" href="#test1">Nuevo</a></li>
		<li class="tab col l6"><a href="#test2">Existente</a></li>
	</ul>

	<div id="test1">
		<form method="POST" action="{{ route('encargados.store') }}">
			{{ csrf_field() }}
			<div class="modal-content">
		      	<h4>Agregar Nuevo Encargado</h4>
		      		<input type="hidden" name="alumno_id" id="alumno_id" value="{{ $alumno->id }}">
					<input type="hidden" name="sede_id" id="alumno_id" value="{{ $alumno->sede_id }}">
					<div class="row">
						<div class="input-field col l6">
							<input type="text" name="nombre" id="nombre" placeholder="" value="" required>
							<label for="">Primer Nombre *</label>
						</div>
						<div class="input-field col l6">
							<input type="text" name="segundo_nombre" id="segundo_nombre" placeholder="" value="">
							<label for="">Segundo Nombre</label>
						</div>
						<div class="input-field col l6">
							<input type="text" name="apellido" id="apellido" placeholder="" value="" required>
							<label for="">Primer Apellido *</label>
						</div>
						<div class="input-field col l6">
							<input type="text" name="segundo_apellido" id="segundo_apellido" placeholder="" value="">
							<label for="">Segundo Apellido</label>
						</div>
						<div class="input-field col l6">
							<input type="text" name="telefono" id="telefono" placeholder="" value="" required>
							<label for="">Telefono *</label>
						</div>
						<div class="input-field col l6">
							<input type="text" name="direccion" id="direccion" placeholder="" value="">
							<label for="">Direccion</label>
						</div>
						<div class="input-field col l6">
							<input type="email" name="email" id="email" placeholder="" value="">
							<label for="">Email</label>
						</div>
						<div class="col l12">
							<p>* Campos Obligatorios</p>
						</div>

					</div>
					
		    </div>
		    <div class="modal-footer">
		      	<button type="submit" class="modal-action waves-effect waves-green btn-flat ">Guardar</button>
		    </div>
	    </form>
	</div>

	<div id="test2">
		<form action="{{ route('encargado.encargado_existente') }}" method="post">
			{{ csrf_field() }}
			<div class="modal-content">
		      	<h4>Agregar Encargado Existente</h4>
		      	<input type="hidden" name="alumno_id" id="alumno_id" value="{{ $alumno->id }}">
				<div class="row col l12">
					<label for="id_label_single">
  						Click para seleccionar el nombre de un encargado
 
  						<select name="encargado_id" class="js-example-basic-single js-states form-control browser-default" style="width: 100%" id="id_label_single">
  							@foreach ($encargados_all as $encargado)
  								<option value="{{ $encargado->id }}">{{ $encargado->nombre }} {{ $encargado->segundo_nombre }} {{ $encargado->apellido }} {{ $encargado->segundo_apellido }}</option>
  							@endforeach
  						</select>
					</label>
				</div>
		    </div>
		    <div class="modal-footer">
		      	<button type="submit" class="modal-action waves-effect waves-green btn-flat ">Guardar</button>
		    </div>
	    </form>
	</div>

</div>
@endsection

@section('scripts_final')
	<script src="{{ asset('template_platform/js/editar.js') }}"></script>
	<script src="{{ asset('template_platform/js/eliminar.js') }}"></script>
@endsection
