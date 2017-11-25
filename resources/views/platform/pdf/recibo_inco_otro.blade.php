
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
		<td colspan="2" class="negrita titulo">Centro Educativo Inmaculada Concepción</td>
		<td colspan="2" class="negrita titulo">Centro Educativo Inmaculada Concepción</td>
	</tr>
	<tr style="text-align: center">
		<td colspan="2">27 avenida 31-39, Colonia Las Tapias Zona 18</td>
		<td colspan="2">27 avenida 31-39, Colonia Las Tapias Zona 18</td>
	</tr>
	<tr style="text-align: center">
		<td colspan="2">Tel. 5981-2288</td>
		<td colspan="2">Tel. 5981-2288</td>
	</tr>
	<tr class="big negrita" style="text-align: center">
		<td colspan="2" >RECIBO B-{{ $recibo->id }}</td>
		<td colspan="2" >RECIBO B-{{ $recibo->id }}</td>
	</tr>
	<tr>
		<td colspan="2">Res. Ministerial</td>
		<td colspan="2">Res. Ministerial</td>
	</tr>
	<tr>
		<td colspan="2">No. 140-2012</td>
		<td colspan="2">No. 140-2012</td>
	</tr>
	<tr>
		<td colspan="2">Nit: 4714796-2</td>
		<td colspan="2">Nit: 4714796-2</td>
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
