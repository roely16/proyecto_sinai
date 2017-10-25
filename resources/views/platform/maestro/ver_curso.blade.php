@extends('layouts.platform')

@section('title')
  Ver Curso
@endsection

@section('content')
  <div class="row">
	 <div class="col l1">
		<br>
		<a href="{{ route('maestro.mis_cursos') }}" class="btn blue-grey darken-4" ><i class="material-icons center">arrow_back</i></a>
	 </div>
	 <div class="col l11">
		<h5 class="right">Curso {{ $curso->curso_pred->nombre }} - {{ $curso->curso_pred->grado->nombre }} {{ $curso->curso_pred->grado->nivel->nombre }} - Sección {{ $curso->grado->seccion }} - Jornada {{ $curso->grado->jornada->nombre }}</h5>
	 </div>
  </div>

	<div class="row">
		<div class="col l6">
			<h5></h5>
		</div>
		<div class="col l6">
			<div class="fixed-action-btn">
		    	<a class="btn-floating btn-large red">
		      		<i class="large material-icons">mode_edit</i>
		    	</a>
    			<ul>
			      <li><a class="btn-floating yellow darken-1 modal-trigger" href="#modal1"><i class="material-icons">insert_drive_file</i></a></li>
			      <li><a class="btn-floating green modal-trigger" href="#compartir_video"><i class="material-icons">ondemand_video</i></a></li>
			      <li><a class="btn-floating blue modal-trigger" href="#compartir_documento"><i class="material-icons">attach_file</i></a></li>
    			</ul>
  			</div>
		</div>
	</div>
		
	<div class="row">
	   	<div class="col s12">
		      <ul class="tabs tabs-fixed-width">
		        <li class="tab col s3"><a class="active" href="#test1">Tareas</a></li>
		        <li class="tab col s3"><a href="#test2">Documentos y Videos</a></li>
		      </ul>
	    	</div>
		   <div id="test1" class="col s12">
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
		   									<th>Punteo</th>
		   									<th>Fecha de Entrega</th>
		   									<th>Acción</th>
		   								</tr>
		   							</thead>
		   							<tbody>
		   								@foreach($tareas_1 as $tarea)
												<tr>
											  		<td>{{ $tarea->nombre }}</td>
											  		<td>{{ $tarea->punteo }} Puntos</td>
											  		<td>{{ $tarea->fecha_entrega }}</td>
											  		<td>
														<a title="Calificar Tarea" href="{{ route('maestro.entregas_tarea',$tarea->id) }}" class="btn green">
															<i class="material-icons">assignment</i>
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
		   									<th>Punteo</th>
		   									<th>Fecha de Entrega</th>
		   									<th>Acción</th>
		   								</tr>
		   							</thead>
		   							<tbody>
		   								@foreach($tareas_2 as $tarea)
												<tr>
											  		<td>{{ $tarea->nombre }}</td>
											  		<td>{{ $tarea->punteo }} Puntos</td>
											  		<td>{{ $tarea->fecha_entrega }}</td>
											  		<td>
														<a title="Calificar Tarea" href="{{ route('maestro.entregas_tarea',$tarea->id) }}" class="btn green">
															<i class="material-icons">assignment</i>
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
		   									<th>Punteo</th>
		   									<th>Fecha de Entrega</th>
		   									<th>Acción</th>
		   								</tr>
		   							</thead>
		   							<tbody>
		   								@foreach($tareas_3 as $tarea)
												<tr>
											  		<td>{{ $tarea->nombre }}</td>
											  		<td>{{ $tarea->punteo }} Puntos</td>
											  		<td>{{ $tarea->fecha_entrega }}</td>
											  		<td>
														<a title="Calificar Tarea" href="{{ route('maestro.entregas_tarea',$tarea->id) }}" class="btn green">
															<i class="material-icons">assignment</i>
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
		   									<th>Punteo</th>
		   									<th>Fecha de Entrega</th>
		   									<th>Acción</th>
		   								</tr>
		   							</thead>
		   							<tbody>
		   								@foreach($tareas_4 as $tarea)
												<tr>
											  		<td>{{ $tarea->nombre }}</td>
											  		<td>{{ $tarea->punteo }} Puntos</td>
											  		<td>{{ $tarea->fecha_entrega }}</td>
											  		<td>
														<a title="Calificar Tarea" href="{{ route('maestro.entregas_tarea',$tarea->id) }}" class="btn green">
															<i class="material-icons">assignment</i>
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
		   <div id="test2" class="col s12">
		   	
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
		
