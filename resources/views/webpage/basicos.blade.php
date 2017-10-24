@extends('layouts.app')

@section('title')



@endsection

@section('content')

	<div class="container">
		<div class="row">
			<div class="col l12">
				<h3 class="header center light-blue-text text-darken-4">Educación Secundaria</h3>
			</div>
		</div>
		<div class="row">
			<div class="col l12">
				<p class="flow-text" align="justify">
					El Ciclo Básico comprende tres grados Primero, Segundo y Tercero. En este nivel se establecen las bases fundamentales para la formación integral de los estudiantes; brindándoles las herramientas necesarias para puedan continuar sus estudios en el Ciclo Diversificado. 
					
					Se trabaja conforme el Currículo Nacional Base del Mineduc. Además se imparten los cursos de Lectura y Valores.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col l12">
				<div class="col l4">
					<img src="{{ asset('template_web/img/basicos1.jpg') }}" alt="" class="responsive-img">
				</div>
				<div class="col l4">
					<img src="{{ asset('template_web/img/basicos2.png') }}" alt="" class="responsive-img">
				</div>
				<div class="col l4">
					<img src="{{ asset('template_web/img/basicos3.jpg') }}" alt="" class="responsive-img">
				</div>
			</div>
		</div>
	</div>

@endsection