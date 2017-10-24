@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col s12">
				<h3 class="header center light-blue-text text-darken-4">Nuestra Misión</h3>
			</div>
		</div>
		<div class="row valign-wrapper">
			<div class="col s12 ">

	            <p class="flow-text" align="justify">
					Somos una Institución Educativa formadora de estudiantes en Educación Primaria, Educación Básica y Diversiticado, respaldados con personal docente competente, comprometidos en brindar una educacion eficaz y eficiente, para fortalecer el nivel de educación básica en beneficio de la sociedad.
	            </p>
	        </div>

		</div>
		<div class="row">
			<div class="col s12">
	        	<center>
	        		<img class="responsive-img" src="{{ asset('template_web/img/mision.png') }}" alt="" height="150" width="150">
	        	</center>
	        </div>
		</div>
	</div>

@endsection
