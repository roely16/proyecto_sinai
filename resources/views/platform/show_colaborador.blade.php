@extends('layouts.platform')

@section('title')
	Detalle Colaborador
@endsection

@section('content')
	<div class="row">
		<div class="col l12 s12">
			<div class="card white">
				<div class="card-content black-text">
					<div class="row">
						<div class="col l1 s7">
							<!-- Boton de regresar -->
							<br>
							<a href="{{ route('colaboradores.index') }}" class="btn blue-grey darken-4" ><i class="material-icons center">arrow_back</i></a>
						</div>
						<div class="col l9">
							<h5 class="center">Detalles del Colaborador</h5>
						</div>
						<div class="">
							<br>
							<a id="boton_editar" href="" class="editar btn blue darken-4"><i class="material-icons center icon_edit">edit</i></a>
							@if (Auth::user()->tipo_usuario_id == 1)

								<a id="eliminar" href="{{ route('platform.colaborador.destroy', $colaborador->id) }}" class="btn red darken-4"><i class="material-icons center">delete</i></a>
	
							@endif
							
						</div>
					</div>
					<div class="row">
						<form id="form_edit" action="{{ route('colaboradores.update', $colaborador) }}" method="PUT">
							{{ csrf_field() }}
							<div class="input-field col l3 s12">
								<input class="edit" type="text" name="nombre" id="nombre" value="{{ $colaborador->nombre }}" placeholder="" readonly required>
								<label for="nombre">Primer Nombre</label>
							</div>
							<div class="input-field col l3 s12">
								<input class="edit" type="text" name="segundo_nombre" id="segundo_nombre" value="{{ $colaborador->segundo_nombre }}" placeholder="" readonly required>
								<label for="nombre">Segundo Nombre</label>
							</div>
							<div class="input-field col l3 s12">
								<input class="edit" type="text" name="apellido" id="apellido" value="{{ $colaborador->apellido }}" placeholder="" readonly required>
								<label for="apellido">Primer Apellido</label>
							</div>
							<div class="input-field col l3 s12">
								<input class="edit" type="text" name="segundo_apellido" id="segundo_apellido" value="{{ $colaborador->segundo_apellido }}" placeholder="" readonly required>
								<label for="apellido">Segundo Apellido</label>
							</div>
							<div class="input-field col l2 s12">
								<input class="edit" type="text" name="edad" id="edad" placeholder="" readonly value="{{ $colaborador->edad }}">
								<label for="edad">Edad</label>
							</div>
							<div class="input-field col l4 s12">
								<input class="edit" type="text" name="telefono" id="telefono" value="{{ $colaborador->telefono }}" placeholder="" readonly>
								<label for="telefono">Telefono</label>
							</div>
							<div class="input-field col l6 s12">
								<input class="edit" type="email" name="email" id="email" value="{{ $colaborador->email }}" placeholder="" readonly>
								<label for="email">Email</label>
							</div>
							<div class="input-field col l6 s12">
								<input class="edit" type="text" name="direccion" id="direccion" value="{{ $colaborador->direccion }}" placeholder="" readonly>
								<label for="direccion">Dirección</label>
							</div>
							<div class="input-field col l6 s12" readonly>
								<input type="text" value="{{ $colaborador->tipo_empleado->nombre }}" placeholder="" readonly>
								<label>Tipo</label>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('scripts_final')
	<script src="{{ asset('template_platform/js/editar.js') }}"></script>
	<script src="{{ asset('template_platform/js/eliminar.js') }}"></script>
@endsection
