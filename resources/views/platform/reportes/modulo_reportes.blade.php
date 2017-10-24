@extends('layouts.platform')

@section('title')

	Reportes

@endsection

@section('content')

	<div class="row">
		<div class="col l12">
			<h3 class="center">Módulo de Reportes</h3>
		</div>
	</div>

	<div class="row">
		<div class="col l6 center">
			<h5>Reportes Financieros</h5>
			<a href="#modal_ingresos_diarios" class="waves-effect waves-light btn modal-trigger">Ingresos diarios</a>
			<a href="#modal_ingresos_mensuales" class="waves-effect waves-light btn modal-trigger">Ingresos mensuales</a>
		</div>
		<div class="col l6 center">
			<h5 class="center">Reportes Administrativos</h5>
			<a href="#modal_hoja_asistencia" class="waves-effect waves-light btn modal-trigger">Hoja de Asistencia</a>
			<a href="#modal_alumnos_solventes" class="waves-effect waves-light btn modal-trigger">Alumnos Solventes</a>
		</div>
	</div>

	<div class="row" id="div_total_ingresos" style="display:none">
		<br>
		<div class="col l6 right">
			<p class="flow-text" id="total_ingresos"></p>
		</div>
	</div>

	<div id="grafica">
		<canvas id="myChart" width="1000" height="300"></canvas>	
	</div>
	

@endsection

@section('extras')

	<div id="modal_ingresos_diarios" class="modal modal-fixed-footer">
		<form action="{{ route('reportes.reporte_dia') }}" method="POST" id="form_reporte_dia">
			{{ csrf_field() }}
		    <div class="modal-content">
		      	<h4>Generar Reporte Ingresos Diarios</h4>
		      	<div class="row">
		      		<div class="input-field col l12">
					 	<input type="text" placeholder="" value="" name="dia" class="datepicker" required>
					 	<label for="">Fecha</label>
			  		</div>	
		      	</div>
		    </div>
		    <div class="modal-footer">
		      	<button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat ">Ver</button>
		    </div>
	    </form>
  	</div>

  	<div id="modal_ingresos_mensuales" class="modal modal-fixed-footer">
  		<form action="{{ route('reportes.reporte_mes') }}" method="POST" id="form_reporte_mes">
  			{{ csrf_field() }}
	  		<div class="modal-content">
	  			<h4>Generar Reporte Ingresos Mensuales</h4>
		      	<div class="row">
		      		<div class="input-field col l6">
					 	<select name="year" id="" required>
					 		<option value="2017">2017</option>
					 		<option value="2018">2018</option>
					 		<option value="2019">2019</option>
					 		<option value="2020">2020</option>
					 		<option value="2021">2021</option>
					 	</select>
					 	<label for="">Año</label>
			  		</div>	
			  		<div class="input-field col l6">
					 	<select name="mes" id="" required>
					 		<option value="01">Enero</option>
					 		<option value="02">Febrero</option>
					 		<option value="03">Marzo</option>
					 		<option value="04">Abril</option>
					 		<option value="05">Mayo</option>
					 		<option value="06">Junio</option>
					 		<option value="07">Julio</option>
					 		<option value="08">Agosto</option>
					 		<option value="09">Septiembre</option>
					 		<option value="10">Octubre</option>
					 		<option value="11">Noviembre</option>
					 		<option value="12">Diciembre</option>
					 	</select>
					 	<label for="">Mes</label>
			  		</div>
		      	</div>
	  		</div>
	  		<div class="modal-footer">
	  			<button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat ">Ver</button>
	  		</div>
  		</form>
  	</div>	

  	<div id="modal_hoja_asistencia" class="modal modal-fixed-footer">
  		<form action="{{ route('reportes.hoja_asistencia')}}" method="POST">
  			{{ csrf_field() }}
  			<div class="modal-content">
  				<h4>Generar Hoja de Asistencia</h4>
		      	<div class="row">
		      		<div class="input-field col l6">
					 	<select name="year" id="" required>
					 		<option value="2017">2017</option>
					 		<option value="2018">2018</option>
					 		<option value="2019">2019</option>
					 		<option value="2020">2020</option>
					 		<option value="2021">2021</option>
					 	</select>
					 	<label for="">Año</label>
			  		</div>	
			  		<div class="input-field col l6">
					 	<select name="mes" id="" required>
					 		<option value="Enero">Enero</option>
					 		<option value="Febrero">Febrero</option>
					 		<option value="Marzo">Marzo</option>
					 		<option value="Abril">Abril</option>
					 		<option value="Mayo">Mayo</option>
					 		<option value="Junio">Junio</option>
					 		<option value="Julio">Julio</option>
					 		<option value="Agosto">Agosto</option>
					 		<option value="Septiembre">Septiembre</option>
					 		<option value="Octubre">Octubre</option>
					 		<option value="Noviembre">Noviembre</option>
					 		<option value="Diciembre">Diciembre</option>
					 	</select>
					 	<label for="">Mes</label>
			  		</div>

			  		<div class="row">
			  			<label for="id_label_single">
  						Click para seleccionar el grado
 
	  						<select name="grado_id" class="js-example-basic-single js-states form-control browser-default" style="width: 100%" id="id_label_single" required>
	  							<option value="" disabled selected>Seleccione un grado</option>
	  							@foreach ($grados as $grado)
									
									<option value="{{ $grado->id }}">
										{{ $grado->ciclo_escolar }} / 
										{{ $grado->nombre }} 
										@if ($grado->nivel_id == 1)
											Preprimaria / 
										@elseif($grado->nivel_id == 2)
											Primaria / 
										@elseif($grado->nivel_id == 3)
											Básico /
										@elseif($grado->nivel_id == 4)
											Diversificado / 
										@endif
										{{ $grado->seccion }}
									</option>
								
	  							@endforeach
	  						</select>
						</label>
			  		</div>
		      	</div>	
  			</div>
  			<div class="modal-footer">
  				<button type="submit" class="modal-action waves-effect waves-green btn-flat">Generar</button>
  			</div>
  		</form>
  	</div>	

	<div id="modal_alumnos_solventes" class="modal modal-fixed-footer">
  		<form action="{{ route('reportes.alumnos_solventes')}}" method="POST">
  			{{ csrf_field() }}
  			<div class="modal-content">
  				<h4>Generar Informe de Solvencias</h4>
  				<div class="row">
  					<label for="id_label_single">
  						Click para seleccionar el grado
 
	  						<select name="grado_id" class="js-example-basic-single js-states form-control browser-default" style="width: 100%" id="id_label_single" required>
	  							<option value="" disabled selected>Seleccione un grado</option>
	  							@foreach ($grados as $grado)
									
									<option value="{{ $grado->id }}">
										{{ $grado->ciclo_escolar }} / 
										{{ $grado->nombre }} 
										@if ($grado->nivel_id == 1)
											Preprimaria / 
										@elseif($grado->nivel_id == 2)
											Primaria / 
										@elseif($grado->nivel_id == 3)
											Básico /
										@elseif($grado->nivel_id == 4)
											Diversificado / 
										@endif
										{{ $grado->seccion }}
									</option>
								
	  							@endforeach
	  						</select>
						</label>
  				</div>
  			</div>
  			<div class="modal-footer">
  				<button type="submit" class="modal-action waves-effect waves-green btn-flat">Generar</button>
  			</div>
  		</form>
  	</div>  	

@endsection

@section('scripts_final')

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.js"></script>
	<script src="{{ asset('template_platform/js/reportes.js')}}"></script>
	<script>
		


	</script>

@endsection