@extends('layouts.platform')

@section('title')
	Administración
@endsection

@section('content')

<div class="row">

	<div class="col s12 l6">
		<h5 class="header">Usuarios</h5>
		<div class="card horizontal">
			<div class="card-image">
				<img  width="200" height="200" src="{{ asset('template_platform/img/icon_users.png') }}">
			</div>
			<div class="card-stacked">
				<div class="card-content">
					<p align="justify">Permite la administración de los accesos a la plataforma tanto para personal administrativo
					como para maestros, alumnos y padres de familia.</p>
				</div>
				<div class="card-action">
					<a href="{{ route('usuarios.index') }}">Ingresar</a>
				</div>
			</div>
		</div>
	</div>

	<div class="col s12 l6">
		<h5 class="header">Colaboradores</h5>
		<div class="card horizontal">
			<div class="card-image">
				<img width="200" height="200" src="{{ asset('template_platform/img/user-group-icon.png') }}">
			</div>
			<div class="card-stacked">
				<div class="card-content">
					<p align="justify">Permite administrar a todo el personal de la institución</p>
				</div>
				<div class="card-action">
					<a href="{{ route('colaboradores.index') }}">Ingresar</a>
				</div>
			</div>
		</div>
	</div>

	<div class="col s12 l6">
		<h5 class="header">Grados</h5>
		<div class="card horizontal">
			<div class="card-image">
				<img width="200" height="200" src="{{ asset('template_platform/img/icon_courses.png') }}">
			</div>
			<div class="card-stacked">
				<div class="card-content">
					<p align="justify">Permite dar de alta los grados de la plataforma así como asignar catedraticos a un grado o bien a un curso en especifico.</p>
				</div>
				<div class="card-action">
					<a href="{{ route('grados_cursos.index') }}">Ingresar</a>
				</div>
			</div>
		</div>
	</div>

	<div class="col s12 l6">
		<h5 class="header">Cursos</h5>
		<div class="card horizontal">
			<div class="card-image">
				<img width="200" height="200" src="{{ asset('template_platform/img/courses-icon.png') }}" >
			</div>
			<div class="card-stacked">
				<div class="card-content">
					<p align="justify">Permite administrar los cursos que se imparten en los diferentes grados.</p>
				</div>
				<div class="card-action">
					<a href="{{ route('configuracion.index') }}">Ingresar</a>
				</div>
			</div>
		</div>
	</div>

	<!--  
	@if (Auth::user()->tipo_usuario_id == 1)
		<div class="col s12 l6">
			<h5 class="header">Pagos</h5>
			<div class="card horizontal">
				<div class="card-image">
					<img width="200" height="200" src="{{ asset('template_platform/img/payments.png') }}" >
				</div>
				<div class="card-stacked">
					<div class="card-content">
						<p align="justify">Permite administrar el monto de los diferentes pagos que se realizan en la institución.</p>
					</div>
					<div class="card-action">
						<a href="{{ route('admin_pagos.ver_modulo') }}">Ingresar</a>
					</div>
				</div>
			</div>
		</div>		
	@endif
	-->

</div>

@endsection
