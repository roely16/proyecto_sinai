@extends('layouts.platform')

@section('title')

	Ver Grado

@endsection

@section('content')

	<div class="row">
		<div class="col l1">
			<br>
			<a href="{{ route('admin_pagos.ver_modulo') }}" class="btn blue-grey darken-4" ><i class="material-icons center">arrow_back</i></a>
		</div>
		<div class="col l10">
			<h5 class="center">Editar Pagos - {{ $grado->nombre }} {{ $grado->nivel->nombre }} / Jornada {{ $grado->jornada->nombre }}</h5>
		</div>
		<div class="col l5">
			
		</div>
	</div>

	<div class="row">
		<div class="row">
		    <div class="col s12">
		    	<ul class="tabs tabs-fixed-width">
			        <li class="tab col s3"><a class="active" href="#test1">Mensualidades</a></li>
			        <li class="tab col s3"><a href="#test2">Pagos Anuales</a></li>
		      	</ul>
		    </div>
		    <div id="test1" class="col s12">
				<br>
				<div class="row">
					<div class="col l12">
						<a href="" class="btn right"><i class="material-icons">edit</i></a>
					</div>
				</div>

		    	<div class="row">
		    		<table class="highlight">
			    		<thead>
			    			<tr>
			    				<th>Concepto</th>
			    				<th>Monto</th>
			    			</tr>
			    		</thead>
			    		<tbody>
			    			@foreach ($mensualidades as $mensualidad)
			    				<tr>
			    					<td>Mensualidad de {{ $mensualidad->nombre }}</td>
			    					<td><input type="text" value="{{ $mensualidad->monto }}" readonly></td>
			    				</tr>
			    			@endforeach
			    		</tbody>
			    	</table>
		    	</div>
		    </div>
		    <div id="test2" class="col s12">
		    	<br>
				<div class="row">
					<div class="col l12">
						<a href="" class="btn right"><i class="material-icons">edit</i></a>
					</div>
				</div>

				<div class="row">
		    		<table class="highlight">
			    		<thead>
			    			<tr>
			    				<th>Concepto</th>
			    				<th>Monto</th>
			    			</tr>
			    		</thead>
			    		<tbody>
			    			@foreach ($anualidades as $anualidad)
			    				<tr>
			    					<td>{{ $anualidad->nombre }}</td>
			    					<td><input type="text" value="{{ $anualidad->monto }}" readonly></td>
			    				</tr>
			    			@endforeach
			    		</tbody>
			    	</table>
		    	</div>
		    </div>
	  	</div>
	</div>

@endsection

