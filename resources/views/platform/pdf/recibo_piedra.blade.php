
<style>
	.main {
	  	font-family:Arial,Verdana,sans-serif;
	  	font-size: 1.1px;
	}

	.big {
    	line-height: 250%;
	}

	.titulo{
		font-size: 2px;
	}

	.negrita{
		font-weight: bold;
	}

	table { border-collapse: collapse; }
	table, tr, td { margin:0px; padding: 0px; }

</style>
<table style="width: 100%" class="main">
	<tr style="text-align: center">
		<td colspan="2" class="negrita titulo">Colegio Tecnológico Sinai</td>
		<td colspan="2" class="negrita titulo">Colegio Tecnológico Sinai</td>
	</tr>
	<tr style="text-align: center">
		<td colspan="2">Calle Principal Esquina Lote 88 "A" Zona 6</td>
		<td colspan="2">Calle Principal Esquina Lote 88 "A" Zona 6</td>
	</tr>
	<tr style="text-align: center">
		<td colspan="2">Aldea Piedra Parada Cristo Rey, Santa Catarina Pinula</td>
		<td colspan="2">Aldea Piedra Parada Cristo Rey, Santa Catarina Pinula</td>
	</tr>
	<tr class="big negrita" style="text-align: center">
		<td colspan="2" >RECIBO A-{{ $recibo->id }}</td>
		<td colspan="2" >RECIBO A-{{ $recibo->id }}</td>
	</tr>
	<tr>
		<td colspan="2">Res. Ministerial</td>
		<td colspan="2">Res. Ministerial</td>
	</tr>
	<tr>
		<td colspan="2">No. 338-2011</td>
		<td colspan="2">No. 338-2011</td>
	</tr>
	<tr>
		<td colspan="2">Nit: 8016660-1</td>
		<td colspan="2">Nit: 8016660-1</td>
	</tr>
	<tr class="big">
		<td colspan="2">Nombre: </td>
		<td colspan="2">Nombre: </td>
	</tr>
	<tr class="big">
		<td colspan="2">Nit: </td>
		<td colspan="2">Nit: </td>
	</tr>
	<tr class="big negrita">
		<td>Concepto:</td>
		<td>Monto:</td>
		<td>Concepto:</td>
		<td>Monto:</td>
	</tr>
	@foreach ($pagos as $pago)
		<tr>
			<td>{{$pago->concepto}}</td>
			<td>Q{{$pago->monto}}</td>
			<td>{{$pago->concepto}}</td>
			<td>Q{{$pago->monto}}</td>
		</tr>
	@endforeach
	
	<tr class="big negrita">
		<td>Total</td>
		<td>Q{{$recibo->total}}</td>
		<td>Total</td>
		<td>Q{{$recibo->total}}</td>
	</tr>
	<tr class="big">
		<td>Alumno: {{ $alumno->nombre }} {{$alumno->segundo_nombre}} {{ $alumno->apellido }} {{ $alumno->segundo_apellido}}</td>
		<td>Fecha: {{ $recibo->created_at->toDateString() }}</td>
		<td>Alumno: {{ $alumno->nombre }} {{$alumno->segundo_nombre}} {{ $alumno->apellido }} {{ $alumno->segundo_apellido}}</td>
		<td>Fecha: {{ $recibo->created_at->toDateString() }}</td>
	</tr>
</table>
