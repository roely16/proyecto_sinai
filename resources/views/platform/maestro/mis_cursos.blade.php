@extends('layouts.platform')

@section('title')
	Mis Cursos
@endsection

@section('content')

	<div class="row">
		<div class="col l12 center">
			<h5>Mis Cursos</h5>
	</div>

	<div class="row">
		
		<table class="centered">
			<thead>
				<tr>
					<th>Curso</th>
					<th>Grado</th>
					<th>Ciclo</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				@if ($cursos->count() == 0)
					<tr>
						<td></td>
						<td>-- Aun no tiene cursos asignados --</td>
						<td></td>
						<td></td>
					</tr>
				@else
					@foreach ($cursos as $curso)

						<tr>
							<td>{{ $curso->curso_pred->nombre }}</td>
							<td>{{ $curso->grado->grado_pred->nombre }} {{ $curso->grado->grado_pred->nivel->nombre }} / Sección {{ $curso->grado->seccion }} / Jornada {{ $curso->grado->jornada->nombre }}</td>
							<td>{{ $curso->grado ->ciclo_escolar }}</td>
							<td>
								<a href="{{ route('maestro.ver_curso', $curso->id) }}" class="btn">Acceder
									<i class="material-icons right">send</i>
								</a>
							</td>
						</tr>
		
					@endforeach	
				@endif
						
			</tbody>
		</table>
		
	</div>

	<div class="row center">
		{{ $cursos->links() }}
	</div>

@endsection
