@extends('layouts.app')

@section('title')
	{{-- expr --}}
@endsection

@section('content')

	<div class="container">
		<div class="row">
			<div class="col l12">
				<h3 class="header center light-blue-text text-darken-4">Ciclo Diversificado</h3>
			</div>
		</div>
		<div class="row">
			<div class="col l12">
				<p class="flow-text" align="justify">
					En el Ciclo Diversificado se imparten las carreras de: Bachillerato en Computación con Orientación Comercial (DOS AÑOS).
					y Perito Contador con Orientación en Computación (TRES AÑOS).

				</p>
				
				<p class="flow-text" align="justify">
					El Colegio brinda a los estudiantes una excelente formación académica, cumpliendo con los cursos específicos para cada carrera de acuerdo al CNB del Mineduc.
				</p>

				<p class="flow-text" align="justify">
					Nuestros alumnos son requeridos por Empresas privadas de prestigio y bancos del sistema, para realizar las prácticas y para empleos fijos.
				</p>	
			</div>
		</div>
		<div class="row">
			<div class="col l12">
				<div class="col l4">
					<img src="{{ asset('template_web/img/diversificado1.jpg') }}" alt="" class="responsive-img">
				</div>
				<div class="col l4">
					<img src="{{ asset('template_web/img/diversificado2.jpg') }}" alt="" class="responsive-img">
				</div>
				<div class="col l4">
					<img src="{{ asset('template_web/img/diversificado3.jpg') }}" alt="" class="responsive-img">
				</div>
			</div>
		</div>
	</div>

@endsection