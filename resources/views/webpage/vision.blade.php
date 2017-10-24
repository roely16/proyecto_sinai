@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col s12">
	            <h3 class="header center light-blue-text text-darken-4">Nuestra Visión</h3>
			</div>
		</div>
		<div class="row valign-wrapper">
			<div class="col s12">
	            <p class="flow-text" align="justify">
					Ser una institución educativa que sea reconocida y competitiva, acorde a los requerimientos de calidad que demanda la sociedad del conocimiento.
	            </p>
	        </div>
		</div>
		<div class="row">
			<div class="col s12">
				<center>
					<img class="responsive-img" src="{{ asset('template_web/img/vision.png') }}" alt="" height="250" width="250">
	        	</center>
			</div>
		</div>
	</div>
@endsection
