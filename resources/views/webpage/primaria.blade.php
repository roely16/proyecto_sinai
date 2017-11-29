@extends('layouts.app')

@section('title')

	

@endsection

@section('content')

	<div class="container">
		<div class="row">
			<div class="col l12">
				<h3 class="header center light-blue-text text-darken-4">Educación Primaria</h3>
			</div>
		</div>
		<div class="row">
			<div class="col l12">
				<p class="flow-text" align="justify">
					Tiene como finalidad proporcionar a los estudiantes, los elementos básicos culturales: la expresión oral, la lectura, la escritura, el cálculo aritmético, el desenvolvimiento social y natural. Se cumple con el CNB del Mineduc y se imparten los cursos de Computación y de Inglés. 
					Los alumnos reciben una educación integral. 
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col l12">
				<div class="col l4">
					<img src="{{ asset('template_web/img/primaria.jpg') }}" alt="" class="responsive-img">
				</div>
				<div class="col l4">
					<img src="{{ asset('template_web/img/primaria2.jpg') }}" alt="" class="responsive-img">
				</div>
				<div class="col l4">
					<img src="{{ asset('template_web/img/primaria3.jpg') }}" alt="" class="responsive-img">
				</div>
			</div>
		</div>
	</div>

@endsection