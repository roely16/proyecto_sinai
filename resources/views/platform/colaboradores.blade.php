@extends('layouts.platform') @section('title') Colaboradores @endsection @section('content')

<div class="row">
	<div class="col l1">
		<br>
		<a href="/plataforma/administracion" class="btn blue-grey darken-4" ><i class="material-icons center">arrow_back</i></a>
	</div>
	<div class="col l10">
		<h3 class="center">Módulo de Colaboradores</h3>
	</div>
</div>


<div class="row">

	<div class="col l12 s12">
		<div class="row">

			<form method="POST" action="{{ route('colaboradores.buscar_colaborador') }}">
				{{ csrf_field() }}
				<div class="col l4 s8">
					<input type="text" name="buscar_colaborador" id="buscar_colaborador" placeholder="Ingrese el nombre del colaborador">
				</div>
				<div class="col l4 s4">
					<button class="btn waves-effect waves-light" type="submit" name="action">
						Buscar <i class="material-icons right">search</i>
					</button>
				</div>
			</form>

			@if($busqueda)
			<div class="col l2 s6">
				<a href="{{ route('colaboradores.index') }}" class="btn waves-effect waves-light">Ver todos</a>
			</div>
			<div class="col l2 s6">
				<a class="waves-effect waves-light btn modal-trigger" name="nuevo_colaborador" href="#modal1">Nuevo
							<i class="material-icons right">add_circle</i>
						</a>
			</div>
			@else
			<div class="col l2 s6 offset-l2">
				<a class="waves-effect waves-light btn modal-trigger" name="nuevo_colaborador" href="#modal1">Nuevo
							<i class="material-icons right">add_circle</i>
						</a>
			</div>
			@endif

		</div>
	</div>
</div>

<div class="row">
	<div class="col l12 s12">
		<table class="centered">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Tipo</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				@foreach($colaboradores as $colaborador)
				<tr>
					<td>{{ $colaborador->nombre }} {{ $colaborador->segundo_nombre }} {{ $colaborador->apellido }} {{ $colaborador->segundo_apellido }}</td>
					<td>
						@if($colaborador->tipo_empleado_id == 1) Director @elseif($colaborador->tipo_empleado_id == 2) Secretaria @elseif($colaborador->tipo_empleado_id == 3) Contador @elseif($colaborador->tipo_empleado_id == 4) Maestro/a @endif
					</td>
					<td>
						<a class="waves-effect waves-light btn" href="{{ route('colaboradores.show', $colaborador->id) }}">Ver
					</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<div class="row center">
	{{ $colaboradores->links() }}
</div>

@endsection @section('extras')
<!-- Modal -->
<div id="modal1" class="modal modal-fixed-footer">

	<form class="" action="{{ route('colaboradores.store') }}" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="sede_id" id="sede_id" value="{{ Auth::user()->empleado->sede_id }}">
		<div class="modal-content">
			<h4>Nuevo Colaborador</h4>
			<div class="row">
				<div class="input-field col l6 s12">
					<input type="text" name="nombre" id="nombre" placeholder="" required>
					<label for="nombre">Primer Nombre *</label>
				</div>
				<div class="input-field col l6 s12">
					<input type="text" name="segundo_nombre" id="segundo_nombre" placeholder="">
					<label for="nombre">Segundo Nombre</label>
				</div>
				<div class="input-field col l6 s12">
					<input type="text" name="apellido" id="apellido" placeholder="" required>
					<label for="apellido">Primer Apellido *</label>
				</div>
				<div class="input-field col l6 s12">
					<input type="text" name="segundo_apellido" id="segundo_apellido" placeholder="">
					<label for="apellido">Segundo Apellido</label>
				</div>
				<div class="input-field col l3 s12">
					<input type="text" name="edad" id="edad" placeholder="" value="">
					<label for="edad">Edad</label>
				</div>
				<div class="input-field col l4 s12">
					<select name="tipo_empleado_id" readonly required>
							<option value="" disabled selected>Seleccione una opción</option>
							<option value="2">Secretaria</option>
							<option value="4">Maestro</option>
						</select>
					<label>Tipo *</label>
				</div>
				<div class="input-field col l5 s12">
					<input type="text" name="telefono" placeholder="" id="telefono" value="">
					<label for="telefono">Telefono</label>
				</div>
				<div class="input-field col l6 s12">
					<input type="email" name="email" id="email" placeholder="" value="">
					<label for="email">Email</label>
				</div>
				<div class="input-field col l6 s12">
					<input type="text" name="direccion" id="direccion" placeholder="" value="">
					<label for="direccion">Dirección</label>
				</div>
			</div>
			<div class="row">
				<p class="">* Campos Obligatorios</p>
			</div>

		</div>
		<div class="modal-footer">
			<button type="submit" name="enviar" class="modal-action waves-effect waves-green btn-flat ">Guardar</a>
				</div>
			</form>
</div>
@endsection
