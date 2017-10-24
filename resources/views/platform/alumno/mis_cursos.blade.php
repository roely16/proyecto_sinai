@extends('layouts.platform')

@section('title')
  Mis Cursos
@endsection

@section('content')

  <div class="row">
	 <div class="col l6 center">
		<h5>{{ $grado->grado_pred->nombre }} {{ $grado->grado_pred->nivel->nombre }} - Sección {{ $grado->seccion }} - Jornada {{ $grado->jornada->nombre }}</h5>
	 </div>
	 <div class=" col l6 center">
		<h5>Maestro Guía - 
			@if ($grado->maestro_id != NULL)
				{{ $grado->maestro->nombre }} {{ $grado->maestro->apellido }}
			@else
				Sin Asignar
			@endif
		</h5>
	 </div>
  </div>

  <div class="row">
	 <div class="col l12 s12">
		<div class="card white">
		  <div class="card-content black-text">


			 <div class="row">
				<table class="centered">
				  <thead>
					 <tr>
						<th>Curso</th>
						<th>Maestro</th>
						<th>Acción</th>
					 </tr>
				  </thead>
				  <tbody>
					 @foreach($cursos as $curso)
						<tr>
						  <td>{{ $curso->curso_pred->nombre }}</td>
						  <td>{{ $curso->maestro->nombre }} {{ $curso->maestro->apellido }}</td>
						  <td>
							 <a href="{{ route('alumno.ver_curso', $curso->id) }}" class="btn">Acceder
								<i class="material-icons right">send</i>
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
@endsection