@endsection

@section('extras')
<div id="modal1" class="modal modal-fixed-footer">
  <form class="" action="{{ route('maestro.crear_tarea') }}" method="post">
	 {{ csrf_field() }}
	 <input type="hidden" name="curso_id" id="curso_id" value="{{ $curso->id }}">
	 <div class="modal-content">
		<h4>Nueva Tarea</h4>
		<br>
		<div class="row">
		  <div class="input-field col l12">
			 <input type="text" placeholder="" name="nombre" id="nombre" value="" required>
			 <label for="">Nombre</label>
		  </div>
		  <div class="input-field col l12">
			 <textarea id="descripcion" placeholder="" name="descripcion" class="materialize-textarea" required></textarea>
			 <label for="textarea1">Descripción</label>
		  </div>
		  <div class="input-field col l4">
			 <input type="text" placeholder="" name="fecha_entrega" class="datepicker" required>
			 <label for="">Fecha de Entrega</label>
		  </div>
		  <div class="input-field col l4">
		  		<select name="bimestre" id="bimestre" required>
		  			<option value="" selected disabled>Seleccione un bimestre</option>
		  			<option value="1">1</option>
		  			<option value="2">2</option>
		  			<option value="3">3</option>
		  			<option value="4">4</option>
		  		</select>
		  		<label for="">Bimestre</label>
		  </div>
		  <div class="input-field col l4">
			 <input type="text" placeholder="" id="punteo" name="punteo">
			 <label for="">Punteo</label>
		  </div>
		</div>
	 </div>
	 <div class="modal-footer">
		<button type="submit" class="modal-action waves-effect waves-green btn-flat ">Crear</button>
	 </div>
  </form>
</div>

<div class="modal" id="compartir_video">
	<form action="{{ route('maestro.compartir_video') }}" method="POST">
		{{ csrf_field() }}
		<input type="hidden" name="curso_id" id="curso_id" value="{{ $curso->id }}">
		<div class="modal-content">
			<h4>Compartir Video</h4>
			<div class="row">
				<div class="input-field col l12">
					<input type="text" name="nombre" placeholder="" required="">
					<label for="">Nombre</label>
				</div>

				<div class="input-field col l12">
					<input type="text" name="url" placeholder="" required="">
					<label for="">Dirección (URL)</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="modal-action waves-effect waves-green btn-flat ">Compartir</button>
		</div>
	</form>
</div>

<div class="modal" id="compartir_documento">
	<form action="{{ route('maestro.compartir_documento') }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="hidden" name="curso_id" id="curso_id" value="{{ $curso->id }}">
		<div class="modal-content">
			<h4>Compartir Documento</h4>
			<div class="row">
				<div class="input-field col l12">
					<input type="text" name="nombre" placeholder="" required>
					<label for="">Nombre</label>
				</div>
				<div class="file-field input-field col l12">
					<h5>Subir Documento</h5>
			      <div class="btn">
			      	<span>Archivo</span>
			        	<input type="file" name="archivo">
			      </div>
			      <div class="file-path-wrapper">
			        	<input class="file-path validate" type="text" required>
			      </div>
		   	</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="modal-action waves-effect waves-green btn-flat ">Compartir</button>
		</div>
	</form>
</div>

<div class="modal modal-fixed-footer" id="reproducir_video">
	<div class="modal-content">
		
	</div>
</div>
@endsection
