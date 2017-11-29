@extends('layouts.platform')

@section('title')

	Ver Encargado

@endsection

@section('content')

	<div class="row">
		<div class="col l12">
			<div class="card white">
				<div class="card-content black-text">
					<div class="row">
						<div class="col l1">
							<br>
							<a href="{{ route('alumnos.show', $id_alumno) }}" class="btn blue-grey darken-4"><i class="material-icons">arrow_back</i></a>
						</div>

						<div class="col l9">
							<h5 class="center">Detalles del Encargado</h5>
						</div>

						<div class="col l2">
							<br>
							<a id="boton_editar" title="Modificar Datos" href="#" class="editar btn blue darken-4 right"><i class="material-icons center icon_edit">edit</i></a>
						</div>
					</div>

					<div class="row">
						<form action="{{ route('encargados.update', $encargado)}}" method="PUT" id="form_edit">
							{{ csrf_field() }}
							<div class="input-field col l3 s12">
								<input class="edit" name="nombre" type="text" placeholder="" value="{{ $encargado->nombre }}" readonly>
								<label for="">Primer Nombre</label>
							</div>
							<div class="input-field col l3 s12">
								<input class="edit" name="segundo_nombre" type="text" placeholder="" value="{{ $encargado->segundo_nombre }}" readonly>
								<label for="">Segundo Nombre</label>
							</div>
							<div class="input-field col l3 s12">
								<input class="edit" name="apellido" type="text" placeholder="" value="{{ $encargado->apellido }}" readonly>
								<label for="">Primer Apellido</label>
							</div>
							<div class="input-field col l3 s12">
								<input class="edit" name="segundo_apellido" type="text" placeholder="" value="{{ $encargado->segundo_apellido }}" readonly>
								<label for="">Segundo Apellido</label>
							</div>
							<div class="input-field col l3">
								<input class="edit" name="telefono" type="text" placeholder="" value="{{ $encargado->telefono }}" readonly>
								<label for="">Telefono</label>
							</div>
							<div class="input-field col l5">
								<input class="edit" name="direccion" type="text" placeholder="" value="{{ $encargado->direccion }}" readonly>
								<label for="">Direccion</label>
							</div>
							<div class="input-field col l4">
								<input class="edit" name="email" type="text" placeholder="" value="{{ $encargado->email }}" readonly>
								<label for="">Email</label>
							</div>
						</form>
					</div>
				</div>			
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col l12">
			<div class="card white">
				<div class="card-content black-text">
					<div class="row">
						<div class="col l6">
							<h5>Reportes</h5>
						</div>
						<div class="col l6">
							<br>
							<a href="#modal1" class="waves-effect waves-light btn modal-trigger right">Enviar Reporte</a>
						</div>
					</div>

					<div class="row">
						<table class="centered">
							<thead>
								<tr>
									<th>Asunto</th>
									<th>De</th>
									<th>Fecha</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($reportes as $reporte)

									<tr>
										<td>{{ $reporte->asunto}}</td>
										<td>
											@if ($reporte->empleado->tipo_empleado_id == 1 || $reporte->empleado->tipo_empleado_id)
												Dirección: {{ $reporte->empleado->nombre }} {{ $reporte->empleado->apellido }}

											@endif
											
										</td>
										<td>{{ $reporte->created_at }}</td>
									</tr>
	
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('extras')

	<div id="modal1" class="modal modal-fixed-footer">
		<form action="{{ route('encargados.enviar_reporte') }}" method="POST">
			{{ csrf_field() }}
			<input type="hidden" value="{{ $id_alumno }}" name="alumno_id">
			<input type="hidden" value="{{ $encargado->id }}" name="encargado_id">
		    <div class="modal-content">
		      	<h4>Enviar Reporte</h4>
				<div class="row">
					<div class="input-field col l12">
			      		<input type="text" name="asunto" placeholder="" required>
			      		<label for="">Asunto</label>
		      		</div>
		      		<div class="input-field col l12">
		      			<textarea class="materialize-textarea" name="mensaje" rows="100"></textarea>
		      			<label for="">Mensaje</label>
		      		</div>
				</div>
		    </div>
		    <div class="modal-footer">
		      	<button type="submit" class="modal-action waves-effect waves-green btn-flat ">Enviar</button>
		    </div>
	    </form>
  	</div>

@endsection

@section('scripts_final')
	<script src="{{ asset('template_platform/js/editar.js') }}"></script>
@endsection