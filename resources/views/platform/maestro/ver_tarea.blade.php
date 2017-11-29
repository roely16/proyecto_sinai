@extends('layouts.platform')

@section('title')
  Detalle Tarea
@endsection

@section('content')
  <div class="row">
	 <div class="col l6">
		<br>
		<a href="{{ route('maestro.ver_curso',$tarea->curso_id) }}" class="btn blue-grey darken-4" ><i class="material-icons center">arrow_back</i></a>
	 </div>
	 <div class="col l6">
		<h5>Tarea: {{ $tarea->nombre }}</h5>
	 </div>
	 <div>
		
	 </div>
  </div>

<div class="row">
  <div class="col l12">
	 <div class="card white">
		<div class="card-content black-text">
		  <div class="row">
			 <div class="col l2">

			 </div>
		  </div>
		  <table class="centered">
			 <thead>
				<tr>
				  <th>Alumno</th>
				  <th>Estado</th>
				  <th>Acción</th>
				</tr>
			 </thead>
			 <tbody>
				@foreach($alumnos as $alumno)
				  <tr>
					 <td>{{ $alumno->nombre }} {{ $alumno->apellido }}</td>
					 <td>
					 @if($alumno->alumno_tareas->count() != 0)
						Entregada
					 </td>
					 <td>
						@foreach ($alumno->alumno_tareas as $tarea)
						<a href="{{ route('maestro.calificar_tarea', $tarea->id) }}" class="btn green">
						  <i class="material-icons center">check_circle</i>
						</a>
						@endforeach
					 </td>
					 @else
						No Entregada
					 </td>
					 <td>
						<a href="#" class="btn red">
						  <i class="material-icons center">cancel</i>
						</a>
					 </td>
					 @endif
				  </tr>
				@endforeach
			 </tbody>
		  </table>
		</div>
	 </div>
  </div>
</div>
@endsection
