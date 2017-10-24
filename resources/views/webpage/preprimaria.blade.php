@extends('layouts.app')

@section('title')
	{{-- expr --}}
@endsection

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col l12">
				<h3 class="header center light-blue-text text-darken-4">Educación Preprimaria</h3>
			</div>
		</div>
		<div class="row">
			<div class="col l12">
				<p class="flow-text" align="justify">
					La educación pre-primaria brinda las primeras experiencias en aprendizaje y sociabilización . 
					El currículo está organizado en áreas que responden a las diferentes etapas del desarrollo entre las edades de 4 a 6 años, que permiten la formación integral de los niños.

					En esta etapa de la vida es en la que se establecen las bases fundamentales y esenciales para el posterior desarrollo del comportamiento humano.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col l12">
				<div class="col l4">
					<img src="{{ asset('template_web/img/preprimaria1.jpg') }}" alt="" class="responsive-img">
				</div>
				<div class="col l4">
					<img src="{{ asset('template_web/img/preprimaria2.jpg') }}" alt="" class="responsive-img">
				</div>
				<div class="col l4">
					<img src="{{ asset('template_web/img/preprimaria3.jpg') }}" alt="" class="responsive-img">
				</div>
			</div>
		</div>
	</div>

@endsection