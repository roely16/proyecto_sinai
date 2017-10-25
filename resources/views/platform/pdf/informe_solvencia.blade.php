<style>
	table { 
		border-collapse: collapse; 
		width: 100%;
	}

	table, tr, td, th { 
		margin:0px; padding: 0px; 
		border: 0.1px solid black;
	}

	p, h3 {
		margin:0px; padding: 0px;
	}

	.centrar {
		text-align: center;
	}

	.fila {
    	height: 2px;
	}

	.columna {
		width: 2px;
	}

	.total {
		width: 3px;
	}

	th, tr {
    	text-align: center;
	}	

</style>

<h3 class="centrar">
	@if ($sede_id == 1)
		Colegio de Informatica Sinai
	@elseif($sede_id == 2)

	@elseif($sede_id == 3)
		
	@endif
</h3>
<p class="centrar">Informe de Solvencia</p>
<br>
<p>Grado: {{ $grado ->grado_pred->nombre}} - Nivel: {{ $grado->grado_pred->nivel->nombre }} - Sección: {{ $grado->seccion}} - Jornada: {{ $grado->grado_pred->jornada->nombre}}</p>
<br>
<table>
	<thead>
		<tr>
			<th>Nombre del alumno</th>
			<th>Ene</th>
			<th>Feb</th>
			<th>Mar</th>
			<th>Abr</th>
			<th>May</th>
			<th>Jun</th>
			<th>Jul</th>
			<th>Ago</th>
			<th>Sep</th>
			<th>Oct</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($alumnos as $alumno)

			<tr>
				<td class="fila">{{ $alumno->nombre}} {{ $alumno->segundo_nombre}} {{ $alumno->apellido }} {{ $alumno->segundo_apellido}}</td>
				
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>

		@endforeach
	</tbody>
</table>