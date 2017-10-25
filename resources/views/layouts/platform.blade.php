<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Plataforma | @yield('title')</title>

		<!-- Add to homescreen for Chrome on Android -->
		<meta name="mobile-web-app-capable" content="yes">
		<link rel="icon" sizes="192x192" href="images/android-desktop.png">

		<!-- Add to homescreen for Safari on iOS -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="apple-mobile-web-app-title" content="Material Design Lite">
		<link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

		<!-- Tile icon for Win8 (144x144 + tile color) -->
		<meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
		<meta name="msapplication-TileColor" content="#3372DF">

		<link rel="shortcut icon" href="images/favicon.png">
		<link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<link rel="stylesheet" href="{{ asset('template_web/css/materialize.min.css') }}">

		<link rel="stylesheet" href="{{ asset('template_platform/css/material.min.css') }}">

		<link rel="stylesheet" href="{{ asset('template_platform/css/styles.css') }}">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.10/sweetalert2.css">

		<link rel="stylesheet" href="{{ asset('template_platform/css/basic.css') }}">
		<link rel="stylesheet" href="{{ asset('template_platform/css/dropzone.css') }}">

		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
		
		@yield('extra_css')

		<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

		<script type="text/javascript">
		$(document).ready(function() {

			$('select').material_select();
			
			$('.modal').modal();
			$('.datepicker').pickadate({
				monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
				monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
				weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado' ],
				weekdaysShort: [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],
				weekdaysLetter: [ 'D', 'L', 'M', 'M', 'J', 'V', 'S' ],
				format: 'yyyy/mm/dd',
				formatSubmit: 'yyyy/mm/dd',
				selectMonths: false, // Creates a dropdown to control month
				selectYears: 15, // Creates a dropdown of 15 years to control year,
				today: 'Hoy',
				clear: 'Limpiar',
				close: 'Ok',
				closeOnSelect: false // Close upon selecting a date,
			});

			$('.js-example-basic-single').select2();

		});
		</script>

		@yield('scripts_inicio')

		<style>
		#view-source {
			position: fixed;
			display: block;
			right: 0;
			bottom: 0;
			margin-right: 40px;
			margin-bottom: 40px;
			z-index: 900;
		}
		</style>
	</head>
	<body>
		<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
			<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
				<div class="mdl-layout__header-row">
					<span class="mdl-layout-title"> 

						@if (Auth::user()->tipo_usuario_id == 1)

							<!-- Usuario Propietario -->
							{{ Auth::user()->empleado->sede->nombre }}

						@elseif(Auth::user()->tipo_usuario_id == 2)

							<!-- Usuario Administrador -->
							{{ Auth::user()->empleado->sede->nombre }}

						@elseif(Auth::user()->tipo_usuario_id == 3)

							<!-- Usuario Maestro  -->
							{{ Auth::user()->empleado->sede->nombre }}

						@elseif(Auth::user()->tipo_usuario_id == 4)

							<!-- Usuario Encargado -->
							{{ Auth::user()->encargado->sede->nombre }}

						@elseif(Auth::user()->tipo_usuario_id == 5)

							<!-- Usuario Alumno -->
							{{ Auth::user()->alumno->sede->nombre }}
						@endif

					</span>

					<div class="mdl-layout-spacer"></div>

					<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
						<i class="material-icons">more_vert</i>
					</button>
					<ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
						<li class="">
							<a class="mdl-menu__item" href="{{ route('logout') }}"
									onclick="event.preventDefault();
													 document.getElementById('logout-form').submit();">Salir
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
							</form>
						</li>
						<li class="">
							<a class="mdl-menu__item modal-trigger" href="#modal_reset_password">
								Configuración
							</a>
						</li>
					</ul>
				</div>
			</header>
			<div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
				<header class="demo-drawer-header">
					<center>
						@if(Auth::user()->tipo_usuario_id == 1 || Auth::user()->tipo_usuario_id == 2)
							<img src="{{ asset('template_platform/img/admin.ico') }}" class="demo-avatar">
						@elseif(Auth::user()->tipo_usuario_id == 3)
							<img src="{{ asset('template_platform/img/teacher.png') }}" class="demo-avatar">
						@elseif(Auth::user()->tipo_usuario_id == 4)
							<img src="{{ asset('template_platform/img/parents.png') }}" class="demo-avatar">
						@elseif(Auth::user()->tipo_usuario_id == 5)
							<img src="{{ asset('template_platform/img/student.ico') }}" class="demo-avatar">
						@endif
					</center>
					<br>
					<div>
						<center>
							<span>
								@if(Auth::user()->tipo_usuario_id == 1 || Auth::user()->tipo_usuario_id == 2)

									{{ Auth::user()->empleado->nombre }} {{ Auth::user()->empleado->apellido }}

								@elseif(Auth::user()->tipo_usuario_id == 3)

									{{ Auth::user()->empleado->nombre }} {{ Auth::user()->empleado->apellido }}

								@elseif(Auth::user()->tipo_usuario_id == 4)

									{{ Auth::user()->encargado->nombre }} {{ Auth::user()->encargado->apellido }}

								@elseif(Auth::user()->tipo_usuario_id == 5)

									{{ Auth::user()->alumno->nombre }} {{ Auth::user()->alumno->apellido }}

								@endif
							</span>
						</center>
					</div>
				</header>
				<nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
					@if(Auth::user()->tipo_usuario_id == 1 || Auth::user()->tipo_usuario_id == 2)
						<a class="mdl-navigation__link" href="{{ route('alumnos.index') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">face</i>Estudiantes</a>
						<a class="mdl-navigation__link" href="{{ route('pagos.ver_modulo') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">attach_money</i>Pagos</a>
						<a class="mdl-navigation__link" href="/plataforma/administracion"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">settings</i>Administración</a>
						<a class="mdl-navigation__link" href="{{ route('reportes.ver_modulo') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">assignment</i>Reportes</a>
					@elseif(Auth::user()->tipo_usuario_id == 3)
						<a class="mdl-navigation__link" href="{{ route('maestro.mis_cursos') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">book</i>Cursos</a>						
					@elseif(Auth::user()->tipo_usuario_id == 4)
						<a class="mdl-navigation__link" href="{{ route('encargado.mis_alumnos') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">face</i>Alumnos</a>
					@elseif(Auth::user()->tipo_usuario_id == 5)
					<a class="mdl-navigation__link" href="{{ route('alumno.mis_cursos') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">book</i>Cursos</a>
					@endif


				</nav>
			</div>
			<main class="mdl-layout__content mdl-color--grey-100">
				<div class="">
					@yield('content')
				</div>
			</main>
		</div>

		<!-- Modal para el cambio de clave -->
		<div id="modal_reset_password" class="modal">
			<form action="{{ route('usuarios.update', Auth::user()->id ) }}" method="GET" id="form_cambio_pass">
				{{ csrf_field() }}
				<div class="modal-content">
					<h4 class="center">Configuración</h4>
					<p class="flow-text">Cambio de Contraseña</p>
					<div class="row">
						<div class="input-field col s12 l6">
							<i class="material-icons prefix">lock</i>
							<input type="password" name="clave_actual" id="clave_actual" value="" placeholder="" required>
							<label for="clave_actual">Clave Actual</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 l6">
							<i class="material-icons prefix">lock_open</i>
							<input type="password" name="clave_nueva1" id="clave_nueva1" value="" placeholder="" required>
							<label for="clave_nueva">Nueva Clave</label>
						</div>
						<div class="input-field col s12 l6">
							<i class="material-icons prefix">lock_open</i>
							<input type="password" name="clave_nueva2" id="clave_nueva2" value="" placeholder="" required>
							<label for="clave_nueva">Repetir Nueva Clave</label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="enviar" class="modal-action waves-effect waves-green btn-flat ">Aceptar</a>
				</div>
			</form>
		</div>

		@yield('extras')

			<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

			<script src="{{ asset('template_platform/js/material.min.js') }}"></script>

			<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.10/sweetalert2.js" charset="utf-8"></script>

			<script type="text/javascript">

				$('#form_cambio_pass').on('submit', function(e){
					// validation code here

					e.preventDefault();
					$.ajax({
						url: $('#form_cambio_pass').attr('action'),
						type: 'PUT',
						data: $('#form_cambio_pass').serialize(),
						success: function(data){

							location.reload();

						},
						error: function(error){
							console.log(error);
						}
					})

				});

			</script>

		@yield('scripts_final')
	</body>
</html>
