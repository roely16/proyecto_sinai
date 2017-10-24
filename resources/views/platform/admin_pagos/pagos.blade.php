@extends('layouts.platform')

@section('title')

	Administracion de Pagos

@endsection

@section('content')

	<div class="row">
		<div class="col l1">
			<br>
			<a href="/plataforma/administracion" class="btn blue-grey darken-4" ><i class="material-icons center">arrow_back</i></a>
		</div>
		<div class="col l10">
			<h3 class="center">Módulo de Adminitración de Pagos</h3>
		</div>
	</div>

	<div class="row">
		<form action="{{ route('admin_pagos.buscar_grados') }}" method="POST">
			{{ csrf_field() }}
			<div class="input-field col l3">
				<select name="nivel" id="nivel">
					<option value="0" selected>Todos los niveles</option>
					@if (Auth::user()->empleado->sede_id == 1 || Auth::user()->empleado->sede_id == 2)
						<option value="1">Preprimaria</option>
						<option value="2">Primaria</option>
						<option value="3">Básicos</option>
						<option value="4">Diversificado</option>
					@elseif(Auth::user()->empleado->sede_id == 3)
						<option value="3">Básicos</option>
						<option value="5">Diversificado</option>
					@endif
				</select>
				<label for="">Nivel</label>
			</div>
			<div class="input-field col l3">
				<select name="jornada" id="jornada">
					<option value="0" selected>Todas las jornadas</option>
					@if (Auth::user()->empleado->sede_id == 1 || Auth::user()->empleado->sede_id == 3)
						<option value="1">Matutina</option>
						<option value="2">Fin de Semana</option>
					@elseif(Auth::user()->empleado->sede_id == 2)
						<option value="1">Matutina</option>
						<option value="3">Vespertina</option>
					@endif
				</select>
				<label for="">Jornada</label>
			</div>
			<div class="input-field col l3">
				<button type="submit" class="btn">Buscar grados<i class="material-icons right">search</i></button>
			</div>
		</form>
	</div>

	@if ($busqueda)

		<div class="row">
			<div class="col l12">
				<table class="centered highlight">
					<thead>
						<tr>
							<th>Grado</th>
							<th>Nivel</th>
							<th>Jornada</th>
							<th>Acción</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($grados as $grado)
							<tr>
								<td>{{ $grado->nombre }}</td>
								<td>{{ $grado->nivel->nombre }}</td>
								<td>{{ $grado->jornada->nombre }}</td>
								<td>
									<a href="{{ route('admin_pagos.ver_grado', $grado->id) }}" class="btn"><i class="material-icons">edit</i></a>
								</td>
							</tr>
			
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	@endif
	
@endsection