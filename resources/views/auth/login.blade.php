<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <title>Colegio Sinai | Login</title>
	 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	 <link href="{{ asset('template_web/css/materialize.css') }}" rel="stylesheet">
	 <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
  <div class="container">
	 <div class="row">
		<div class="col s12 l6 offset-l3">
		  <h4 class="header center light-blue-text text-darken-4">Plataforma</h4>
		  <h5 class="header center light-blue-text text-darken-4">Colegio de Informatica Sinaí</h5>
		</div>
	 </div>
	 <div id="" class="row">
		  <div class="col s12 l6 offset-l3 card-panel">
				<form class="login-form" method="POST" action="{{ route('login') }}">
				  {{ csrf_field() }}
					 <div class="row">
						  <div class="input-field col s12 center">
						  	<a href="/">
						  		<img src="{{ asset('template_web/img/logo-sinai.jpg') }}" alt="" style="width:100px;" class="responsive-img valign profile-image-login">
						  	</a>
						  </div>
					 </div>
					 <div class="row">
						  <div class="input-field col s12">
								<i class="material-icons prefix account">account_circle</i>
								<input class="input1" id="usuario" type="text" name="usuario" value="{{ old('usuario') }}" required autofocus="">
								<label for="icon_telephone">Usuario</label>
						  </div>
					 </div>
					 <div class="row">
						  <div class="input-field col s12">
								<i class="material-icons prefix lock">lock</i>
								<input class="input2" id="password" name="password" type="password" required>
								<label for="icon_telephone">Contraseña</label>
						  </div>
					 </div>
					 <div class="row">
					 	<div class="s12">
					 		<h5 class="center-align light-blue-text text-darken-4">{{ $errors->first('usuario') }}</h5>
					 	</div>

					 </div>

					 <div class="row">
						  <div class="col s12 offset-s4">
							 <button class="btn waves-effect waves-teal light-blue darken-4" type="submit" name="action">Login
								<i class="material-icons right">send</i>
							 </button>
						  </div>
					 </div>
				</form>
		  </div>
	 </div>

  </div>
	 <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	 <script src="{{ asset('template_web/js/materialize.js') }}"></script>
	 <script type="text/javascript">
		$(".input1").focus(function() {
		  $('.account').addClass('light-blue-text text-darken-4');
			 }).blur(function() {
		  $('.account').removeClass('light-blue-text text-darken-4');
		});

		$(".input2").focus(function() {
		  $('.lock').addClass('light-blue-text text-darken-4');
			 }).blur(function() {
		  $('.lock').removeClass('light-blue-text text-darken-4');
		});
	 </script>
</body>
</html>
