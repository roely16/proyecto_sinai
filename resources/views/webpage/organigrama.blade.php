@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col l12 s12">
        <h3 class="header center light-blue-text text-darken-4">Organigrama</h3>
        <center>
          <p>A continuación pasamos a detallar los órganos personales y colectivos para
          la organización, dirección y gestión del colegio.</p>
        </center>
      </div>
    </div>
    <div class="row">
      <div class="col s12">
        <center>
          <img  height="700" width="700" class="responsive-img" src="{{ asset('template_web/img/organigrama.png') }}" alt="">
        </center>
      </div>
    </div>
  </div>
@endsection
