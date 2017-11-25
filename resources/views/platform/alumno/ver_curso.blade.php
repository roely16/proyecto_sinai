@extends('layouts.platform')

@section('title')
  Ver Curso
@endsection

@section('content')

  <div class="row">
	 <div class="col l1">
		<br>
		<a href="{{ route('alumno.mis_cursos') }}" class="btn blue-grey darken-4">
		  <i class="material-icons center" >arrow_back</i>
		</a>
	 </div>
	 <div class="col l3 center">
	 </div>
	 <div class="col l4 center">
		<h5>Curso - {{ $curso->curso_pred->nombre }}</h5>
	 </div>
	 <div class="col l4 center">
	 	<h5>Maestro -
			@if($curso->maestro)
				{{ $curso->maestro->nombre }} {{ $curso->maestro->apellido }}
			@else
				Sin Asignar
			@endif
		</h5>
	 </div>
  </div>

	<div class="row">
		<div class="col l12">
			<ul class="tabs tabs-fixed-width">
				<li class="tab col s3"><a href="#tareas" class="active">Tareas</a></li>
				<li class="tab col s3"><a href="#documentos">Documentos y Videos</a></li>
			</ul>
		</div>

		<div id="tareas" class="col s12">
			@if ($tareas_1->count() > 0)
		   		<div class="row">
		   			<div class="col l12 s12">
		   				<div class="card white">
		   					<div class="card-content black-text">
		   						<h5 class="center">I Bimestre</h5>
		   						<table class="centered">
		   							<thead>
		   								<tr>
		   									<th>Nombre</th>
		   									<th>Fecha de Entrega</th>
		   									<th>Estado</th>
		   									<th>Acción</th>
		   								</tr>
		   							</thead>
		   							<tbody>
		   								@foreach($tareas_1 as $tarea)
												<tr>
											  		<td>{{ $tarea->nombre }}</td>
											  		<td>{{ $tarea->fecha_entrega }}</td>
											  		<td>
											  			@if ($tarea->tareas_alumno->count())
											  				Entregada
											  			@else
											  				Pendiente
											  			@endif
											  		</td>
											  		<td>
														<a href="{{ route('alumno.detalle_tarea', $tarea->id) }}" class="btn">Ver
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
		   	@endif

		   	@if ($tareas_2->count() > 0)
		   		<div class="row">
		   			<div class="col l12 s12">
		   				<div class="card white">
		   					<div class="card-content black-text">
		   						<h5 class="center">II Bimestre</h5>
		   						<table class="centered">
		   							<thead>
		   								<tr>
		   									<th>Nombre</th>
		   									<th>Fecha de Entrega</th>
		   									<th>Estado</th>
		   									<th>Acción</th>
		   								</tr>
		   							</thead>
		   							<tbody>
		   								@foreach($tareas_2 as $tarea)
												<tr>
											  		<td>{{ $tarea->nombre }}</td>
											  		<td>{{ $tarea->fecha_entrega }}</td>
											  		<td>
											  			@if ($tarea->tareas_alumno->count())
											  				Entregada
											  			@else
											  				Pendiente
											  			@endif	
											  		</td>
											  		<td>
														<a href="{{ route('alumno.detalle_tarea', $tarea->id) }}" class="btn">Ver
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
		   	@endif

		   	@if ($tareas_3->count() > 0)
		   		<div class="row">
		   			<div class="col l12 s12">
		   				<div class="card white">
		   					<div class="card-content black-text">
		   						<h5 class="center">III Bimestre</h5>
		   						<table class="centered">
		   							<thead>
		   								<tr>
		   									<th>Nombre</th>
		   									<th>Fecha de Entrega</th>
		   									<th>Estado</th>
		   									<th>Acción</th>
		   								</tr>
		   							</thead>
		   							<tbody>
		   								@foreach($tareas_3 as $tarea)
												<tr>
											  		<td>{{ $tarea->nombre }}</td>
											  		<td>{{ $tarea->fecha_entrega }}</td>
											  		<td>
											  			@if ($tarea->tareas_alumno->count())
											  				Entregada
											  			@else
											  				Pendiente
											  			@endif
											  		</td>
											  		<td>
														<a href="{{ route('alumno.detalle_tarea', $tarea->id) }}" class="btn">Ver
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
		   	@endif

		   	@if ($tareas_4->count() > 0)
		   		<div class="row">
		   			<div class="col l12 s12">
		   				<div class="card white">
		   					<div class="card-content black-text">
		   						<h5 class="center">IV Bimestre</h5>
		   						<table class="centered">
		   							<thead>
		   								<tr>
		   									<th>Nombre</th>
		   									<th>Fecha de Entrega</th>
		   									<th>Estado</th>
		   									<th>Acción</th>
		   								</tr>
		   							</thead>
		   							<tbody>
		   								@foreach($tareas_4 as $tarea)
												<tr>
											  		<td>{{ $tarea->nombre }}</td>
											  		<td>{{ $tarea->fecha_entrega }}</td>
											  		<td>
													  	@if ($tarea->tareas_alumno->count())
													  		Entregada
													  	@else
													  		Pendiente
													  	@endif
													</td>
											  		<td>
														<a href="{{ route('alumno.detalle_tarea',$tarea->id) }}" class="btn">Ver
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
		   	@endif
		</div>	

		<div id="documentos" class="col s12">
			@if ($videos->count() > 0)
			   	<div class="row">
			   		<div class="col l12">
			   			<div class="card white">
			   				<div class="card-content black-text">
			   					<h5 class="center">Videos</h5>
			   					<table class="centered">
			   						<thead>
			   							<tr>
			   								<th>Nombre</th>
			   								<th>Dirección (URL)</th>
			   							</tr>
			   						</thead>
			   						<tbody>
			   							@foreach ($videos as $video)
			   								<tr>
			   									<td>{{ $video->nombre }}</td>
			   									<td><a href="{{ $video->url }}" target="_blank">{{ $video->url }}</a></td>
			
			   								</tr>
			   							@endforeach
			   						</tbody>
			   					</table>
			   				</div>
			   			</div>
			   		</div>
			   	</div>
		   	@endif

				@if ($documentos->count() > 0)
			   	<div class="row">
			   		<div class="col l12">
			   			<div class="card white">
			   				<div class="card-content black-text">
			   					<h5 class="center">Documentos</h5>
			   					<table class="centered">
			   						<thead>
			   							<tr>
			   								<th>Nombre</th>
			   								<th>Acción</th>
			   							</tr>
			   						</thead>
			   						<tbody>
			   							@foreach ($documentos as $documento)
			   								<tr>
			   									<td>{{ $documento->nombre }}</td>
													<td>
														<a href="{{ Storage::url($documento->archivo) }}" class="btn" download="{{ $documento->nombre_archivo }}"><i class="material-icons">file_download</i></a>
													</td>			
			   								</tr>
			   							@endforeach
			   						</tbody>
			   					</table>
			   				</div>
			   			</div>
			   		</div>
			   	</div>
		   	@endif

		</div>
	</div>	

	<!--  
  <div class="row">
	 <div class="col l12">
		<div class="card white">
		  <div class="card-content black-text">
			 <div class="row">
				<table class="centered">
				  <thead>
					 <tr>
						<th>Nombre</th>
						<th>Fecha de entrega</th>
						<th>Estado</th>
						<th>Acción</th>
					 </tr>
				  </thead>
				  <tbody>
					 @foreach($tareas as $tarea)
						<tr>
						  <td>{{ $tarea->nombre }}</td>
						  <td>{{ $tarea->fecha_entrega }}</td>
						  <td></td>
						  <td>
							 <a href="{{ route('alumno.detalle_tarea', $tarea->id) }}" class="btn">Ver
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

  -->
@endsection
