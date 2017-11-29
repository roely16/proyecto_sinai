<style>
	table { 
		border-collapse: collapse; 
		width: 100%;
	}

	table, tr, td, th { 
		margin:0px; padding: 0px; 
	}


</style>

<h3>Reporte de Ingresos </h3>
<h5>Fecha: {{ $fecha }}</h5>

<table>
	<thead>
		<tr>
			<th>Concepto</th>
			<th>Monto</th>
			<th>Alumno</th>
			<th>No. Recibo</th>
			<th>Fecha</th>
		</tr>
	</thead>
	<tbody>
		@foreach($pagos as $pago)
			<tr class="fila">
				<td>{{ $pago->concepto }}</td>
				<td>Q{{ $pago->monto }}</td>
				<td>{{ $pago->alumno->nombre }} {{ $pago->alumno->segundo_nombre }} {{ $pago->alumno->apellido }} {{ $pago->alumno->segundo_apellido }}</td>
				<td>{{ $pago->recibo->serie }}-{{ $pago->recibo->id}}</td>
				<td>{{ $pago->created_at}}</td>
			</tr>
		@endforeach
			<tr>
				<td style="font-weight: bold;">Total de Ingresos</td>
				<td style="font-weight: bold;">Q{{ $total }}</td>
			</tr>
	</tbody>
</table>