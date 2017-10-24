@extends('layouts.platform')

@section('extra_css')


@endsection

@section('title')
	Usuarios
@endsection

@section('content')

<div class="row">
	<div class="col l1">
		<br>
		<a href="/plataforma/administracion" class="btn blue-grey darken-4" ><i class="material-icons center">arrow_back</i></a>
	</div>
	<div class="col l10">
		<h3 class="center">Módulo de Usuarios</h3>
	</div>
</div>

<div class="row">

	<div class="col l12 s12">
		<div class="row">
			<form method="POST" action="{{ route('usuarios.buscar_usuario') }}">
				{{ csrf_field() }}
				<div class="col l4 s7">
					<input type="text" name="buscar_usuario" id="buscar_usuario" value="" placeholder="Ingrese el apellido del propietario">
				</div>
				<div class="col l3 s5">
					<button class="btn waves-effect waves-light" type="submit" name="action">
						Buscar <i class="material-icons right">search</i>
					</button>
				</div>
				<div class="col l2 offset-l3">
					@if($busqueda)
						<a href="{{ route('usuarios.index') }}" class="btn waves-effect waves-light">Ver todos</a>
					@endif
				</div>
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12 l12">
		<table class="centered">
			<thead>
				<tr>
					<th>Usuario</th>
					<th>Tipo</th>
					<th>Propietario</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				@foreach($usuarios as $usuario)
					<tr>
						<td>{{ $usuario->usuario }}</td>
						<td>{{ $usuario->tipo_usuario->tipo }}</td>
						<td>
							@if ($usuario->tipo_usuario_id == 1 || $usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3)
								{{ $usuario->empleado->nombre }} {{ $usuario->empleado->segundo_nombre }} {{ $usuario->empleado->apellido }} {{ $usuario->empleado->segundo_apellido }}
							@elseif($usuario->tipo_usuario_id == 4)
								{{ $usuario->encargado->nombre }} {{ $usuario->encargado->segundo_nombre }} {{ $usuario->encargado->apellido }} {{ $usuario->encargado->segundo_apellido }}
							@elseif($usuario->tipo_usuario_id == 5)
								{{ $usuario->alumno->nombre }} {{ $usuario->alumno->segundo_nombre }} {{ $usuario->alumno->apellido }} {{ $usuario->alumno->segundo_apellido }}
							@endif
						</td>
						<td>
							<a href="{{ route('usuarios.show', $usuario->id) }}" class="reset btn" title="Restablecer Contraseña"><i class="material-icons">lock</i></a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('scripts_final')
	<script src="{{ asset('template_platform/js/reset_password.js') }}"></script>
@endsection
